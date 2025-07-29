<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function create(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan peminjaman.');
        }
        
        $mobil = null;
        $tanggalPinjam = null;
        $tanggalKembali = null;
        $availabilityMessage = null;
        
        if ($request->has('mobil')) {
            $mobil = Mobil::find($request->mobil);
            
            // Cek apakah mobil ada
            if (!$mobil) {
                return redirect()->route('katalog')->with('error', 'Mobil tidak ditemukan.');
            }
            
            // Jika ada parameter tanggal, cek ketersediaan
            if ($request->has('tanggal_pinjam') && $request->has('tanggal_kembali')) {
                $tanggalPinjam = $request->tanggal_pinjam;
                $tanggalKembali = $request->tanggal_kembali;
                
                // Validasi format tanggal
                if (!strtotime($tanggalPinjam) || !strtotime($tanggalKembali)) {
                    return redirect()->route('katalog')->with('error', 'Format tanggal tidak valid.');
                }
                
                // Cek ketersediaan
                if (!$mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali)) {
                    $availabilityMessage = 'Mobil tidak tersedia untuk tanggal yang dipilih. Silakan pilih tanggal lain.';
                }
            }
        }
        
        return view('user.peminjaman.create', compact('mobil', 'tanggalPinjam', 'tanggalKembali', 'availabilityMessage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'foto_diri' => 'required|image|max:2048',
            'ktp' => 'required|image|max:2048',
            'kk' => 'required|image|max:2048',
            'sim_a' => 'required|image|max:2048',
            'ktp_penjamin' => 'required|image|max:2048',
        ]);

        // Cek ketersediaan mobil berdasarkan tanggal
        $mobil = Mobil::find($validated['mobil_id']);
        if (!$mobil->isAvailableForDateRange($validated['tanggal_pinjam'], $validated['tanggal_kembali'])) {
            return redirect()->back()->with('error', 'Mobil tidak tersedia untuk tanggal yang dipilih. Silakan pilih tanggal lain atau mobil lain.')->withInput();
        }

        $data = $validated;
        $data['user_id'] = Auth::id();
        
        foreach(['foto_diri','ktp','kk','sim_a','ktp_penjamin'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('peminjaman', 'public');
            }
        }
        
        // Hitung total hari
        $tanggalPinjam = new \DateTime($data['tanggal_pinjam']);
        $tanggalKembali = new \DateTime($data['tanggal_kembali']);
        $selisih = $tanggalPinjam->diff($tanggalKembali)->days;
        
        // Jika tanggal sama, hitung sebagai 1 hari
        if ($selisih == 0) {
            $selisih = 1;
        } else {
            $selisih = $selisih + 1; // Tambah 1 untuk menghitung hari terakhir
        }
        
        $hargaSewa = $mobil->harga_sewa;
        $total = $hargaSewa * $selisih;
        
        // Cek peminjaman pertama
        $isFirst = Peminjaman::where('user_id', Auth::id())->count() == 0;
        $diskon = 0;
        if ($isFirst) {
            $diskon = 10;
            $total = $total * 0.9;
        }
        
        $data['diskon'] = $diskon;
        $data['total_harga'] = $total;
        $data['status'] = 'menunggu_pembayaran';
        
        // Buat peminjaman tanpa mengubah status mobil
        Peminjaman::create($data);
        
        // Instruksi pembayaran dan WhatsApp
        $user = Auth::user();

        $pesan = "Halo Admin MD Rent Car,\n\n";
        $pesan .= "Konfirmasi pembayaran pemesanan mobil:\n\n";
        $pesan .= "Mobil: {$mobil->nama} ({$mobil->merk})\n";
        $pesan .= "Tanggal: {$data['tanggal_pinjam']} s/d {$data['tanggal_kembali']}\n";
        $pesan .= "Durasi: {$selisih} hari\n";
        $pesan .= "Harga per hari: Rp " . number_format($hargaSewa, 0, ',', '.') . "\n";
        $pesan .= "Subtotal: Rp " . number_format($hargaSewa * $selisih, 0, ',', '.') . "\n";
        
        if ($diskon > 0) {
            $pesan .= "Diskon: {$diskon}% pemesanan pertama\n";
            $pesan .= "Potongan: Rp " . number_format(($hargaSewa * $selisih) * 0.1, 0, ',', '.') . "\n";
        }
        
        $pesan .= "Total: Rp " . number_format($total, 0, ',', '.') . "\n";
        $pesan .= "Nama: {$user->name}\n";

        $pesan .= "\nMohon konfirmasi pembayaran. Terima kasih.";

        $wa = "https://wa.me/6289636937394?text=" . urlencode($pesan);
        return redirect()->away($wa);
    }
}


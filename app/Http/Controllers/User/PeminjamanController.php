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
        if ($request->has('mobil')) {
            $mobil = Mobil::find($request->mobil);
            
            // Cek apakah mobil ada dan tersedia
            if (!$mobil) {
                return redirect()->route('katalog')->with('error', 'Mobil tidak ditemukan.');
            }
            
            if (strtolower($mobil->status) !== 'tersedia') {
                return redirect()->route('katalog')->with('error', 'Mobil tidak tersedia untuk disewa.');
            }
        }
        
        return view('user.peminjaman.create', compact('mobil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'foto_diri' => 'required|image|max:2048',
            'ktp' => 'required|image|max:2048',
            'kk' => 'required|image|max:2048',
            'sim_a' => 'required|image|max:2048',
            'ktp_penjamin' => 'required|image|max:2048',
        ]);
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
        $selisih = $tanggalPinjam->diff($tanggalKembali)->days + 1;
        $mobil = Mobil::find($data['mobil_id']);
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
        Peminjaman::create($data);
        // Ubah status mobil menjadi dipinjam
        $mobil->status = 'dipinjam';
        $mobil->save();
        // Instruksi pembayaran dan WhatsApp
        $user = Auth::user();

        $pesan = "Halo Admin MD Rent Car,\n\n";
        $pesan .= "Konfirmasi pembayaran pemesanan mobil:\n\n";
        $pesan .= "Mobil: {$mobil->nama} ({$mobil->merk})\n";
        $pesan .= "Tanggal: {$data['tanggal_pinjam']} s/d {$data['tanggal_kembali']}\n";
        $pesan .= "Total: Rp " . number_format($total, 0, ',', '.') . "\n";
        $pesan .= "Nama: {$user->name}\n";

if ($diskon > 0) {
            $pesan .= "Diskon: {$diskon}% pemesanan pertama\n";
}

        $pesan .= "\nMohon konfirmasi pembayaran. Terima kasih.";

        $wa = "https://wa.me/6289636937394?text=" . urlencode($pesan);
return redirect()->away($wa);

    }
}


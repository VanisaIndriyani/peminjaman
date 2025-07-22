<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'mobil'])->orderBy('created_at', 'desc')->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'mobil'])->findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function aksi(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $aksi = $request->input('aksi');
        if (in_array($aksi, ['disetujui', 'ditolak'])) {
            $peminjaman->status = $aksi;
            $peminjaman->save();
            return redirect()->route('peminjaman.show', $id)->with('success', 'Status peminjaman berhasil diubah.');
        }
        return redirect()->route('peminjaman.show', $id)->with('error', 'Aksi tidak valid.');
    }

    public function pengembalianManual($id)
    {
        $peminjaman = Peminjaman::with('mobil')->findOrFail($id);
        $peminjaman->status = 'kembali';
        $peminjaman->save();
        if ($peminjaman->mobil) {
            $peminjaman->mobil->status = 'tersedia';
            $peminjaman->mobil->save();
        }
        // Tambahkan ke tabel pengembalians
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => now(),
            'status' => 'selesai',
        ]);
        return redirect()->route('peminjaman.index')->with('success', 'Pengembalian berhasil diproses secara manual.');
    }

    public function selesaikan($id)
    {
        $peminjaman = Peminjaman::with('mobil')->findOrFail($id);
        $peminjaman->status = 'kembali';
        $peminjaman->save();
        if ($peminjaman->mobil) {
            $peminjaman->mobil->status = 'tersedia';
            $peminjaman->mobil->save();
        }
        // Tambahkan ke tabel pengembalians
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => now(),
            'status' => 'selesai',
        ]);
        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diubah menjadi selesai.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Hapus data peminjaman
        $peminjaman->delete();
        
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
} 
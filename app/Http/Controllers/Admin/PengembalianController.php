<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.mobil'])
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')->get();
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.mobil'])->findOrFail($id);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function create(Request $request)
    {
        $peminjaman_id = $request->query('peminjaman_id');
        if ($peminjaman_id) {
            $peminjaman = Peminjaman::with(['user', 'mobil'])->findOrFail($peminjaman_id);
            return view('admin.pengembalian.create', compact('peminjaman'));
        } else {
            $peminjamans = Peminjaman::with(['user', 'mobil'])->where('status', 'dipinjam')->get();
            return view('admin.pengembalian.pilih', compact('peminjamans'));
        }
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }

    public function selesaikan($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->status = 'selesai';
        $pengembalian->save();
        return redirect()->route('pengembalian.index')->with('success', 'Status pengembalian berhasil diubah menjadi selesai.');
    }
} 
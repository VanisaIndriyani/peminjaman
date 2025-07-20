<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'hari');
        $keyword = $request->input('keyword');
        $status = $request->input('status');

        $peminjamans = Peminjaman::with(['user', 'mobil'])
            ->when($keyword, function($query) use ($keyword) {
                $query->whereHas('user', function($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                })->orWhereHas('mobil', function($q) use ($keyword) {
                    $q->where('nama', 'like', "%$keyword%");
                });
            })
            ->when($status, function($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($filter === 'hari', function($query) {
                $query->whereDate('created_at', now()->toDateString());
            })
            ->when($filter === 'minggu', function($query) {
                $query->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);
            })
            ->when($filter === 'bulan', function($query) {
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.mobil'])
            ->when($keyword, function($query) use ($keyword) {
                $query->whereHas('peminjaman.user', function($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                })->orWhereHas('peminjaman.mobil', function($q) use ($keyword) {
                    $q->where('nama', 'like', "%$keyword%");
                });
            })
            ->when($status, function($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($filter === 'hari', function($query) {
                $query->whereDate('created_at', now()->toDateString());
            })
            ->when($filter === 'minggu', function($query) {
                $query->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);
            })
            ->when($filter === 'bulan', function($query) {
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.index', compact('peminjamans', 'pengembalians', 'keyword', 'status', 'filter'));
    }
} 
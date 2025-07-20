<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('mobil')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        // Ambil notifikasi dari session jika ada
        $notif = session()->pull('notif_peminjaman_user_' . Auth::id());
        return view('user.riwayat', compact('peminjamans', 'notif'));
    }
} 
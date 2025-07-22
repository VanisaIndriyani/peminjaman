<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Pastikan tidak menghapus admin
        if ($user->role === 'admin') {
            return redirect()->route('pengguna.index')->with('error', 'Tidak dapat menghapus akun admin.');
        }
        
        // Hapus data pengguna
        $user->delete();
        
        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
} 
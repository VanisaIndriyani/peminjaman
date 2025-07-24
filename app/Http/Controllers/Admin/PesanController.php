<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::orderBy('created_at', 'desc')->get();
        return view('admin.pesan.index', compact('pesans'));
    }

    public function destroy($id)
    {
        try {
            $pesan = Pesan::findOrFail($id);
            $pesan->delete();
            
            return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pesan.index')->with('error', 'Gagal menghapus pesan. Silakan coba lagi.');
        }
    }
}

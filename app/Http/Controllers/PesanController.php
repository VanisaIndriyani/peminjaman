<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telepon' => 'nullable|string|max:30',
            'subjek' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);
        Pesan::create($validated);
        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}

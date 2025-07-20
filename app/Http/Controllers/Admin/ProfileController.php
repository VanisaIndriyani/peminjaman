<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();
        if (!$admin) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            if ($admin->foto && \Storage::disk('public')->exists('profile/'.$admin->foto)) {
                \Storage::disk('public')->delete('profile/'.$admin->foto);
            }
            $foto = $request->file('foto');
            $namaFoto = time().'_'.$foto->getClientOriginalName();
            $foto->storeAs('profile', $namaFoto, 'public');
            $validated['foto'] = $namaFoto;
        }
        $admin->update($validated);
        return redirect()->route('admin.profile.show')->with('success', 'Profil berhasil diupdate!');
    }
} 
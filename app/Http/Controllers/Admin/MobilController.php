<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return view('admin.mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'merk' => 'required',
            'tahun' => 'required|digits:4|integer',
            'plat_nomor' => 'required|unique:mobils',
            'harga_sewa' => 'required|integer',
            'status' => 'required|in:tersedia,dipinjam',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time().'_'.$foto->getClientOriginalName();
            $foto->storeAs('mobil', $namaFoto, 'public');
            $validated['foto'] = $namaFoto;
        }
        \App\Models\Mobil::create($validated);
        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mobil = \App\Models\Mobil::findOrFail($id);
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = \App\Models\Mobil::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required',
            'merk' => 'required',
            'tahun' => 'required|digits:4|integer',
            'plat_nomor' => 'required|unique:mobils,plat_nomor,' . $mobil->id,
            'harga_sewa' => 'required|integer',
            'status' => 'required|in:tersedia,dipinjam',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mobil->foto && \Storage::disk('public')->exists('mobil/'.$mobil->foto)) {
                \Storage::disk('public')->delete('mobil/'.$mobil->foto);
            }
            $foto = $request->file('foto');
            $namaFoto = time().'_'.$foto->getClientOriginalName();
            $foto->storeAs('mobil', $namaFoto, 'public');
            $validated['foto'] = $namaFoto;
        }
        $mobil->update($validated);
        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mobil = \App\Models\Mobil::findOrFail($id);
        $mobil->delete();
        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil dihapus!');
    }
} 
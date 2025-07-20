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
}

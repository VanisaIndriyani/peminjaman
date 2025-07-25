<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'merk', 'tahun', 'plat_nomor', 'harga_sewa', 'status', 'foto'
    ];
} 
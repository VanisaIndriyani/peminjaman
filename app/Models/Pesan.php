<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'nama_depan', 'nama_belakang', 'email', 'telepon', 'subjek', 'pesan'
    ];
}

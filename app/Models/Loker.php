<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama_umkm',
        'nama_owner',
        'kota_umkm',
        'lokasi_umkm',
        'deskripsi',
        'email',
    ];
}

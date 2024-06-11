<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_umkm',
        'nama_umkm',
        'kota_umkm',
        'lokasi_umkm',
        'deskripsi',
        'kontak',
        'user_id',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

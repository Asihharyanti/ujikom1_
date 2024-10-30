<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Nama tabel
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'kategori_id',
    ];

    // Definisikan relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id'); // Pastikan Kategori diimpor
    }
}

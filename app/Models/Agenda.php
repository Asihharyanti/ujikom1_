<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda'; // Nama tabel
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'kategori_id',
    ];

    // Definisikan relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id'); // Pastikan Kategori diimpor
    }
}

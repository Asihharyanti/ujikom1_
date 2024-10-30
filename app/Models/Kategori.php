<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel
    protected $fillable = ['judul', 'deskripsi'];

    public function informations()
    {
        return $this->hasMany(Information::class, 'kategori_id'); // Relasi satu ke banyak
    }
}

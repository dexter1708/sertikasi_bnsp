<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'buku_id';

    protected $fillable = [
        'nama',
        'kategori_id',
        'penulis',
        'penerbit',
        'gambar',
        'harga',
        'stok',
        'tanggal_terbit'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // public function orders()
    // {
    //     return $this->hasMany(Orders::class, 'buku_id', 'buku_id');
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';
    protected $primaryKey = 'pembeli_id';

    protected $fillable = [
        'nama_pembeli',
        'alamat_pembeli',
        'total_pembelian'
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'pembeli_id', 'pembeli_id');
    }
}

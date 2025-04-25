<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'buku_id',
        'pembeli_id',
        'jumlah',
        'subtotal',
        'tanggal_order',
        'status',
        'user_id'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id','buku_id');

    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id', 'pembeli_id');
    }
}

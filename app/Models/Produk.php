<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori;
use App\Models\Transaksi;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama',
        'harga',
        'detail',
        'foto',
        'ketersediaan_stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}
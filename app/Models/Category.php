<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['harga_paket'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public function harga_paket()
    {
        return $this->belongsTo(HargaPaket::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['peserta','barang', 'category'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

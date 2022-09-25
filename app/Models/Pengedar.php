<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengedar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['peserta'];

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}

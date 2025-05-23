<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kamar extends Model
{
    use HasFactory;

    protected $fillable = ['tipe_kamar', 'harga_per_malam', 'status'];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}

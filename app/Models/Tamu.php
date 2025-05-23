<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tamu extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'nomor_telepon', 'email'];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}

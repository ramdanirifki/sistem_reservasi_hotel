<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tamu_id',
        'kamar_id',
        'tanggal_checkin',
        'tanggal_checkout',
        'status_reservasi'
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}

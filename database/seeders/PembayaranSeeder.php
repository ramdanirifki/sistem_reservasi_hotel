<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pembayaran::insert([
            [
                'reservasi_id' => 1,
                'jumlah_bayar' => 600000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-01'
            ]
        ]);
        Pembayaran::insert([
            [
                'reservasi_id' => 2,
                'jumlah_bayar' => 700000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-02'
            ]
        ]);
    }
}

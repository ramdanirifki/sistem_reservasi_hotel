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
                'tanggal_bayar' => '2025-06-01',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 2,
                'jumlah_bayar' => 700000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-02',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 3,
                'jumlah_bayar' => 850000,
                'metode_bayar' => 'Kartu Kredit',
                'tanggal_bayar' => '2025-06-03',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 4,
                'jumlah_bayar' => 1200000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-04',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 5,
                'jumlah_bayar' => 450000,
                'metode_bayar' => 'Tunai',
                'tanggal_bayar' => '2025-06-05',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 6,
                'jumlah_bayar' => 1500000,
                'metode_bayar' => 'E-Wallet',
                'tanggal_bayar' => '2025-06-06',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 7,
                'jumlah_bayar' => 900000,
                'metode_bayar' => 'Kartu Kredit',
                'tanggal_bayar' => '2025-06-07',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 8,
                'jumlah_bayar' => 1100000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-08',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 9,
                'jumlah_bayar' => 550000,
                'metode_bayar' => 'Tunai',
                'tanggal_bayar' => '2025-06-09',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 10,
                'jumlah_bayar' => 1800000,
                'metode_bayar' => 'E-Wallet',
                'tanggal_bayar' => '2025-06-10',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 11,
                'jumlah_bayar' => 720000,
                'metode_bayar' => 'Transfer Bank',
                'tanggal_bayar' => '2025-06-11',
                'bukti_pembayaran' => 'tidak-ada'
            ],
            [
                'reservasi_id' => 12,
                'jumlah_bayar' => 980000,
                'metode_bayar' => 'Kartu Kredit',
                'tanggal_bayar' => '2025-06-12',
                'bukti_pembayaran' => 'tidak-ada'
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservasi;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservasi::insert([
            [
            'tamu_id' => 1,
            'kamar_id' => 1,   
            'tanggal_checkin' => '2025-06-01',
            'tanggal_checkout' => '2025-06-03',
            'status_reservasi' => 'confirmed'
             ],
             [
             'tamu_id' => 2,
             'kamar_id' => 2,
             'tanggal_checkin' => '2025-06-05',
             'tanggal_checkout' => '2025-06-07',   
             'status_reservasi' => 'pending'
                
             ],
            [
                'tamu_id' => 1,
                'kamar_id' => 1,
                'tanggal_checkin' => '2025-06-01',
                'tanggal_checkout' => '2025-06-03',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 2,
                'kamar_id' => 2,
                'tanggal_checkin' => '2025-06-05',
                'tanggal_checkout' => '2025-06-07',
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 3,
                'kamar_id' => 3,
                'tanggal_checkin' => '2025-06-10',
                'tanggal_checkout' => '2025-06-12',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 4,
                'kamar_id' => 1,
                'tanggal_checkin' => '2025-06-15',
                'tanggal_checkout' => '2025-06-16',
                'status_reservasi' => 'cancelled'
            ],
            [
                'tamu_id' => 5,
                'kamar_id' => 4,
                'tanggal_checkin' => '2025-06-20',
                'tanggal_checkout' => '2025-06-25',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 1,
                'kamar_id' => 2,
                'tanggal_checkin' => '2025-07-01',
                'tanggal_checkout' => '2025-07-04',
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 6,
                'kamar_id' => 5,
                'tanggal_checkin' => '2025-07-10',
                'tanggal_checkout' => '2025-07-11',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 7,
                'kamar_id' => 3,
                'tanggal_checkin' => '2025-07-15',
                'tanggal_checkout' => '2025-07-18',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 8,
                'kamar_id' => 1,
                'tanggal_checkin' => '2025-07-20',
                'tanggal_checkout' => '2025-07-21',
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 9,
                'kamar_id' => 4,
                'tanggal_checkin' => '2025-07-25',
                'tanggal_checkout' => '2025-07-28',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 10,
                'kamar_id' => 2,
                'tanggal_checkin' => '2025-08-01',
                'tanggal_checkout' => '2025-08-03',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 3,
                'kamar_id' => 1,
                'tanggal_checkin' => '2025-08-05',
                'tanggal_checkout' => '2025-08-09',
                'status_reservasi' => 'cancelled'
            ]
        ]);
    }
}

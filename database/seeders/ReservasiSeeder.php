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
                'tanggal_checkin' => '2024-05-01',
                'tanggal_checkout' => '2024-05-03',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 2,
                'kamar_id' => 2,
                'tanggal_checkin' => '2024-05-05',
                'tanggal_checkout' => '2024-05-07',
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 1,
                'kamar_id' => 1,
                'tanggal_checkin' => '2024-05-01',
                'tanggal_checkout' => '2024-05-03',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 2,
                'kamar_id' => 2,
                'tanggal_checkin' => '2024-05-05',
                'tanggal_checkout' => '2024-05-07',
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 3,
                'kamar_id' => 3,
                'tanggal_checkin' => '2024-05-10',
                'tanggal_checkout' => '2024-05-12',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 4,
                'kamar_id' => 1,
                'tanggal_checkin' => '2024-05-15',
                'tanggal_checkout' => '2024-05-16',
                'status_reservasi' => 'cancelled'
            ],
            [
                'tamu_id' => 5,
                'kamar_id' => 4,
                'tanggal_checkin' => '2024-05-20',
                'tanggal_checkout' => '2024-05-25',
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 1,
                'kamar_id' => 2,
                'tanggal_checkin' => '2024-05-01', // Changed to May 2024
                'tanggal_checkout' => '2024-05-04', // Changed to May 2024
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 6,
                'kamar_id' => 5,
                'tanggal_checkin' => '2024-05-10', // Changed to May 2024
                'tanggal_checkout' => '2024-05-11', // Changed to May 2024
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 7,
                'kamar_id' => 3,
                'tanggal_checkin' => '2024-05-15', // Changed to May 2024
                'tanggal_checkout' => '2024-05-18', // Changed to May 2024
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 8,
                'kamar_id' => 1,
                'tanggal_checkin' => '2024-05-20', // Changed to May 2024
                'tanggal_checkout' => '2024-05-21', // Changed to May 2024
                'status_reservasi' => 'pending'
            ],
            [
                'tamu_id' => 9,
                'kamar_id' => 4,
                'tanggal_checkin' => '2024-05-25', // Changed to May 2024
                'tanggal_checkout' => '2024-05-28', // Changed to May 2024
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 10,
                'kamar_id' => 2,
                'tanggal_checkin' => '2024-05-01', // Changed to May 2024
                'tanggal_checkout' => '2024-05-03', // Changed to May 2024
                'status_reservasi' => 'confirmed'
            ],
            [
                'tamu_id' => 3,
                'kamar_id' => 1,
                'tanggal_checkin' => '2024-05-05', // Changed to May 2024
                'tanggal_checkout' => '2024-05-09', // Changed to May 2024
                'status_reservasi' => 'cancelled'
            ]
        ]);
    }
}

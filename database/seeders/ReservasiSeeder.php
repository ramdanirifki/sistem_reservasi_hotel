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
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kamar::insert([
            ['tipe_kamar' => 'Standard', 'harga_per_malam' => 300000, 'status' => 'tersedia'],
            ['tipe_kamar' => 'Deluxe', 'harga_per_malam' => 500000, 'status' => 'tersedia'],
        ]);
    }
}

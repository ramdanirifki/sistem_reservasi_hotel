<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tamu;

class TamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tamu::insert([
            ['nama' => 'Ali Ahmad', 'alamat' => 'Jl. Merdeka No.1', 'nomor_telepon' => '081234567890', 'email' => 'ali@gmail.com'],
            ['nama' => 'Budi Santoso', 'alamat' => 'Jl. Sudirman No.2', 'nomor_telepon' => '082345678901', 'email' => 'budi@gmail.com'],
        ]);
    }
}

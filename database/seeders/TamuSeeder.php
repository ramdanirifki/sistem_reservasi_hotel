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
            ['nama' => 'Citra Dewi', 'alamat' => 'Jl. Pahlawan No.3', 'nomor_telepon' => '083456789012', 'email' => 'citra.dewi@gmail.com'],
            ['nama' => 'Doni Saputra', 'alamat' => 'Jl. Gatot Subroto No.4', 'nomor_telepon' => '084567890123', 'email' => 'doni.s@gmail.com'],
            ['nama' => 'Eka Putri', 'alamat' => 'Jl. Diponegoro No.5', 'nomor_telepon' => '085678901234', 'email' => 'eka.p@gmail.com'],
            ['nama' => 'Faisal Ramadhan', 'alamat' => 'Jl. Gajah Mada No.6', 'nomor_telepon' => '086789012345', 'email' => 'faisal.r@gmail.com'],
            ['nama' => 'Gita Lestari', 'alamat' => 'Jl. Hayam Wuruk No.7', 'nomor_telepon' => '087890123456', 'email' => 'gita.l@gmail.com'],
            ['nama' => 'Hadi Susanto', 'alamat' => 'Jl. Thamrin No.8', 'nomor_telepon' => '088901234567', 'email' => 'hadi.s@gmail.com'],
            ['nama' => 'Indah Permata', 'alamat' => 'Jl. Kebon Jeruk No.9', 'nomor_telepon' => '089012345678', 'email' => 'indah.p@gmail.com'],
            ['nama' => 'Joko Widodo', 'alamat' => 'Jl. Raya Bogor No.10', 'nomor_telepon' => '081023456789', 'email' => 'joko.w@gmail.com'],
            ['nama' => 'Kartika Sari', 'alamat' => 'Jl. Imam Bonjol No.11', 'nomor_telepon' => '081134567890', 'email' => 'kartika.s@gmail.com'],
            ['nama' => 'Lukman Hakim', 'alamat' => 'Jl. Asia Afrika No.12', 'nomor_telepon' => '081245678901', 'email' => 'lukman.h@gmail.com'],
        ]);
    }
}

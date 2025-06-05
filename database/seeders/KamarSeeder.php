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
            ['nama_kamar' => 'Kamar Deluxe 301', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 205', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 700000, 'status' => 'tidak tersedia'],
            ['nama_kamar' => 'Kamar Standard 102', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 350000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 302', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 103', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 350000, 'status' => 'tidak tersedia'],
            ['nama_kamar' => 'Kamar Superior 206', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 700000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 303', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 550000, 'status' => 'tidak tersedia'],
            ['nama_kamar' => 'Kamar Standard 104', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 350000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 207', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 700000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 304', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 105', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 350000, 'status' => 'tidak tersedia'],
            ['nama_kamar' => 'Kamar Superior 208', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 700000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 305', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
        ]);
    }
}

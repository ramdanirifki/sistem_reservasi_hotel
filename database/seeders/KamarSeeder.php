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
            ['nama_kamar' => 'Kamar Deluxe 1', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 950000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 2', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 950000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 3', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 950000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 4', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 950000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Deluxe 5', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 950000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 1', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 750000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 2', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 750000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 3', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 750000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 4', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 750000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Superior 5', 'tipe_kamar' => 'Superior', 'harga_per_malam' => 750000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 1', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 2', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 3', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 4', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
            ['nama_kamar' => 'Kamar Standard 5', 'tipe_kamar' => 'Standard', 'harga_per_malam' => 550000, 'status' => 'tersedia'],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Tamu;

class DashboardController extends Controller
{
    public static function index() { 
        $data['kamar'] = Kamar::All();
        $data['reservasi'] = Reservasi::All();
        $data['reservasi_terbaru'] = Reservasi::orderBy("tanggal_checkin", "desc")->limit(5)->get();
        $data['tamu'] = Tamu::All();

        // Data untuk "Ketersediaan Kamar"
        $roomAvailability = [];
        $roomTypes = ['Standard', 'Superior', 'Deluxe']; // Tipe kamar yang ingin ditampilkan

        foreach ($roomTypes as $type) {
            $totalRooms = Kamar::where('tipe_kamar', $type)->count();
            $availableRooms = Kamar::where('tipe_kamar', $type)
                                  ->where('status', 'tersedia')
                                  ->count();

            $percentage = ($totalRooms > 0) ? round(($availableRooms / $totalRooms) * 100) : 0;

            $roomAvailability[] = [
                'type' => $type,
                'available' => $availableRooms,
                'total' => $totalRooms,
                'percentage' => $percentage,
            ];
        }

    

        return view('admin.admin_page', ['title' => 'Admin Panel','data' => $data, 'roomAvailability' => $roomAvailability]);
    }
}

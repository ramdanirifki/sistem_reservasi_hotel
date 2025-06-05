<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Tamu;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Mendapatkan data reservasi dengan pagination
        // Angka 10 menunjukkan berapa banyak item per halaman
        $reservasi = Reservasi::paginate(10); 

        // Untuk menghitung nomor urut (No) yang berkelanjutan di setiap halaman
        // Anda bisa meneruskan variabel 'i' awal dari controller
        $halaman = ($reservasi->currentPage() - 1) * $reservasi->perPage() + 1;
        
        $tamu = Tamu::all();
        $kamar = Kamar::all();

        return view('admin.reservasi', ["reservasi" => $reservasi, "halaman" => $halaman, "tamu" => $tamu, "kamar" => $kamar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tamu_id' => 'required|exists:tamus,id',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'status_reservasi' => 'required|in:pending,confirmed,cancelled',
        ]);
    
        return Reservasi::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservasi $reservasi)
    {
        //
        return $reservasi;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        //
        $reservasi->update($request->all());
        return $reservasi;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        //
        $reservasi->delete();
        return response()->json(['message' => 'Tamu deleted']);
    }
}

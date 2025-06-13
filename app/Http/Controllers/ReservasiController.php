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

        try {
            Reservasi::create([
                'tamu_id' => $request->tamu_id,
                'kamar_id' => $request->kamar_id,
                'tanggal_checkin' => $request->tanggal_checkin,
                'tanggal_checkout' => $request->tanggal_checkout,
                'status_reservasi' => $request->status_reservasi,
            ]);

            return redirect('/admin/reservasi')->with('success', 'Reservasi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/admin/reservasi')->with('error', 'Gagal menambahkan reservasi: ' . $e->getMessage());
        }
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
    public function destroy($id)
    {
        try {
            $reservasi = Reservasi::findOrFail($id);
            $reservasi->delete();

            return redirect()->back()->with('success', 'Reservasi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus reservasi: ' . $e->getMessage());
        }
    }
}

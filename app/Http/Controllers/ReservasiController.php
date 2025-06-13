<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Tamu;
use Illuminate\Support\Facades\Session;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai filter status dari request
        $statusFilter = $request->input('status'); // Atau $request->get('status')
        
        // Ambil nilai pencarian dari request
        $searchTerm = $request->input('search'); // Atau $request->get('search')

        // Mulai query Eloquent
        $query = Reservasi::query()->latest();

        // Terapkan filter status jika ada
        if (!empty($statusFilter)) {
            $query->where('status_reservasi', $statusFilter);
        }

        // Terapkan pencarian jika ada
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                // Cari di kolom yang relevan, contoh: nama tamu, nama kamar, ID reservasi
                // Sesuaikan dengan struktur database Anda
                $q->whereHas('tamu', function ($sq) use ($searchTerm) {
                    $sq->where('nama', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('kamar', function ($sq) use ($searchTerm) {
                    $sq->where('nama_kamar', 'like', '%' . $searchTerm . '%');
                });

                // **Logic for searching by ID with #RV prefix**
                // Check if the search term starts with '#RV'
                if (str_starts_with($searchTerm, '#RV')) {
                    // Remove '#RV' prefix to get the numeric ID
                    $numericId = (int) substr($searchTerm, 3); 
                    $q->orWhere('id', $numericId); // Search for the numeric ID
                } else {
                    // If it doesn't start with '#RV', search for the raw term in 'id'
                    $q->orWhere('id', 'like', '%' . $searchTerm . '%'); 
                }
            });
        }
        //
        // Mendapatkan data reservasi dengan pagination
        // Angka 10 menunjukkan berapa banyak item per halaman
        $reservasi = $query->with(['tamu', 'kamar'])->paginate(10); 

        // Untuk menghitung nomor urut (No) yang berkelanjutan di setiap halaman
        // Anda bisa meneruskan variabel 'i' awal dari controller
        $halaman = ($reservasi->currentPage() - 1) * $reservasi->perPage() + 1;
        
        $tamu = Tamu::all();
        $kamar = Kamar::select()->where('status', 'tersedia')->get();

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
        $validasi = $request->validate([
            'tamu_id' => 'required|exists:tamus,id',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'status_reservasi' => 'required|in:pending,confirmed,cancelled',
        ]);

        
        Reservasi::create($validasi);
        $kamar = Kamar::findOrFail($validasi['kamar_id']);
        $kamar->status = 'tidak tersedia';
        $kamar->save(); 
        return redirect('/admin/reservasi')->with('success', 'Berhasil menyimpan data reservasi'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservasi $reservasi, $id)
    {
        //
        //dd($id);
        $reservasi = Reservasi::findOrFail($id);
        return $reservasi;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        $validasi = $request->validate([
            'reservasi_id' => 'required|exists:reservasi,id',
            'tamu_id' => 'required|exists:tamus,id',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'status_reservasi' => 'required|in:pending,confirmed,cancelled',
        ]);

        // dd($reservasi);
        $reservasi = Reservasi::findOrFail($validasi['reservasi_id']);
        $reservasi->tamu_id = $validasi['tamu_id'];
        $reservasi->kamar_id = $validasi['kamar_id'];
        $reservasi->tanggal_checkin = $validasi['tanggal_checkin'];
        $reservasi->tanggal_checkout = $validasi['tanggal_checkout'];
        $reservasi->status_reservasi = $validasi['status_reservasi'];
        $reservasi->save();
        if ($validasi['kamar_id'] != $reservasi->kamar_id) {
            $kamar = Kamar::findOrFail($validasi['kamar_id']);
            $kamar->status = 'tidak tersedia';
            $kamar->save();

            $kamar1 = Kamar::findOrFail($reservasi->kamar_id);
            $kamar1->status = 'tersedia';
            $kamar1->save();
        }   
        return redirect('/admin/reservasi')->with('success', 'Berhasil mengupdate data reservasi'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        //dd($reservasi);
        $kamar = Kamar::findOrFail($reservasi['kamar_id']);
        $kamar->status = 'tersedia';
        $kamar->save(); 
        //
        // dd($kamar);
        try {
            $reservasi->delete();
            // Redirect kembali dengan pesan sukses
            Session::flash('success', 'Reservasi berhasil dihapus.'); //
            return redirect('/admin/reservasi');
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            Session::flash('error', 'Gagal menghapus reservasi: ' . $e->getMessage()); //
            return redirect()->back();
        }
    }
    public function getData($id)
    {
            
        $reservasi = Reservasi::with(['tamu', 'kamar'])->findOrFail($id);

        return response()->json([
            'id' => $reservasi->id,
            'tamu_id' => $reservasi->tamu_id,
            'nama_tamu' => $reservasi->tamu->nama,
            'nama_kamar' => $reservasi->kamar->nama_kamar,
            'tanggal_checkin' => $reservasi->tanggal_checkin,
            'tanggal_checkout' => $reservasi->tanggal_checkout,
            'metode_pembayaran' => $reservasi->metode_pembayaran,
            'status_reservasi' => $reservasi->status_reservasi,
        ]);
    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // tambahkan ini di atas

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $query = Pembayaran::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                // --- MODIFIKASI UNTUK PENCARIAN ID RESERVASI ---
                // 1. Bersihkan searchTerm dari '#RV' atau 'RV' jika ada
                $cleanedSearchTerm = str_replace(['#RV', 'RV', '#rv', 'rv'], '', $searchTerm);
                // 2. Pastikan hasil pembersihan adalah angka, jika tidak, abaikan atau sesuaikan
                if (is_numeric($cleanedSearchTerm)) {
                    // Cari ID reservasi berdasarkan angka yang sudah dibersihkan
                    // Menggunakan '=' untuk pencarian eksak jika reservasi_id di DB hanya angka
                    // Atau 'LIKE' jika ingin mencari '1' dan DB punya '10', '11' dll.
                    // Untuk ID eksak, '=' lebih cocok. Jika mau parsial, tetap pakai LIKE.
                    $q->where('reservasi_id', $cleanedSearchTerm);
                    // Jika ingin tetap parsial (misal cari '1' ketemu '10', '11'):
                    // $q->orWhere('reservasi_id', 'LIKE', '%' . $cleanedSearchTerm . '%');
                }


                // Pencarian berdasarkan Nama Tamu atau Email Tamu, melalui relasi Reservasi
                $q->orWhereHas('reservasi', function ($reservasiQuery) use ($searchTerm) {
                    $reservasiQuery->whereHas('tamu', function ($tamuQuery) use ($searchTerm) {
                        $tamuQuery->where('nama', 'LIKE', '%' . $searchTerm . '%')
                                  ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
                    });
                });

                // Pencarian berdasarkan Tanggal Bayar
                $q->orWhere('tanggal_bayar', 'LIKE', '%' . $searchTerm . '%');

                // Pencarian berdasarkan Jumlah
                $q->orWhere('jumlah_bayar', 'LIKE', '%' . $searchTerm . '%');

                // Pencarian berdasarkan Metode Pembayaran
                $q->orWhere('metode_bayar', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $pembayaran = $query->paginate(10);
        $pendingReservasi = Reservasi::all();
        return view('admin.pembayaran', ["pembayaran" => $pembayaran, "reservasi" => $pendingReservasi]);
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
        // dd($request);
        $validasi = $request->validate([
            'reservasi_id' => 'required|exists:reservasis,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_bayar' => 'required|string',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // max 5MB
        ]);
        //dd($request);
        
        $bukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $bukti = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }
        
        $validasi['bukti_pembayaran'] = $bukti;

        //var_dump($bukti);die;
        //var_dump($validasi);die;
        // Pembayaran::create([
        //     'bukti_pembayaran' => $validasi['bukti_pembayaran'],
        //     'reservasi_id' => $validasi['reservasi_id'],
        //     'tanggal_bayar' => $validasi['tanggal_bayar'],
        //     'jumlah_bayar' => $validasi['jumlah_bayar'],
        //     'metode_bayar' => $validasi['metode_bayar'],
        // ]);
        
        DB::unprepared(
                "INSERT INTO pembayarans (bukti_pembayaran, reservasi_id, tanggal_bayar, jumlah_bayar, metode_bayar)
                VALUES ('" . $validasi['bukti_pembayaran'] ."', '" . $validasi['reservasi_id'] ."', '" . $validasi['tanggal_bayar'] ."', '" . $validasi['jumlah_bayar'] ."', '" . $validasi['metode_bayar'] ."');"
        );

        //dd($validasi);
        return redirect()->back()->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $pembayaran = Pembayaran::with('reservasi.tamu')->findOrFail($id);

    return response()->json([
        'tamu' => $pembayaran->reservasi->tamu->nama,
        'tanggal_bayar' => $pembayaran->tanggal_bayar,
        'jumlah_bayar' => number_format($pembayaran->jumlah_bayar, 0, ',', '.'),
        'metode_bayar' => $pembayaran->metode_bayar,
        'bukti_pembayaran' => $pembayaran->bukti_pembayaran,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::with('reservasi.tamu')->findOrFail($id);
        return response()->json($pembayaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
       //dd($request);
        $request->validate([
            'id' => 'required|exists:pembayarans,id',
            'reservasi_id_edit' => 'required|exists:reservasis,id',
            'tanggal_bayar_edit' => 'required|date',
            'jumlah_bayar_edit' => 'required|numeric',
            'metode_bayar_edit' => 'required|string',
           
        ]);
        //dd($request);
        $pembayaran = Pembayaran::findOrFail($request->id);
        //dd($pembayaran);
        $pembayaran->reservasi_id = $request->reservasi_id_edit;
        $pembayaran->tanggal_bayar = $request->tanggal_bayar_edit;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar_edit;
        $pembayaran->metode_bayar = $request->metode_bayar_edit;
        


        if ($request->hasFile('bukti_pembayaran_edit')) {
            $path = $request->file('bukti_pembayaran_edit')->store('storage/bukti_pembayaran');
            $pembayaran->bukti_pembayaran = str_replace('storage/pembayaran', '', $path);
        }
        
        
        $pembayaran->save();
    
        return redirect()->back()->with('success', 'Pembayaran berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
   
        // Hapus gambar dari storage jika ada
        if ($pembayaran->bukti_pembayaran) {
            $path = 'storage/' . $pembayaran->bukti_pembayaran;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }

        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran dan bukti gambar berhasil dihapus.');
    }
}

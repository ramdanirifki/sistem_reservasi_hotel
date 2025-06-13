<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamars = Kamar::orderBy('id', 'asc')->get();
        return view('admin.manajemen_kamar', compact('kamars'));
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
            'nama_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|in:standard,superior,deluxe',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        try {
            $kamar = Kamar::create([
                'nama_kamar' => $request->nama_kamar,
                'tipe_kamar' => $request->tipe_kamar,
                'harga_per_malam' => $request->harga_per_malam,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kamar berhasil ditambahkan',
                'data' => $kamar
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kamar: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        return $kamar;
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
    public function update(Request $request, kamar $kamar)
    {
        $kamar->update($request->all());
        return $kamar;
    }

    /**
     * Remove the specified resource from storage.
     */
    // app/Http/Controllers/KamarController.php
    public function destroy(Kamar $kamar)
    {
        try {
            $kamar->delete();
            return response()->json([
                'success' => true,
                'message' => 'Kamar berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kamar: ' . $e->getMessage()
            ], 500);
        }
    }
}

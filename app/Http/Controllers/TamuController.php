<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamu = Tamu::withCount('reservasi')->get();
        return view('admin.tamu', compact('tamu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:tamus,email',
        ]);

        try {
            $tamu = Tamu::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil ditambahkan',
                'data' => $tamu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan tamu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tamu $tamu)
    {
        return $tamu;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tamu $tamu)
    {
        return response()->json([
            'id' => $tamu->id,
            'nama' => $tamu->nama,
            'email' => $tamu->email,
            'nomor_telepon' => $tamu->nomor_telepon,
            'alamat' => $tamu->alamat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tamu $tamu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:tamus,email,' . $tamu->id,
        ]);

        try {
            $tamu->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data tamu berhasil diperbarui',
                'data' => $tamu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data tamu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tamu = Tamu::findOrFail($id);
            $tamu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data tamu berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data tamu: ' . $e->getMessage()
            ], 500);
        }
    }
}

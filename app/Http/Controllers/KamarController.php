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
        return kamar::all();
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
            'tipe_kamar' => 'required',
            'harga_per_malam' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);
    
        return Kamar::create($request->all());
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
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return response()->json(['message' => 'Tamu deleted']);
    }
}

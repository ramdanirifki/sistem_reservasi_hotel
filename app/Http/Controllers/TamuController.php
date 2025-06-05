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
        $tamu = Tamu::all();
        return view('admin.pelanggan', ['tamu' => $tamu]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:tamus,email',
        ]);

        return Tamu::create($request->all());
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tamu $tamu)
    {
        $tamu->update($request->all());
        return $tamu;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tamu $tamu)
    {
        $tamu->delete();
        return response()->json(['message' => 'Tamu deleted']);
    }
}

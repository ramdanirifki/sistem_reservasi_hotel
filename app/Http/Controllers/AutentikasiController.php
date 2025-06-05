<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AutentikasiController extends Controller
{
    public static function login_admin(Request $request) {
        //dd($request);
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|"
        ]);
        //dd($data['password']);
        $admin = Admin::where('email', $data['email'])->first();
        
        //dd($admin->password);
        if  ($admin && Hash::check($data['password'], $admin->password)){
            $request->session()->regenerate();
            session()->put('email', $admin->email);
            session()->put('password', $data['password']);
            return redirect('/admin/dashboard')->with('success', 'Login berhasil');
        }else{
            return redirect('/admin/login')->with('failed', 'Login gagal');
        }
        
    }

    public static function logout (Request $request) {

    $request->session()->invalidate(); // Hapus semua session
    $request->session()->regenerateToken(); // Cegah CSRF reuse

    return redirect('/admin/login')->with('success', 'Anda berhasil logout!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    public function auth(Request $request)
    {
        $input = $request->all();

        $credentials = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(auth()->user()->is_admin == "admin"){
                return redirect()->intended('/asAdmin');
            }
            return redirect()->intended('/asStudent');
        }
        return back()->with('loginError', 'Login gagal! Silahkan coba lagi');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( Auth::user()->roles == '["superadmin"]' || Auth::user()->roles == '["admin"]' ){
            return redirect()->route('dashboard');
        }

        else if ( Auth::user()->roles == '["mahasiswa"]'){
            return redirect()->route('user.dashboard');
        }
        
    }
}

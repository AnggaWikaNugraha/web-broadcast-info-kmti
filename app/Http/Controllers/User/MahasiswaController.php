<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Event;
use App\Models\Info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (Auth::user()->roles != '["mahasiswa"]' ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $divisi = Divisi::get()->count();

        $info = Info::get()->count();

        $events = Event::where([
            ['status', '=', 'belum-mulai'],
        ])->get()->count();

        $eventsActive = Event::where([
            ['status', '=', 'belum-mulai'],
        ])
        ->orderBy('tanggal', 'ASC')
        ->paginate(5);

        return view('user.dashboard', compact(
            'divisi',
            'eventsActive', 
            'info', 
            'events'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Event;
use App\Models\Info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

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

    public function divisi(Request $request)
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ($request->ajax()) {

            $data = Divisi::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-divisi/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.divisi');
    }

    public function event(Request $request)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ($request->ajax()) {

            $data = Event::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/' . $row->foto);
                    $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-event/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['foto', 'action'])
                ->make(true);
        }

        return view('user.event');
    }

    public function profile()
    {
        $user = Auth::user();
        
        return view('user.profile' , compact(
            'user'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        
        return view('user.profile-edit' , compact(
            'user'
        ));
    }

    public function compliting()
    {
        $user = Auth::user();
        
        return view('user.profile-compliting' , compact(
            'user'
        ));
    }

}

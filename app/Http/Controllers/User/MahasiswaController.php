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
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

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

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
           return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
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

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        if ($request->ajax()) {

            $data = Divisi::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/' . $row->foto);
                    if($row->foto){
                        $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                    return $img;
                    }else{
                        $tag = '<span> - </span>' ;
                        return $tag;
                    }
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="divisi/' . $row->id . ' " class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action','foto'])
                ->make(true);
        }

        return view('user.divisi');
    }

    public function detailDivisi($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $divisi = Divisi::findOrFail($id);
        return view('user.divisi-detail', compact('divisi'));
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

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
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

                    $btn = '<a href="event/' . $row->id . '" class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['foto', 'action'])
                ->make(true);
        }

        return view('user.event');
    }

    public function detailEvent($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $event = Event::findOrFail($id);

        return view('user.event-detail', compact('event'));

    }

    public function profile()
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

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

    public function saveedit(Request $request, $id)
    {

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required",
            "email" =>  "required",
            "no_wa" =>  "required",
            "id_tele" =>  "required",
        ])->validate();

        try {
            
            $user = User::findOrFail($id);
            $user->update([
                'email' => $request['email'],
            ]);

            $user->mahasiswa()->update([
                'name' => $request['name'],
                'no_wa' => $request['no_wa'],
                'id_tele' => $request['id_tele']
            ]);

        } catch (\Throwable $th) {
            return false ;
        }

        return redirect()->route('user.profile')->with('success', ' user successfully updated');
        
    }

    public function compliting()
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $user = Auth::user();
        
        return view('user.profile-compliting' , compact(
            'user'
        ));
    }

    public function savecompliting(Request $request, $id)
    {
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "no_wa" => "required",
            "id_tele" =>  "required"
        ])->validate();

        try {

            $user = User::findOrFail($id);

            $user->mahasiswa()->update([
                'no_wa' => $request['no_wa'],
                'id_tele' => $request['id_tele']
            ]);

        }catch(\Throwable $th){
            return false;
        }

        return redirect()->route('user.profile')->with('success', ' user successfully updated');
    }

}

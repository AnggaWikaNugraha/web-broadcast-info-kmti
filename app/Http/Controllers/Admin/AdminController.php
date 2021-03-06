<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

        if (
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin' ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $users = User::where([
            ['roles', '=', 'mahasiswa'],
            ['email_verified_at', '!=', 'null'],
        ])->get()->count();

        $info = Info::get()->count();

        $events = Event::where([
            ['status', '=', 'belum-mulai'],
        ])->get()->count();

        $usersActive = User::where([
            ['roles', '=', 'mahasiswa'],
            ['email_verified_at', '!=', 'null'],
        ])
        ->orderByDesc('email_verified_at')
        ->paginate(5);

        $eventsActive = Event::where([
            ['status', '=', 'belum-mulai'],
        ])
        ->orderBy('tanggal_mulai', 'DESC')
        ->paginate(5);

        $infoMahasiswa = Info::orderBy('id', 'DESC')->paginate(5);

        return view('admin.dashboard', compact(
            'users',
            'usersActive',
            'eventsActive',
            'info',
            'infoMahasiswa',
            'events'));
    }

    public function showChangePasswordForm()
    {

        $user = Auth::user();
        return view('auth.change-password', compact('user'));
    }

    public function ChangePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);

        DB::beginTransaction();

        $user->password = Hash::make($request['password']);
        $user->email_verified_at = Carbon::now()->toDateTimeString();

        $user->save();

        DB::commit();

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->email_verified_at == null) {
                return redirect(route('show-change-password'));
            } else {

                $users = User::where([
                    ['roles', '=', '["mahasiswa"]'],
                    ['email_verified_at', '!=', 'null'],
                ])->get()->count();

                $info = Info::get()->count();

                $events = Event::get()->count();

                $usersActive = User::where([
                    ['roles', '=', '["mahasiswa"]'],
                    ['email_verified_at', '!=', 'null'],
                ])
                ->orderByDesc('created_at')
                ->paginate(5);

                return view('admin.dashboard', compact(
                    'users',
                    'usersActive', 
                    'info', 
                    'events'));
            }
        } else {
            return redirect('login');
        }
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
            'password' => 'required|confirmed|min:6'
        ]);

        $user->password = Hash::make($request['password']);
        $user->email_verified_at = Carbon::now()->toDateTimeString();

        $user->save();

        return view('admin.dashboard');
    }
}

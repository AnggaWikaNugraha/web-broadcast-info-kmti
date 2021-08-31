<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
         else{
            return view('admin.dashboard');
         }
    }

    public function showChangePasswordForm(){

        $user = Auth::user();
        return view('auth.change-password', compact('user'));
    }

    public function ChangePassword(Request $request, $id){


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
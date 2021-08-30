<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = User::where('roles', 'mahasiswa')
                ->orderByDesc('created_at')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-users/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required|min:1",
            "email" => "required|min:1",
            "roles" => "required|min:1",
            "password" => "required|min:9",
        ])->validate();

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'roles' => $request['roles'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('manage-users.create')->with('success', 'Users successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required|min:1",
            "email" => "required|min:1",
            "roles" => "required|min:1",
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');

        if ($request->get('password')) {

            $user->password = Hash::make($request['password']);
        }

        $user->save();

        return redirect()->route('manage-users.edit', [$user->id])->with('success', 'User successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-users')) {
                return $next($request);
            }

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where('roles', '["mahasiswa"]')
        ->orderByDesc('created_at')
        ->get();

        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-users/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '
                    
                    <form action="manage-users/' . $row->id . '" method="POST" class="wrapper__delete">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn__delete"
                            onclick="return confirm(\'Are You Sure Want to Delete?\')"
                            style="padding: .0em !important;font-size: xx-small;">Delete</button>
                    </form>';

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
            "username" => "required",
            "email" =>  [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::whereEmail($value)->count() > 0) {
                        $fail($attribute . ' is already used.');
                    }
                },
            ],
            "roles" => "required",
            "password" => "required|confirmed|min:9",
        ])->validate();

        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'roles' => $request['roles'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('manage-users.create')->with('success', ' user successfully created');
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
            "username" => "required|min:2",
            "email" => "required|min:1",
            "roles" => "required|min:1",
        ])->validate();

        $user = User::findOrFail($id);
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');

        if ($request->get('password')) {

            $request->validate([
                'password' => 'required|confirmed|min:6'
            ]);

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
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('manage-users.index')->with('success', 'User successfully deleted');
    }
}

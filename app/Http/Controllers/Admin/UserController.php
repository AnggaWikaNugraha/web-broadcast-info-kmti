<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect()->route('show-change-password');
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $data = User::where('roles', '["mahasiswa"]')
            ->orderByDesc('created_at')
            ->get();
        $mahasiswa = Mahasiswa::get();
        $angkatan = $mahasiswa->unique('angkatan');
        
        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rolesMhs', function ($row) {
                    return $row->roles == '["mahasiswa"]' ? 'Mahasiswa': '' ;
                })
                ->addColumn('name', function ($row) {
                    return $row->mahasiswa->name;
                })
                ->addColumn('jenis_kelamin', function ($row) {
                    return $row->mahasiswa->jenis_kelamin;
                })
                ->addColumn('nim', function ($row) {
                    return $row->mahasiswa->nim;
                })
                ->addColumn('whatsapp', function ($row) {
                    return $row->mahasiswa->no_wa;
                })
                ->addColumn('telegram', function ($row) {
                    return $row->mahasiswa->id_tele;
                })
                ->addColumn('angkatan', function ($row) {
                    return $row->mahasiswa->angkatan;
                })
                ->addColumn('status', function ($row) {
                    return $row->mahasiswa->status == '["anggota"]' ? '<div class="badge badge-warning">Anggota KMTI</div>' : '<div class="badge badge-success">Pengurus KMTI</div>';
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-users/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                  
                    if (Auth::user()->roles == '["superadmin"]') {
                        $btn .= '
                    
                        <form action="manage-users/' . $row->id . '" method="POST" class="wrapper__delete">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn__delete"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;font-size: xx-small;">Delete</button>
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action', 'nim', 'jenis_kelamin' , 'whatsapp', 'telegram', 'status', 'angkatan', 'rolesMhs'])
                ->make(true);
        }

        return view('admin.users.index', compact(
            'angkatan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

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

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required",
            // "nim" => "required|min:11|max:12",
            "nim" => [
                'required',
                'min:11',
                'max:12',
                function ($attribute, $value, $fail) {
                    if (Mahasiswa::whereNim($value)->count() > 0) {
                        $fail($attribute . ' is already used.');
                    }
                }
            ],
            "email" =>  [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::whereEmail($value)->count() > 0) {
                        $fail($attribute . ' is already used.');
                    }
                },
            ],
            "angkatan" => "required|min:4|max:5",
        ])->validate();

        DB::beginTransaction();
        try {

            // create user
            $new_user = new \App\Models\User();
            $new_user->email = $request['email'];
            $new_user->roles = $request['roles'];
            $new_user->password = Hash::make($request['nim']);
            $new_user->save();

            $new_user->user_id = $new_user->id;
            $new_user->name = $request['name'];
            $new_user->nim = $request['nim'];
            $new_user->jenis_kelamin = $request['jenis_kelamin'];
            $new_user->angkatan = $request['angkatan'];

            // create mahasiswa using foreign user_id on users
            $new_mahasiswa = new \App\Models\Mahasiswa();
            $new_mahasiswa->name = $new_user->name;
            $new_mahasiswa->nim = $new_user->nim;
            $new_mahasiswa->jenis_kelamin = $new_user->jenis_kelamin;
            $new_mahasiswa->angkatan = $new_user->angkatan;
            $new_mahasiswa->user()->associate($new_user->id);
            $new_mahasiswa->save();
            
            DB::commit();
            
        } catch (\Throwable $th) {
            return false;
        }

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

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

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

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required",
            "email" =>  "required",
        ])->validate();

        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);
            
            $user->update([
                'email' => $request['email'],
            ]);

            $user->mahasiswa()->update([
                'jenis_kelamin' => $request['jenis_kelamin'],
                'name' => $request['name'],

            ]);

            DB::commit();
            
        } catch (\Throwable $th) {
            return false;
        }

        return redirect()->route('manage-users.index')->with('success', ' user successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if ( Auth::user()->roles != '["superadmin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('manage-users.index')->with('success', 'User successfully deleted');
    }
}

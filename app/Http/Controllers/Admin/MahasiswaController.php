<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Gate;

class MahasiswaController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-mahasiswa')) {
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
        $data = Mahasiswa::orderByDesc('created_at')->get();
        
        if ($request->ajax()) {


            return Datatables::of($data)
                ->addIndexColumn()
                // get relasi one to one belongsto
                ->addColumn('email', function ($row) {
                   return $row->user->email;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-mahasiswa/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '
                    
                    <form action="manage-mahasiswa/' . $row->id . '" method="POST" class="wrapper__delete">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn__delete"
                            onclick="return confirm(\'Are You Sure Want to Delete?\')"
                            style="padding: .0em !important;font-size: xx-small;">Delete</button>
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action','email'])
                ->make(true);
        }
        return view('admin.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
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
            "name" => "required",
            "nim" => "required|min:11|max:12",
            "angkatan" => "required|min:4|max:5",
            "user_id" => [
                "required",
                function ($attribute, $value, $fail) {
                    if (Mahasiswa::whereUser_id($value)->count() > 0) {
                        $fail('Email is already used.');
                    }
                },
            ],
        ])->validate();

        $new_mahasiswa = new \App\Models\Mahasiswa();

        $new_mahasiswa->name = $request->get('name');
        $new_mahasiswa->nim = $request->get('nim');
        $new_mahasiswa->no_wa = $request->get('no_wa');
        $new_mahasiswa->angkatan = $request->get('angkatan');
        $new_mahasiswa->id_tele = $request->get('id_tele');

        // insert relasi one to one belongto
        $new_mahasiswa->user()->associate($request->get('user_id'));

        $new_mahasiswa->save();

        return redirect()->route('manage-mahasiswa.create')->with('success', ' Mahasiswa successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $mahasiswa = Mahasiswa::findOrFail($id);
        $email =  User::findOrFail($mahasiswa->user_id);

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'email'));
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
            "name" => "required",
            "nim" => "required|min:11|max:12",
            "angkatan" => "required|min:4|max:5",
            "user_id" => "required",
        ])->validate();

        $new_mahasiswa = Mahasiswa::findOrFail($id);

        $new_mahasiswa->name = $request->get('name');
        $new_mahasiswa->nim = $request->get('nim');
        $new_mahasiswa->no_wa = $request->get('no_wa');
        $new_mahasiswa->angkatan = $request->get('angkatan');
        $new_mahasiswa->id_tele = $request->get('id_tele');
        $new_mahasiswa->user_id = $request->get('user_id');

        $new_mahasiswa->save();
        return redirect()->route('manage-mahasiswa.edit', [$new_mahasiswa->id])->with('success', 'Mahasiswa successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $data->delete();

        return redirect()->route('manage-mahasiswa.index')->with('success', 'Mahasiswa successfully deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $username = \App\Models\User::where("email", "LIKE", "%$keyword%")->get();

        return $username;
    }
}

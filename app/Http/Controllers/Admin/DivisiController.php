<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
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
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
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

                    $btn = '<a href="manage-divisi/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '
                    
                    <form action="manage-divisi/' . $row->id . '" method="POST" class="wrapper__delete">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn__delete"
                            onclick="return confirm(\'Are You Sure Want to Delete?\')"
                            style="padding: .0em !important;font-size: xx-small;">Delete</button>
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action','foto'])
                ->make(true);
        }

        return view('admin.divisi.index');
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
        return view('admin.divisi.create');
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
            "nama_divisi" => "required",
            "fungsi" => "required",
            "keterangan" => "required",
        ])->validate();

        DB::beginTransaction();

        $new_divisi = new Divisi();
        $new_divisi->nama_divisi = $request->get('nama_divisi');
        $new_divisi->keterangan = $request->get('keterangan');
        $new_divisi->fungsi = $request->get('fungsi');

        $foto = $request->file('foto');
        if ($foto) {
            $foto_path = $foto->store('divisi', 'public');
            $new_divisi->foto = $foto_path;
        }

        $new_divisi->save();

        DB::commit();

        return redirect()->route('manage-divisi.create')->with('success', ' Divisi successfully created');
    
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
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $divisi = Divisi::findOrFail($id);
        return view('admin.divisi.edit', compact('divisi'));
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
            "nama_divisi" => "required",
            "fungsi" => "required",
            "keterangan" => "required",
        ])->validate();

        DB::beginTransaction();

        $new_divisi = Divisi::findOrFail($id);
        $new_divisi->nama_divisi = $request->get('nama_divisi');
        $new_divisi->fungsi = $request->get('fungsi');
        $new_divisi->keterangan = $request->get('keterangan');

         // handle image
         $foto = $request->file('foto');
         if ($foto) {

            if($new_divisi->foto && file_exists(storage_path('app/public/' . $new_divisi->foto))){
                \Storage::delete('public/'. $new_divisi->foto);
            }

            $foto_path = $foto->store('photos', 'public');
            $new_divisi->foto = $foto_path;
        }

        $new_divisi->save();

        DB::commit();
        
        return redirect()->route('manage-divisi.edit', [$new_divisi->id])->with('success', 'Divisi successfully updated');
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

        if (
            Auth::user()->roles != '["superadmin"]' && 
            Auth::user()->roles != '["admin"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $divisi = Divisi::findOrFail($id);
        $divisi->delete();

        return redirect()->route('manage-divisi.index')->with('success', 'Divisi successfully deleted');
    }
}

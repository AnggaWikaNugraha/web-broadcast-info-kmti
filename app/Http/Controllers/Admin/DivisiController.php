<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use DataTables;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Divisi::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
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
                ->rawColumns(['foto', 'action'])
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
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama_divisi" => "required",
        ])->validate();

        $new_divisi = new Divisi();
        $new_divisi->nama_divisi = $request->get('nama_divisi');

        $new_divisi->save();

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
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama_divisi" => "required",
        ])->validate();

        $new_divisi = Divisi::findOrFail($id);
        $new_divisi->nama_divisi = $request->get('nama_divisi');

        $new_divisi->save();
        
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
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();

        return redirect()->route('manage-divisi.index')->with('success', 'Divisi successfully deleted');
    }
}

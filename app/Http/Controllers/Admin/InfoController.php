<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\DivisiMahasiswa;
use App\Models\Info;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class InfoController extends Controller
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

        $data = Info::orderByDesc('created_at')->get();
     
        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="manage-info/' . $row->id . '" class="edit btn btn-primary btn-sm">Detail</a>';
                    return $btn;
                })
                ->addColumn('tanggal_kirim', function ($row) {
                    return $row->mahasiswa()->first()->pivot->tanggal_kirim;
                })
                ->addColumn('divisi', function ($row) {
                    $item = $row->divisi !== null?  $row->divisi->nama_divisi : '<div class="badge badge-info">Anggota KMTI</div>';
                    return $item;
                })
                ->rawColumns(['action','tanggal_kirim', 'terkirim', 'divisi'])
                ->make(true);
        }

        return view('admin.info.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.info.create');
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
            "subject" => "required",
            "content" => "required",
        ])->validate();

        if($request['status'] == '["anggota"]' ){
            $mahasiswa = Mahasiswa::whereNotNull('no_wa')->get();
        }else if ($request['divisi'] !== null){
            $mahasiswa = Mahasiswa::whereHas('divisi', function ($q) use($request) {
                $q->whereIn('divisi_id', [$request['divisi']]);
            })->get();
        }
        
        DB::beginTransaction();

        $new_info = new Info();
        $new_info->subject = $request->get('subject');
        $new_info->content = $request->get('content');

        if ($request['divisi'] !== null) {
            $new_info->divisi()->associate($request['divisi']);
        }

        $new_info->save();

        $new_info->mahasiswa()->attach($mahasiswa);

        DB::commit();

        return redirect()->route('manage-info.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Info::findOrFail($id);

        return view('admin.info.detail', compact(
            'info'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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
        //
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

    public function searchDivisi(Request $request){
        $keyword = $request->get('q');
       
        $info = \App\Models\Divisi::where("nama_divisi", "LIKE", "%$keyword%")->get();
       
        return $info;
    }

}

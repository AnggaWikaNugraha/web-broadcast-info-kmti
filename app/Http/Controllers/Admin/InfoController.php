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

use function PHPSTORM_META\map;

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
                    return $row->mahasiswa()->first() ? $row->mahasiswa()->first()->pivot->tanggal_kirim : '';
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
        }else{

            \Illuminate\Support\Facades\Validator::make($request->all(), [
                "divisi" => "required",
            ])->validate();
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

        $isi = [];
        
        if ($request['divisi'] !== null) {
            
            $divisi = Divisi::findOrFail($request['divisi']);

            foreach ($mahasiswa as $value) {
                array_push($isi, (object)[
                    'phone' => $value->no_wa,
                    'message' => 
                    "*[INFO KMTI]*
                    *Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*
                    
                    *Subject* : " . $request['subject'] . "
                    *Terkirim ke* : " . $divisi->nama_divisi . "
                    *Pemberitahuan* : " . $request['content'] ,
                    'secret' => false, // or true
                    'priority' => false, // or true
                ]);
            }

        } else {
            
            foreach ($mahasiswa as $value) {
                array_push($isi, (object)[
                    'phone' => $value->no_wa,
                    'message' => 
                    "*[INFO KMTI]*
                    *Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*
                    
                    *Subject* : " . $request['subject'] . "
                    *Terkirim Ke* : Anggota KMTI
                    *Pemberitahuan* : " . $request['content'] ,
                    'secret' => false, // or true
                    'priority' => false, // or true
                ]);
            }

        }
    
    
        $payload = [ "data" => $isi];

        // dd($payload);
        // $this->kirimWablas($payload);

        DB::commit();

        return redirect()->route('manage-info.index');
    }

    function kirimWablas($content)
    {   
        $payload = $content;
         
        $curl = curl_init();
        $token = env('WABLASS_TOKEN');
 
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL, env('WABLASS_BRODCAST'));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    
        $result = curl_exec($curl);
        curl_close($curl); 
        
        return $result;
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

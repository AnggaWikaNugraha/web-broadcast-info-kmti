<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\DivisiMahasiswa;
use App\Models\Event;
use App\Models\Info;
use App\Models\InfoMahasiswa;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class MahasiswaController extends Controller
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

        if (Auth::user()->roles != '["mahasiswa"]' ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
           return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $user = Auth::user();

        $mahasiswa = Mahasiswa::findOrfail($user->mahasiswa->id);

        $divisi = Divisi::where('keterangan', 'Divisi KMTI')->get()->count();

        $info = Info::whereHas('mahasiswa', function($q) use($mahasiswa){
            $q->whereIn('mahasiswa_id', [$mahasiswa->id]);
        })->count();

        $events = Event::where([
            ['status', '=', 'belum-mulai'],
        ])->get()->count();

        $eventsActive = Event::where([
            ['status', '=', 'belum-mulai'],
        ])
        ->orderBy('tanggal', 'DESC')
        ->paginate(5);

        $infoMahasiswa = Info::whereHas('mahasiswa', function($q) use($mahasiswa){
            $q->whereIn('mahasiswa_id', [$mahasiswa->id]);
        })
        ->orderBy('id', 'DESC')
        ->paginate(5);

        return view('user.dashboard', compact(
            'divisi',
            'eventsActive', 
            'info', 
            'infoMahasiswa',
            'events'));
    }

    public function divisi(Request $request)
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
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

                    $btn = '<a href="divisi/' . $row->id . ' " class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['action','foto'])
                ->make(true);
        }

        return view('user.divisi');
    }

    public function detailDivisi($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $divisi = Divisi::findOrFail($id);
        return view('user.divisi-detail', compact('divisi'));
    }
    
    public function event(Request $request)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        if ($request->ajax()) {

            $data = Event::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('statusEvent', function ($row) {
                    $hasil = $row->status == 'belum-mulai' ? '<div class="badge badge-warning">belum-mulai</div>' : $hasil = $row->status == 'sudah-selesai' ? ' <div class="badge badge-success">sudah-selesai</div>' : '<div class="badge badge-danger">Cancel</div>'  ;
                    return $hasil;
                })
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/' . $row->foto);
                    $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="event/' . $row->id . '" class="edit btn btn-primary btn-sm">Detail</a>';

                    return $btn;
                })
                ->rawColumns(['foto', 'action','statusEvent'])
                ->make(true);
        }

        return view('user.event');
    }

    public function detailEvent($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $event = Event::findOrFail($id);

        return view('user.event-detail', compact('event'));

    }

    public function profile()
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ( Auth::user()->mahasiswa->id_tele == null || Auth::user()->mahasiswa->no_wa == null) {
            return redirect()->route('user.profile.compliting')->with('warning', 'anda belum melengkapi data diri !');
        }

        $user = Auth::user();

        $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();
        
        return view('user.profile' , compact(
            'user',
            'mhs'
        ));
    }

    public function edit()
    {

        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();
        
        return view('user.profile-edit' , compact(
            'user',
            'mhs'
        ));
    }

    public function saveedit(Request $request, $id)
    {
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "name" => "required",
            "no_wa" =>  "required",
            "id_tele" =>  "required",
        ])->validate();

        DB::beginTransaction();

        try {
            
            $user = User::findOrFail($id);

            $user->mahasiswa()->update([
                'name' => $request['name'],
                'no_wa' => $request['no_wa'],
                'id_tele' => $request['id_tele'],
            ]);


            if($request['divisi']){
                $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();
                $mhs->divisi()->sync($request['divisi']);
            }

            if ($request['status'] == '["anggota"]' ) {
              
                $user->mahasiswa()->update([
                    'status' => $request['status']
                ]);

                DivisiMahasiswa::where('mahasiswa_id', $user->mahasiswa->id )->delete() ;
                
            }else{

                $user->mahasiswa()->update([
                    'status' => $request['status']
                ]);
            }

            DB::commit();

        } catch (\Throwable $th) {
            return false ;
        }

        return redirect()->route('user.profile')->with('success', ' user successfully updated');
        
    }

    public function compliting()
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $user = Auth::user();
        
        return view('user.profile-compliting' , compact(
            'user'
        ));
    }

    public function savecompliting(Request $request, $id)
    {
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "no_wa" => "required",
            "id_tele" =>  "required"
        ])->validate();

        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);

            $user->mahasiswa()->update([
                'no_wa' => $request['no_wa'],
                'id_tele' => $request['id_tele'],
                'status' => $request['status']
            ]);

            if($request['divisi']){
                $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();
                $mhs->divisi()->attach($request['divisi']);
            }

            DB::commit();
            
        }catch(\Throwable $th){
            dd($th);
            return false;
        }

        return redirect()->route('user.profile')->with('success', ' user successfully updated');
    }

    public function searchDivisi(Request $request){
        $keyword = $request->get('q');
       
        $info = \App\Models\Divisi::where("nama_divisi", "LIKE", "%$keyword%")->get();
       
        return $info;
    }

    public function info(Request $request)
    {

        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $user = Auth::user();
        $mahasiswa = Mahasiswa::findOrfail($user->mahasiswa->id);

        $info = Info::whereHas('mahasiswa', function($q) use($mahasiswa){
            $q->whereIn('mahasiswa_id', [$mahasiswa->id]);
        })
        ->orderBy('id', 'DESC')
        ->get();

        if ($request->ajax()) {

            return Datatables::of($info)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use($mahasiswa) {
                    // $btn = '<a href="info/' . $row->id . '/detail" class="edit btn btn-primary btn-sm">Lihat info</a>';
                    $btn = '
                    
                    <form action="info/' . $row->mahasiswa()->first()->pivot->id . '/detail" method="POST" class="wrapper__delete" enctype="multipart/form-data">
                        ' . csrf_field() . '
                        ' . method_field("PATCH") . '
                        <button class="btn btn-info text-white">Lihat info</button>
                    </form>
                    
                    ';

                    return $btn;

                })
                ->addColumn('tanggal_kirim', function ($row) {
                    return $row->mahasiswa()->first()->pivot->tanggal_kirim;
                })
                ->addColumn('status', function ($row) {
                    $hasil = $row->mahasiswa()->first()->pivot->status == 'active' ? ' <div class="badge badge-warning">Belum terbaca</div>' : '  <div class="badge badge-success">Sudah terbaca</div>';
                    return $hasil;
                })
                ->rawColumns(['action','tanggal_kirim', 'status'])
                ->make(true);
        }

        return view('user.info');

    }

    public function infoDetail($id)
    {
        
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != '["mahasiswa"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $info = Info::findOrFail($id);

        return view('user.info-detail', compact(
            'info'
        ));
    }

    public function infoRead($id)
    {
        // $user = Auth::user();

        // $mahasiswa = Mahasiswa::findOrfail($user->mahasiswa->id);
        dd($id);
        $new_info = InfoMahasiswa::findOrFail($id);
        $new_info->status = 'deactive';

        $new_info->save();


        return redirect()->route('user.infoDetail', [$new_info->info->id])->with('success', 'Info successfully read');
  
    }
}
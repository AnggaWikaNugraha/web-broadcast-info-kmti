<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use App\Models\Info;

class EventController extends Controller
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
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        if ($request->ajax()) {

            $data = Event::orderByDesc('created_at')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/' . $row->foto);
                    $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                    return $img;
                })
                ->addColumn('statusEvent', function ($row) {
                    if ($row->status == 'belum-mulai') {
                        $hasil = '<div class="badge badge-warning">belum-mulai</div>';
                    }
                    if ($row->status == 'mulai') {
                        $hasil = '<div class="badge badge-primary">mulai</div>';
                    }
                    if ($row->status == 'sudah-selesai') {
                        $hasil = '<div class="badge badge-success">sudah-selesai</div>';
                    }
                    if ($row->status == 'cancel') {
                        $hasil = '<div class="badge badge-danger">Cancel</div>';
                    }
                    return $hasil;
                })
                ->addColumn('action', function ($row) {
                    $path = 'public/event/' . $row->id . '/files/';
                    $btn = '';
                    $btn .= '<a href="manage-event/' . $row->id . '" class="edit ml-1 btn btn-primary btn-sm">Detail</a>';
                    if ($row->status == 'belum-mulai' || $row->status == 'cancel' || $row->status == 'mulai') {
                        $btn .= '<a href="manage-event/' . $row->id . '/edit" class="edit ml-1 btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->roles == 'superadmin') {
                        $btn .= '

                        <form action="manage-event/' . $row->id . '" method="POST" class="wrapper__delete">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn__delete"
                                onclick="return confirm(\'apakah yakin ingin menghapus data?\')"
                                style="padding: .0em !important;font-size: xx-small;">Delete</button>
                        </form>';
                    }
                    if (Auth::user()->roles == 'admin') {
                        if ($row->status == 'sudah-selesai') {
                            if (!Storage::exists($path)) {
                                $btn .= '<a href="/event/compliting/' . $row->id  . '/submit-laporan" class="edit ml-1 btn btn-success btn-sm">Submit laporan</a>';
                            }
                        }
                    }
                    if (Auth::user()->roles == 'admin') {
                        if ($row->status == 'sudah-selesai') {
                            if (Storage::exists($path)) {
                                $btn .= '<a href="/event/compliting/' . $row->id  . '/edit-laporan" class="edit ml-1 btn btn-secondary btn-sm">Edit laporan</a>';
                            }
                        }
                    }
                    if (Auth::user()->roles == 'superadmin') {
                        if ($row->status == 'sudah-selesai') {
                            if (Storage::exists($path)) {
                                $btn .= '<a href="/event/compliting/' . $row->id  . '/download-laporan" class="edit ml-1 btn btn-secondary btn-sm">laporan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                              </svg></a>';
                            }
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['foto', 'action', 'statusEvent'])
                ->make(true);
        }

        return view('admin.event.index');
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
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        return view('admin.event.create');
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
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama" => "required",
            "tanggal_mulai" => "required",
            "tanggal_berakhir" => 'required',
            "jam_mulai" => "required",
            "jam_berakhir" => "required",
            "lokasi" => "required",
            "keterangan" => "required",
        ])->validate();

        $mahasiswa = [];
        $terkirim = null;
        $isi = [];

        $mahasiswa = Mahasiswa::whereNotNull('no_wa')->get();
            $terkirim = 'Anggota KMTI';


            foreach ($mahasiswa as $value) {
                array_push($isi, (object)[
                    'phone' => $value->no_wa,
                    'message' =>
"*[INFO KMTI]*
*Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*

Subject : " . $request['nama'] . "
Terkirim : " . $terkirim . "
Pemberitahuan : KMTI mengadakan " . $request['nama'] . " yang akan dilaksanakan :
tanggal berlangsung : " . $request['tanggal_mulai'] . "
tanggal berakhir : " . $request['tanggal_berakhir'] . "
berlokasi di : " . $request['lokasi']. "
Untuk itu jangan lupa berpartisipasi dan ikut memeriahkan ya. Tungguin harinya !
keterangan : " . $request['keterangan'],
                    'secret' => false, // or true
                    'priority' => false, // or true
                ]);
            }

        DB::beginTransaction();

        $new_event = new Event();
        $new_event->nama = $request->get('nama');
        $new_event->tanggal_mulai = $request->get('tanggal_mulai');
        $new_event->tanggal_berakhir = $request->get('tanggal_berakhir');
        $new_event->jam_mulai = $request->get('jam_mulai');
        $new_event->jam_berakhir = $request->get('jam_berakhir');
        $new_event->lokasi = $request->get('lokasi');
        $new_event->keterangan = $request->get('keterangan');
        $new_event->status = 'belum-mulai';

        // handle image
        $foto = $request->file('foto');
        // $defaultPhoto = ;
        if ($foto) {
            $foto_path = $foto->store('photos', 'public');
            $new_event->foto = $foto_path;
        }

        $new_event->save();
        $payload = [ "data" => $isi];

        // dd($payload);
        $this->kirimWablas($payload);

        DB::commit();

        return redirect()->route('manage-event.create')->with('success', ' Event successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $path = 'public/event/' . $id . '/files/';
        $pathDownload = 'event/' . $id . '/files/';
        $laporanKegiatan = null;
        $laporanKeuangan = null;

        $extentions = ['.xlsx', '.docx'];
        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-kegiatan' . $ext)) {
                $laporanKegiatan = $pathDownload . 'laporan-kegiatan' . $ext;
            }
        }

        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-keuangan' . $ext)) {
                $laporanKeuangan = $pathDownload . 'laporan-keuangan' . $ext;
            }
        }

        return view('admin.event.detail', compact(
            'event',
            'laporanKegiatan',
            'laporanKeuangan'
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
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $event = Event::findOrFail($id);
        $path = 'public/event/' . $id . '/files/';

        $laporanKegiatan = null;
        $laporanKeuangan = null;
        $pathDownload = 'event/' . $id . '/files/';

        $extentions = ['.xlsx', '.docx'];
        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-kegiatan' . $ext)) {
                $laporanKegiatan = $pathDownload . 'laporan-kegiatan' . $ext;
            }
        }

        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-keuangan' . $ext)) {
                $laporanKeuangan = $pathDownload . 'laporan-keuangan' . $ext;
            }
        }

        return view('admin.event.edit', compact(
            'event',
            'laporanKegiatan',
            'laporanKeuangan'
        ));
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
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama" => "required",
            "tanggal_mulai" => "required",
            "tanggal_berakhir" => 'required',
            "jam_mulai" => "required",
            "jam_berakhir" => "required",
            "lokasi" => "required",
            "keterangan" => "required",

        ])->validate();

        DB::beginTransaction();

        $new_event = Event::findOrFail($id);
        $new_event->nama = $request->get('nama');
        $new_event->tanggal_mulai = $request->get('tanggal_mulai');
        $new_event->tanggal_berakhir = $request->get('tanggal_berakhir');
        $new_event->jam_mulai = $request->get('jam_mulai');
        $new_event->jam_berakhir = $request->get('jam_berakhir');
        $new_event->lokasi = $request->get('lokasi');
        $new_event->keterangan = $request->get('keterangan');
        $new_event->status = $request->get('status');

        // handle image and file
        $foto = $request->file('foto');
        $NewLaporanKegiatan = $request->file('laporan-kegiatan');
        $NewLaporanKeuangan = $request->file('laporan-keuangan');
        $laporanKegiatan = $request->file('laporan-kegiatan');
        $laporanKeuangan = $request->file('laporan-keuangan');
        $path = 'public/event/' . $id . '/files/';

        if ($foto) {

            if ($new_event->foto && file_exists(storage_path('app/public/' . $new_event->foto))) {
                \Storage::delete('public/' . $new_event->foto);
            }

            $foto_path = $foto->store('photos', 'public');
            $new_event->foto = $foto_path;
        }

        $extentions = ['.xlsx', '.docx'];

        if ($laporanKegiatan) {
            foreach ($extentions as $ext) {
                if (Storage::exists($path . 'laporan-kegiatan' . $ext)) {
                    $laporanKegiatan = $path . 'laporan-kegiatan' . $ext;
                    Storage::delete($laporanKegiatan);
                }
            }
        }
        if ($NewLaporanKegiatan) {
            Storage::putFileAs($path, $NewLaporanKegiatan, 'laporan-kegiatan.' . pathinfo($_FILES['laporan-kegiatan']['name'], PATHINFO_EXTENSION));
        }

        if ($laporanKeuangan) {
            foreach ($extentions as $ext) {
                if (Storage::exists($path . 'laporan-keuangan' . $ext)) {
                    $laporanKeuangan = $path . 'laporan-keuangan' . $ext;
                    Storage::delete($laporanKeuangan);
                }
            }
        }
        if ($NewLaporanKeuangan) {
            Storage::putFileAs($path, $NewLaporanKeuangan, 'laporan-keuangan.' . pathinfo($_FILES['laporan-keuangan']['name'], PATHINFO_EXTENSION));
        }

        $mahasiswa = [];
        $terkirim = null;
        $isi = [];

        $mahasiswa = Mahasiswa::whereNotNull('no_wa')->get();
        $terkirim = 'Anggota KMTI';

        if ($request->get('status') === 'mulai') {
            foreach ($mahasiswa as $value) {
                array_push($isi, (object)[
                    'phone' => $value->no_wa,
                    'message' =>
"*[INFO KMTI]*
*Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*

Subject : " . $request['nama'] . "
Terkirim : " . $terkirim . "
Pemberitahuan : Halo semua ! Event " . $request['nama'] . " sudah mulai hari ini sampai tanggal " . $request['tanggal_berakhir'] . " berlokasi di " . $request['lokasi']. " Untuk itu jangan lupa datang untuk memeriahkan ya!.
keterangan : " . $request['keterangan'],
                    'secret' => false, // or true
                    'priority' => false, // or true
                ]);
            }
        }

//         if ($request->get('status') === 'sudah-selesai') {
//             foreach ($mahasiswa as $value) {
//                 array_push($isi, (object)[
//                     'phone' => $value->no_wa,
//                     'message' =>
// "*[INFO KMTI]*
// *Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*

// Subject : " . $request['nama'] . "
// Terkirim : " . $terkirim . "
// Pemberitahuan : Halo semua ! Event " . $request['nama'] . " sudah selesai.
// Terimakasih untuk semua yang telah memeriahkan event kami!.",
//                     'secret' => false, // or true
//                     'priority' => false, // or true
//                 ]);
//             }
//         }

        if ($request->get('status') === 'cancel') {
            foreach ($mahasiswa as $value) {
                array_push($isi, (object)[
                    'phone' => $value->no_wa,
                    'message' =>
"*[INFO KMTI]*
*Ini adalah pesan otomatis yang dikirim melalui sistem KMTI, diharapkan untuk tidak membalas pesan di nomor ini.*

Subject : " . $request['nama'] . "
Terkirim : " . $terkirim . "
Pemberitahuan : Halo semua ! Event " . $request['nama'] . " cancel/batal.
Mohon maaf untuk ketidaknyamanan kami, terimakasih!.",
                    'secret' => false, // or true
                    'priority' => false, // or true
                ]);
            }
        }

        $new_event->save();
        $payload = [ "data" => $isi];

        // dd($payload);
        $this->kirimWablas($payload);

        DB::commit();

        return redirect()->route('manage-event.edit', [$new_event->id])->with('success', 'Event successfully updated');
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
            Auth::user()->roles != 'superadmin' &&
            Auth::user()->roles != 'admin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $data = Event::findOrFail($id);
        $data->delete();

        return redirect()->route('manage-event.index')->with('success', 'Event successfully deleted');
    }

    public function complitingEvent()
    {
        return view('admin.event.complitingEvent');
    }

    function ShowSaveCompliting($id)
    {
        $event = Event::findOrFail($id);
        $path = 'public/event/' . $id . '/files/';

        if ( Auth::user()->roles == 'admin') {
            if ($event->status == 'sudah-selesai') {

                if (!Storage::exists($path)) {
                    return view('admin.event.complitingEvent', compact('event'));
                }
            }
        }
    }

    public function saveComplitingEvent(Request $request, $id)
    {

        \Illuminate\Support\Facades\Validator::make($request->all(), [
          "laporan-kegiatan" => "required",
          "laporan-keuangan" => "required",
      ])->validate();

        // handle image
        $laporanKegiatan = $request->file('laporan-kegiatan');
        $laporanKeuangan = $request->file('laporan-keuangan');

        $path = 'public/event/' . $id . '/files/';
        if ($laporanKegiatan) {
            Storage::putFileAs($path, $laporanKegiatan, 'laporan-kegiatan.' . pathinfo($_FILES['laporan-kegiatan']['name'], PATHINFO_EXTENSION));
        }

        if ($laporanKeuangan) {
            Storage::putFileAs($path, $laporanKeuangan, 'laporan-keuangan.' . pathinfo($_FILES['laporan-keuangan']['name'], PATHINFO_EXTENSION));
        }

        return redirect()->route('manage-event.index');
    }

    function ShowEditCompliting($id)
    {
        $event = Event::findOrFail($id);
        $path = 'public/event/' . $id . '/files/';

        if ( Auth::user()->roles == 'admin') {
            if ($event->status == 'sudah-selesai') {

                return view('admin.event.editComplitingEvent', compact('event'));
            }
        }
    }

    public function SaveShowEditCompliting(Request $request, $id)
    {

        \Illuminate\Support\Facades\Validator::make($request->all(), [
          "laporan-kegiatan" => "required",
          "laporan-keuangan" => "required",
      ])->validate();

        // dd($request);

        $NewLaporanKegiatan = $request->file('laporan-kegiatan');
        $NewLaporanKeuangan = $request->file('laporan-keuangan');
        $laporanKegiatan = $request->file('laporan-kegiatan');
        $laporanKeuangan = $request->file('laporan-keuangan');

        $path = 'public/event/' . $id . '/files/';
        $extentions = ['.xlsx', '.docx'];

        if ($laporanKegiatan) {
            foreach ($extentions as $ext) {
                if (Storage::exists($path . 'laporan-kegiatan' . $ext)) {
                    $laporanKegiatan = $path . 'laporan-kegiatan' . $ext;
                    Storage::delete($laporanKegiatan);
                }
            }
        }
        if ($NewLaporanKegiatan) {
            Storage::putFileAs($path, $NewLaporanKegiatan, 'laporan-kegiatan.' . pathinfo($_FILES['laporan-kegiatan']['name'], PATHINFO_EXTENSION));
        }

        if ($laporanKeuangan) {
            foreach ($extentions as $ext) {
                if (Storage::exists($path . 'laporan-keuangan' . $ext)) {
                    $laporanKeuangan = $path . 'laporan-keuangan' . $ext;
                    Storage::delete($laporanKeuangan);
                }
            }
        }
        if ($NewLaporanKeuangan) {
            Storage::putFileAs($path, $NewLaporanKeuangan, 'laporan-keuangan.' . pathinfo($_FILES['laporan-keuangan']['name'], PATHINFO_EXTENSION));
        }

        return redirect()->route('manage-event.index');
    }

    public function downloadLaporan($id)
    {
        if (Auth::user()->email_verified_at == null) {
            return redirect(route('show-change-password'));
        }

        if (
            Auth::user()->roles != 'superadmin'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $path = 'public/event/' . $id . '/files/';

        $laporanKegiatan = null;
        $laporanKeuangan = null;
        $pathDownload = 'event/' . $id . '/files/';

        $extentions = ['.xlsx', '.docx'];
        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-kegiatan' . $ext)) {
                $laporanKegiatan = $pathDownload . 'laporan-kegiatan' . $ext;
            }
        }

        foreach ($extentions as $ext) {
            if (Storage::exists($path . 'laporan-keuangan' . $ext)) {
                $laporanKeuangan = $pathDownload . 'laporan-keuangan' . $ext;
            }
        }

        return view('admin.event.downloadLaporanEvent', compact(
            'laporanKegiatan',
            'laporanKeuangan'
        ));
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
}

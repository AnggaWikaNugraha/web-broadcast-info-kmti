<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
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
                    $hasil = $row->status == 'belum-mulai' ? '<div class="badge badge-warning">belum-mulai</div>' : $hasil = $row->status == 'sudah-selesai' ? ' <div class="badge badge-success">sudah-selesai</div>' : '<div class="badge badge-danger">Cancel</div>';
                    return $hasil;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="manage-event/' . $row->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '
                    
                    <form action="manage-event/' . $row->id . '" method="POST" class="wrapper__delete">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn__delete"
                            onclick="return confirm(\'Are You Sure Want to Delete?\')"
                            style="padding: .0em !important;font-size: xx-small;">Delete</button>
                    </form>';
                    $btn .= '<a href="manage-event/' . $row->id . '" class="edit ml-1 btn btn-primary btn-sm">Detail</a>';

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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama" => "required",
            "foto" => "required",
            "tanggal" => "required",
            "jam_mulai" => "required",
            "jam_berakhir" => "required",
            "lokasi" => "required",
            "keterangan" => "required",
        ])->validate();

        DB::beginTransaction();

        $new_event = new Event();
        $new_event->nama = $request->get('nama');
        $new_event->tanggal = $request->get('tanggal');
        $new_event->jam_mulai = $request->get('jam_mulai');
        $new_event->jam_berakhir = $request->get('jam_berakhir');
        $new_event->lokasi = $request->get('lokasi');
        $new_event->keterangan = $request->get('keterangan');
        $new_event->status = 'belum-mulai';

        // handle image
        $foto = $request->file('foto');
        if ($foto) {
            $foto_path = $foto->store('photos', 'public');
            $new_event->foto = $foto_path;
        }

        $new_event->save();

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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        $event = Event::findOrFail($id);
        $path = 'public/event/' . $id . '/files/';
        if ($event->status == 'sudah-selesai') {

            if (!Storage::exists($path)) {
                return view('admin.event.complitingEvent', compact('event'));
            }
        }

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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
        ) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }

        \Illuminate\Support\Facades\Validator::make($request->all(), [
            "nama" => "required",
            "tanggal" => "required",
            "jam_mulai" => "required",
            "jam_berakhir" => "required",
            "lokasi" => "required",
            "keterangan" => "required",
        ])->validate();

        DB::beginTransaction();

        $new_event = Event::findOrFail($id);
        $new_event->nama = $request->get('nama');
        $new_event->tanggal = $request->get('tanggal');
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

        $new_event->save();

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
            Auth::user()->roles != '["superadmin"]' &&
            Auth::user()->roles != '["admin"]'
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

    public function saveComplitingEvent(Request $request, $id)
    {

        // handle image
        $laporanKegiatan = $request->file('laporan-kegiatan');
        $laporanKeuangan = $request->file('laporan-keuangan');

        $path = 'public/event/' . $id . '/files/';
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        if ($laporanKegiatan) {
            Storage::putFileAs($path, $laporanKegiatan, 'laporan-kegiatan.' . pathinfo($_FILES['laporan-kegiatan']['name'], PATHINFO_EXTENSION));
        }

        if ($laporanKeuangan) {
            Storage::putFileAs($path, $laporanKeuangan, 'laporan-keuangan.' . pathinfo($_FILES['laporan-keuangan']['name'], PATHINFO_EXTENSION));
        }

        return redirect()->route('manage-event.edit', $id);
    }
}

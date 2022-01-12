@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <h5 class="card-header">Detail Event</h5>

                <div class="form-group row mt-4">
                    <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->nama }}</div>
                    </div>
                </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            <img style="margin-left: 10%" src="{{ $event->foto !== null ? asset('storage/' . $event->foto) : 'https://ti.umy.ac.id/wp-content/uploads/2020/02/Untitled-111.jpg' }}" width="250px"/>
                        </div>
                    </div>

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Mulai Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->tanggal_mulai }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Berakhir Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->tanggal_berakhir }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jam_mulai" class="col-sm-2 col-form-label col-form-label-sm">Jam mulai - Jam berakhir:</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->jam_mulai }} WIB - {{ $event->jam_berakhir }} WIB</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->lokasi }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->keterangan }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Status Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->status }}</div>
                    </div>
                </div>

                @if ($laporanKegiatan)
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Laporan kegiatan :</label>
                        <div class="col-sm-10">
                            <a class="col-sm-9 offset-1" href="{{ Storage::url($laporanKegiatan) }}">Download Laporan kegiatan</a>
                        </div>
                    </div>
                @endif

                @if ($laporanKeuangan)
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Laporan keuangan :</label>
                        <div class="col-sm-10">
                            <a class="col-sm-9 offset-1" href="{{ Storage::url($laporanKeuangan) }}">Download Laporan keuangan</a>
                        </div>
                    </div>
                @endif

                @if ($event->status == 'sudah-selesai')
                    @if (!$laporanKeuangan && !$laporanKegiatan)
                        <div class=" mt-4 badge badge-danger">!! event belum menlengkapi laporan keuangan dan laporan kegiatan !!</div>
                    @endif
                @endif

                <a href="{{ route('manage-event.index') }}" class="mt-3 col-sm-2 btn btn-info text-white">Kembali</a>

            </div>
        </div>
    </div>

@endsection

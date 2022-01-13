@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Download Laporan Event</div>

                <div class="form-group row">
                    <label for="laporan-kegiatan" class="col-sm-2 col-form-label col-form-label-sm">Laporan Kegiatan Event :</label>
                    <div class="col-sm-10">
                        <a class="col-sm-10 offset-1" href="{{ Storage::url($laporanKegiatan) }}">Download Laporan kegiatan</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="laporan-keuangan" class="col-sm-2 col-form-label col-form-label-sm">Laporan Keuangan Event :</label>
                    <div class="col-sm-10">
                        <a class="col-sm-10 offset-1" href="{{ Storage::url($laporanKeuangan) }}">Download Laporan keuangan</a>
                    </div>
                </div>

                <a href="{{ route('manage-event.index') }}" class="mt-3 col-sm-2 btn btn-info text-white">Kembali</a>

            </div>
        </div>
    </div>

@endsection

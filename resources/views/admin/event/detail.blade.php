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

                @if ($event->foto)
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            <img style="margin-left: 10%" src="{{asset('storage/' . $event->foto)}}" width="250px"/>
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Event :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->tanggal }}</div>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="jam_mulai" class="col-sm-2 col-form-label col-form-label-sm">Jam mulai :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->jam_mulai }}</div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="jam_berakhir" class="col-sm-2 col-form-label col-form-label-sm">Jam berakhir :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $event->jam_berakhir }}</div>
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

                <a href="{{ route('manage-event.index') }}" class="mt-3 col-sm-2 btn btn-info text-white">Kembali</a>

            </div>
        </div>
    </div>

@endsection

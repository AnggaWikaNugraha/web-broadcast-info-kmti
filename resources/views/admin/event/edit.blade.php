@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <form class="form__create" method="post" action="{{ route('manage-event.update', $event->id) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->nama }}" type="text" class="form-control form-control-sm" id="nama"
                                name="nama" placeholder="Masukan nama event">
                            <span class="err__fields">{{ $errors->first('nama') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            @if($event->foto)
                                <img src="{{asset('storage/' . $event->foto)}}" width="250px"/>
                            @endif
                            <input style="margin-top: 10px" name="foto" type="file" class="form-control-file">
                            <span class="err__fields">{{ $errors->first('foto') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->tanggal }}" type="date" class="form-control form-control-sm"
                                id="tanggal" name="tanggal" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

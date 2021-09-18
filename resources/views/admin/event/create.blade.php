@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Create Event</div>

                <form class="form__create" method="post" action="{{ route('manage-event.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nama') }}" type="text" class="form-control form-control-sm" id="nama"
                                name="nama" placeholder="Masukan nama event">
                            <span class="err__fields">{{ $errors->first('nama') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('tanggal') }}" type="date" class="form-control form-control-sm"
                                id="tanggal" name="tanggal" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal') }}</span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="jam_mulai" class="col-sm-2 col-form-label col-form-label-sm">Jam mulai :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('jam_mulai') }}" type="time" class="form-control form-control-sm" id="jam_mulai"
                                name="jam_mulai" placeholder="Masukan jam mulai event">
                            <span class="err__fields">{{ $errors->first('jam_mulai') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jam_berakhir" class="col-sm-2 col-form-label col-form-label-sm">Jam berakhir :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('jam_berakhir') }}" type="time" class="form-control form-control-sm" id="jam_berakhir"
                                name="jam_berakhir" placeholder="Masukan jam berakhir event">
                            <span class="err__fields">{{ $errors->first('jam_berakhir') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            <input name="foto" type="file" class="form-control-file">
                            <span class="err__fields">{{ $errors->first('foto') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('lokasi') }}" type="text" class="form-control form-control-sm" id="lokasi"
                                name="lokasi" placeholder="Masukan lokasi event">
                            <span class="err__fields">{{ $errors->first('lokasi') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">keterangan Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('keterangan') }}" type="text" class="form-control form-control-sm" id="keterangan"
                                name="keterangan" placeholder="Masukan keterangan event">
                            <span class="err__fields">{{ $errors->first('keterangan') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

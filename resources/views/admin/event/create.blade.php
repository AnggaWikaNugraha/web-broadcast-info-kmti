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
                        <label for="tanggal_mulai" class="col-sm-2 col-form-label col-form-label-sm">Tanggal mulai :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('tanggal_mulai') }}" type="date" class="form-control form-control-sm"
                                id="tanggal" name="tanggal_mulai" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal_mulai') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal berakhir :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('tanggal_berakhir') }}" type="date" class="form-control form-control-sm"
                                id="tanggal_berakhir" name="tanggal_berakhir" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal_berakhir') }}</span>
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
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Masukan keterangan event" ></textarea>
                            <span class="err__fields">{{ $errors->first('keterangan') }}</span>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="tipe_event" class="col-sm-2 col-form-label col-form-label-sm">Tipe event :</label>
                        <div class="col-sm-10">
                            <input placeholder="Divisi KMTI/IT Spekta/Kampung IT/etc" value="{{ old('keterangan') }}" class="form-control form-control-sm" name="keterangan"></textarea>
                            <select name="tipe_event" class="form-control" id="exampleFormControlSelect1">
                                <option value="Event KMTI">Event KMTI</option>
                                <option value="Acara KMTI">Acara KMTI</option>
                                <option value="Divisi KMTI">Divisi KMTI</option>
                              </select>
                            <span class="err__fields">{{ $errors->first('tipe_event') }}</span>
                        </div>
                    </div> --}}

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <h5 class="card-header">Edit</h5>

                <form class="form__create" method="post" action="{{ route('manage-divisi.update', $divisi->id) }}" enctype="multipart/form-data">

                    @method('PATCH')
                    @csrf

                    <div class="form-group row mt-4">
                        <label for="nama_divisi" class="col-sm-2 col-form-label col-form-label-sm">Nama :</label>
                        <div class="col-sm-10">
                            <input value="{{ $divisi->nama_divisi }}" type="text" class="form-control form-control-sm"
                                id="nama_divisi" name="nama_divisi" placeholder="Masukan nama divisi">
                            <span class="err__fields">{{ $errors->first('nama_divisi') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            @if ($divisi->foto)
                                <img src="{{ asset('storage/' . $divisi->foto) }}" width="250px" />
                            @endif
                            <input name="foto" type="file" class="mt-2 form-control-file">
                            <span class="err__fields">{{ $errors->first('foto') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fungsi" class="col-sm-2 col-form-label col-form-label-sm">Fungsi :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" name="fungsi" id="fungsi" >{{ $divisi->fungsi }}</textarea>
                            <span class="err__fields">{{ $errors->first('fungsi') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                        <div class="col-sm-10">
                            {{-- <textarea class="form-control form-control-sm" name="keterangan" id="keterangan" >{{ $divisi->keterangan }}</textarea> --}}
                            <select name="keterangan" class="form-control" id="exampleFormControlSelect1">
                                <option {{ $divisi->keterangan == 'Divisi KMTI' ? 'selected' : '' }} value="Divisi KMTI">Divisi KMTI</option>
                                <option {{ $divisi->keterangan == 'Acara KMTI' ? 'selected' : '' }} value="Acara KMTI">Acara KMTI</option>
                              </select>
                            <span class="err__fields">{{ $errors->first('keterangan') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                    <a href="{{ route('manage-divisi.index') }}" class="btn btn-info text-white">Kembali</a>

                </form>

            </div>
        </div>
    </div>

@endsection

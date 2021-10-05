@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Create Divisi</div>

                <form class="form__create" method="post" action="{{ route('manage-divisi.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="nama_divisi" class="col-sm-2 col-form-label col-form-label-sm">Nama Divisi :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nama_divisi') }}" type="text" class="form-control form-control-sm" id="nama_divisi"
                                name="nama_divisi" placeholder="Masukan nama divisi">
                            <span class="err__fields">{{ $errors->first('nama_divisi') }}</span>
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
                        <label for="fungsi" class="col-sm-2 col-form-label col-form-label-sm">Fungsi Divisi :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" name="fungsi" id="fungsi"></textarea>
                           
                            <span class="err__fields">{{ $errors->first('fungsi') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                        <div class="col-sm-10">
                            <textarea value="{{ old('keterangan') }}" class="form-control form-control-sm" name="keterangan"></textarea>
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

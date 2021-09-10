@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <form class="form__create" method="post" action="{{ route('manage-divisi.update', $divisi->id) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="nama_divisi" class="col-sm-2 col-form-label col-form-label-sm">Nama Divisi :</label>
                        <div class="col-sm-10">
                            <input value="{{ $divisi->nama_divisi }}" type="text" class="form-control form-control-sm" id="nama_divisi"
                                name="nama_divisi" placeholder="Masukan nama divisi">
                            <span class="err__fields">{{ $errors->first('nama_divisi') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

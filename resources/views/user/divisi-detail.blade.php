@extends('layouts.user')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <h5 class="card-header">Detail Divisi</h5>

                <div class="card-header form-group row">
                    <label for="nama_divisi" class="col-sm-2 col-form-label col-form-label-sm">Nama Divisi :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->nama_divisi }}</div>
                    </div>
                </div>

                @if ($divisi->foto)
                    <div style="height: 500px" class="card-header form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            <img style="margin-left: 10%;" src="{{asset('storage/' . $divisi->foto)}}" width="250px"/>
                        </div>
                    </div>
                @endif

                <div class="card-header form-group row">
                    <label for="fungsi" class="col-sm-2 col-form-label col-form-label-sm">Fungsi Divisi :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->fungsi }}</div>
                    </div>
                </div> 

                <div class="card-header form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->keterangan }}</div>
                    </div>
                </div> 

                <a href="{{ route('user.divisi') }}" class="mt-3 col-sm-2 btn btn-info text-white">Kembali</a>

            </div>
        </div>
    </div>

@endsection

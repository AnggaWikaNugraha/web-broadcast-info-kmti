@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Detail info</h5>
            
            <div class="position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-9 offset-1">{{ $info->subject }}</div>
            </div>

            <div class="position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Terkirim</label>
                <div class="col-sm-9 offset-1">{{ $info->mahasiswa()->first()->pivot->tanggal_kirim }}</div>
            </div>

            <div class="position-relative row form-group"><label class="col-sm-2 col-form-label">Terkirim ke :</label>
                <div class="col-sm-9 offset-1">{{ $info->divisi ? $info->divisi->nama_divisi : 'Anggota KMTI' }}</div>
            </div>

            <div class="position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Content</label>
                <div class="col-sm-9 offset-1">{{ $info->content }}</div>
            </div>
            
            <a class="text-white mt-4 btn btn-primary" href="{{ route('user.info') }}">Kembali</a>
        </div>
    </div>

@endsection

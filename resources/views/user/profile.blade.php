@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Profile user</h5>
            
            <div class="card-header position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->name }}"</div>
            </div>
            
            <div class="card-header position-relative row form-group"><label for="nim" class="col-sm-2 col-form-label">Nim</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->nim }}</div>
            </div>

            <div class="card-header position-relative row form-group"><label for=email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-9 offset-1">{{ $user->email }}</div>
            </div>

            <div class="card-header position-relative row form-group"><label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->angkatan }}</div>
            </div>

            <div class="card-header position-relative row form-group"><label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->jenis_kelamin }}</div>
            </div>

            <div class="card-header position-relative row form-group"><label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->no_wa }}</div>
            </div>

            <div class="card-header position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->id_tele }}</div>
            </div>
            
            <a class="text-white mt-4 btn btn-primary" href="{{ route('user.profile.edit') }}">Edit profile</a>
        </div>
    </div>

@endsection

@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Profile user</h5>
            
            <div class="position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->name }}" id="nama" disabled class="form-control"></div>
            </div>
            
            <div class="position-relative row form-group"><label for="nim" class="col-sm-2 col-form-label">Nim</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->nim }}" id="nim" disabled class="form-control"></div>
            </div>

            <div class="position-relative row form-group"><label for=email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10"><input value="{{ $user->email }}" id="email" disabled class="form-control"></div>
            </div>

            <div class="position-relative row form-group"><label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->angkatan }}" id="angkatan" disabled class="form-control"></div>
            </div>

            <div class="position-relative row form-group"><label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->jenis_kelamin }}" id="jenis_kelamin" disabled class="form-control"></div>
            </div>

            <div class="position-relative row form-group"><label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" disabled class="form-control"></div>
            </div>

            <div class="position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                <div class="col-sm-10"><input value="{{ $user->mahasiswa->id_tele }}" id="Telegram" disabled class="form-control"></div>
            </div>
            
        </div>
    </div>

@endsection

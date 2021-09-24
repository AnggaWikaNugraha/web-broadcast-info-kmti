@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Edit Profile</h5>
            
           <form class="mt-4" action="">

                <div class="position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->name }}" id="nama" class="form-control"></div>
                </div>
                
                <div class="position-relative row form-group"><label for="nim" class="col-sm-2 col-form-label">Nim</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->nim }}" id="nim" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for=email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->email }}" id="email" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->angkatan }}" id="angkatan" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->jenis_kelamin }}" id="jenis_kelamin" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" class="form-control"></div>
                </div>

                <div class="position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                    <div class="col-sm-9 offset-1"><input value="{{ $user->mahasiswa->id_tele }}" id="Telegram" class="form-control"></div>
                </div>

           </form>
            
        </div>
    </div>

@endsection

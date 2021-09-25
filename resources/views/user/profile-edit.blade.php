@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Edit Profile</h5>
            
           <form c
                lass="mt-4" 
                method="post" 
                action="{{ route('user.profile.saveedit', $user->id) }}"
                enctype="multipart/form-data">
           
                @method('PATCH')
                @csrf

                <div class="position-relative row form-group">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-9 offset-1"><input name="name" value="{{ $user->mahasiswa->name }}" id="nama" class="form-control"></div>
                </div>
                
                <div class="position-relative row form-group">
                    <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                    <div class="col-sm-9 offset-1"><input disabled name="nim" value="{{ $user->mahasiswa->nim }}" id="nim" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for=email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-9 offset-1"><input disabled name="email" value="{{ $user->email }}" id="email" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                    <div class="col-sm-9 offset-1"><input disabled name="angkatan" value="{{ $user->mahasiswa->angkatan }}" id="angkatan" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                    <div class="col-sm-9 offset-1"><input disabled name="jenis_kelamin" value="{{ $user->mahasiswa->jenis_kelamin }}" id="jenis_kelamin" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-9 offset-1"><input name="no_wa" value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                    <div class="col-sm-9 offset-1"><input name="id_tele" value="{{ $user->mahasiswa->id_tele }}" id="Telegram" class="form-control"></div>
                </div>

                <input class="btn btn-primary" type="submit" value="Simpan">
           </form>
            
        </div>
    </div>

@endsection

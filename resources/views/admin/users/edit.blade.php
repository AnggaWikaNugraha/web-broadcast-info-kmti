@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Edit User</div>

                <form method="post" action="{{ route('manage-users.update', $user->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    {{-- {{ dd($user)}} --}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label col-form-label-sm">name :</label>
                        <div class="col-sm-10">
                            <input value="{{ $user->mahasiswa->name }}" type="text" class="form-control form-control-sm" id="name"
                                name="name" placeholder="Masukan name">
                            <span class="err__fields">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label col-form-label-sm">nim :</label>
                        <div class="col-sm-10">
                            <input disabled value="{{ $user->mahasiswa->nim }}" type="text" class="form-control form-control-sm" id="nim"
                                name="nim" placeholder="Masukan nim">
                            <span class="err__fields">{{ $errors->first('nim') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                        <div class="col-sm-10">
                            <input value="{{ $user->email }}" type="email" class="form-control form-control-sm" id="email"
                                name="email" placeholder="Masukan email">
                            <span class="err__fields">{{ $errors->first('email') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="angkatan" class="col-sm-2 col-form-label col-form-label-sm">Angkatan
                            :</label>
                        <div class="col-sm-10">
                            <input disabled value="{{ $user->mahasiswa->angkatan }}" type="text" class="form-control form-control-sm"
                                id="angkatan" name="angkatan" placeholder="Masukan angkatan">
                            <span class="err__fields">{{ $errors->first('angkatan') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Jenis kelamin :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="jenis_kelamin" >
                                <option {{ $user->mahasiswa->jenis_kelamin === 'laki-laki' ? 'selected' : '' }} value='laki-laki' >Laki-Laki</option>
                                <option {{ $user->mahasiswa->jenis_kelamin === 'perempuan' ? 'selected' : '' }} value='perempuan' >Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                        <div class="col-sm-10">
                            <input disabled value="{{ $user->roles }}" type="text" class="form-control form-control-sm"
                                id="angkatan" name="roles">
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>
@endsection

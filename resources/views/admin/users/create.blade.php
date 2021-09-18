@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Create User</div>

                <form 
                    class="form__create" 
                    method="post" 
                    action="{{ route('manage-users.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label col-form-label-sm">name :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('name') }}" type="text" class="form-control form-control-sm" id="name"
                                name="name" placeholder="Masukan name">
                            <span class="err__fields">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label col-form-label-sm">nim :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nim') }}" type="text" class="form-control form-control-sm" id="nim"
                                name="nim" placeholder="Masukan nim">
                            <span class="err__fields">{{ $errors->first('nim') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('email') }}" type="email" class="form-control form-control-sm" id="email"
                                name="email" placeholder="Masukan email">
                            <span class="err__fields">{{ $errors->first('email') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="angkatan" class="col-sm-2 col-form-label col-form-label-sm">Angkatan
                            :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('angkatan') }}" type="text" class="form-control form-control-sm"
                                id="angkatan" name="angkatan" placeholder="Masukan angkatan">
                            <span class="err__fields">{{ $errors->first('angkatan') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="roles" id="inlineFormCustomSelect">
                                <option value='["mahasiswa"]'>Mahasiswa</option>
                                <option value='["admin"]''>Admin</option>
                                <option value=' ["superadmin"]'>Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Status :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="status" id="inlineFormCustomSelect">
                                <option value='["anggota"]'>Anggota KMTI</option>
                                <option value='["anggota", "pengurus"]''>Pengurus KMTI</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>
@endsection

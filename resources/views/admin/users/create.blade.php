@extends('layouts.app')

@section('body')

    @include('layouts.components.navbar')

    <div class="app-main">

        @include('layouts.components.sidebar')

        <div class="app-main__outer">
            <div class="app-main__inner">

                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card p-4">

                            @include('layouts.components.flash-message')

                            <form class="form__create" method="post" action="{{ route('manage-users.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label col-form-label-sm">Username
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('username') }}" type="text"
                                            class="form-control form-control-sm" id="username" name="username"
                                            placeholder="Masukan username">
                                        <span class="err__fields">{{ $errors->first('username') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('email') }}" type="email"
                                            class="form-control form-control-sm" id="email" name="email"
                                            placeholder="Masukan email">
                                        <span class="err__fields">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Password
                                        :</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="{{ old('password') }}" type="text"
                                            class="form-control form-control-sm" id="password" name="password"
                                            placeholder="Masukan password">
                                        <span class="err__fields">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation"
                                        class="col-sm-2 col-form-label col-form-label-sm">Confirm Password :</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="{{ old('password_confirmation') }}" type="text"
                                            class="form-control form-control-sm" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select custom-select-sm mr-sm-2" name="roles"
                                            id="inlineFormCustomSelect">
                                            <option value='["mahasiswa"]'>Mahasiswa</option>
                                            <option value='["admin"]''>Admin</option>
                                                                        <option value=' ["superadmin"]'>Super Admin
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-info text-white">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

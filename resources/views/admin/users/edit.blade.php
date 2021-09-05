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
                            <form method="post" action="{{ route('manage-users.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label col-form-label-sm">Username
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $user->username }}" type="text"
                                            class="form-control form-control-sm" id="username" name="username"
                                            placeholder="Masukan username">
                                        <span class="err__fields">{{ $errors->first('username') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $user->email }}" type="email"
                                            class="form-control form-control-sm" id="email" name="email"
                                            placeholder="Masukan email">
                                        <span class="err__fields">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Password
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('password') }}" type="password"
                                            class="form-control form-control-sm" id="password" name="password"
                                            placeholder="password">
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
                                                            <option value=' ["superadmin"]'>Super Admin</option>
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

    {{-- <div id="app">
        <main class="page__Dashboard">
            <div class="container-fluid h-100">

                <div class="row h-100">

                    <div class="col-2 h-100 w-100 pr-0">

                        @include('layouts.components.sidebar')

                    </div>

                    <div class="col-10 pr-4">

                        <div><h4 class="mt-4 mb-4 font-weight-bold title__admin"">WEB BROADCAST KMTI</h4></div>
                        @section('navbartitle', 'Edit users')
                        @include('layouts.components.navbar')


                        <div class="card wrapper__card shadow-sm">
                            
                            @include('layouts.components.flash-message')
                            <form method="post" action="{{ route('manage-users.update', $user->id)}}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="form-group row">
                                  <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Nama :</label>
                                  <div class="col-sm-10">
                                    <input value="{{ $user->name}}" type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Masukan nama">
                                    <span class="err__fields">{{$errors->first('name')}}</span>
                                  </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                                    <div class="col-sm-10">
                                      <input value="{{ $user->email}}" type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Masukan email">
                                      <span class="err__fields">{{$errors->first('email')}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Password :</label>
                                    <div class="col-sm-10">
                                      <input value="{{old('password')}}" type="password" class="form-control form-control-sm" id="password" name="password" placeholder="password">
                                      <span class="err__fields">{{$errors->first('password')}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label col-form-label-sm">Confirm Password :</label>
                                    <div class="col-sm-10">
                                      <input type="password" value="{{old('password_confirmation')}}" type="text" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                      </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select custom-select-sm mr-sm-2" name="roles" id="inlineFormCustomSelect">
                                            <option value='["mahasiswa"]'>Mahasiswa</option>
                                            <option value='["admin"]''>Admin</option>
                                            <option value='["superadmin"]'>Super Admin</option>
                                          </select>
                                    </div>
                                </div>

                                <button class="btn btn-info text-white">Submit</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div> --}}
@endsection

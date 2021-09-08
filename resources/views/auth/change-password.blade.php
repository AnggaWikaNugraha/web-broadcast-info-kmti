@extends('layouts.auth')

@section('body')
    <div id="app">

        <main class="page__login">
            <div class="container">

                {{-- content --}}
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">

                                <h5 class="text-center font-weight-bold mt-4 mb-3" style="color: gray">Fist login, Change
                                    Password</h5>
                                <form method="POST" action="{{ route('change-password', $user->id) }}">
                                    @method('PATCH')
                                    @csrf

                                    <div class="form-group row mb-4">

                                        <div class="offset-1 col-md-10">
                                            <input placeholder="Password" id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">

                                        <div class="offset-1 col-md-10">
                                            <input placeholder="Password confirmation" id="password_confirmation"
                                                type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password_confirmation" required
                                                autocomplete="current-password-confirmation">

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <div class="col-md-10 offset-1">
                                            <button type="submit" class="btn btn-primary" style="width: 100%">
                                                {{ __('LOGIN') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- akhir conten --}}
            </div>
        </main>
    </div>
@endsection

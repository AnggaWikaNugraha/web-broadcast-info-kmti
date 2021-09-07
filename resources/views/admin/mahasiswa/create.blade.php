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

                            <form class="form__create" method="post" action="{{ route('manage-mahasiswa.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label col-form-label-sm">name :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('name') }}" type="text" class="form-control form-control-sm"
                                            id="name" name="name" placeholder="Masukan name">
                                        <span class="err__fields">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label col-form-label-sm">nim :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('nim') }}" type="text" class="form-control form-control-sm"
                                            id="nim" name="nim" placeholder="Masukan nim">
                                        <span class="err__fields">{{ $errors->first('nim') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_wa" class="col-sm-2 col-form-label col-form-label-sm">Nomer whatsapp
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('no_wa') }}" type="text" class="form-control form-control-sm"
                                            id="no_wa" name="no_wa" placeholder="Masukan nomer whatsapp">
                                        <span class="err__fields">{{ $errors->first('no_wa') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="angkatan" class="col-sm-2 col-form-label col-form-label-sm">Angkatan
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('angkatan') }}" type="text"
                                            class="form-control form-control-sm" id="angkatan" name="angkatan"
                                            placeholder="Masukan angkatan">
                                        <span class="err__fields">{{ $errors->first('angkatan') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_tele" class="col-sm-2 col-form-label col-form-label-sm">Id telegram
                                        :</label>
                                    <div class="col-sm-10">
                                        <input value="{{ old('id_tele') }}" type="text"
                                            class="form-control form-control-sm" id="id_tele" name="id_tele"
                                            placeholder="Masukan id telegram">
                                        <span class="err__fields">{{ $errors->first('id_tele') }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-2 col-form-label col-form-label-sm">Email
                                        :</label>
                                    <div class="col-sm-10">
                                        <select name="user_id" id="user_id" class="form-control form-control-sm"></select>
                                        <span class="err__fields">{{ $errors->first('user_id') }}</span>
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

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">
        $('#user_id').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/ajax/users/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.email
                            }
                        })
                    }
                }
            }
        });
    </script>
@endpush

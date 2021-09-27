@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Create Info</div>

                <form class="form__create" method="post" action="{{ route('manage-info.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label col-form-label-sm">subject :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('subject') }}" type="text" class="form-control form-control-sm" id="subject"
                                name="subject" placeholder="Masukan subject">
                            <span class="err__fields">{{ $errors->first('subject') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label col-form-label-sm">Content :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" rows="5" id="content" name="content"></textarea>
                            <span class="err__fields">{{ $errors->first('content') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Kirim ke :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="status" >
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

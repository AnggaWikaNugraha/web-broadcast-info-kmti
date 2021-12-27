@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Compliting Event</div>

                <form
                    class="form__create"
                    method="post"
                    action="{{ route('save.compliting.event', $event->id) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="laporan-kegiatan" class="col-sm-2 col-form-label col-form-label-sm">Laporan Kegiatan Event :</label>
                        <div class="col-sm-10">
                            <input
                                accept=".xlsx,.docx"
                                style="height: calc(2.25rem + 2px)"
                                value="{{ old('laporan-kegiatan') }}"
                                type="file"
                                class="form-control form-control-sm"
                                id="laporan-kegiatan"
                                name="laporan-kegiatan"
                                placeholder="Masukan laporan-kegiatan event">
                            <span class="err__fields">{{ $errors->first('laporan-kegiatan') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="laporan-keuangan" class="col-sm-2 col-form-label col-form-label-sm">Laporan Keuangan Event :</label>
                        <div class="col-sm-10">
                            <input
                                accept=".xlsx,.docx"
                                style="height: calc(2.25rem + 2px)"
                                value="{{ old('laporan-keuangan') }}"
                                type="file"
                                class="form-control form-control-sm"
                                id="laporan-keuangan"
                                name="laporan-keuangan"
                                placeholder="Masukan laporan-keuangan event">
                            <span class="err__fields">{{ $errors->first('laporan-keuangan') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

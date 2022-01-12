@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <form class="form__create" method="post" action="{{ route('manage-event.update', $event->id) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->nama }}" type="text" class="form-control form-control-sm" id="nama"
                                name="nama" placeholder="Masukan nama event">
                            <span class="err__fields">{{ $errors->first('nama') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">

                                <img src="{{ $event->foto !== null ? asset('storage/' . $event->foto) : 'https://ti.umy.ac.id/wp-content/uploads/2020/02/Untitled-111.jpg' }}" width="250px" />

                            <input style="margin-top: 10px" name="foto" type="file" class="form-control-file">
                            <span class="err__fields">{{ $errors->first('foto') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal mulai :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->tanggal_mulai }}" type="date" class="form-control form-control-sm"
                                id="tanggal_mulai" name="tanggal_mulai" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal_mulai') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal berakhir :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->tanggal_berakhir }}" type="date" class="form-control form-control-sm"
                                id="tanggal_berakhir" name="tanggal_berakhir" placeholder="Masukan tanggal">
                            <span class="err__fields">{{ $errors->first('tanggal_berakhir') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jam_mulai" class="col-sm-2 col-form-label col-form-label-sm">Jam mulai :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->jam_mulai }}" type="time" class="form-control form-control-sm"
                                id="jam_mulai" name="jam_mulai" placeholder="Masukan jam mulai event">
                            <span class="err__fields">{{ $errors->first('jam_mulai') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jam_berakhir" class="col-sm-2 col-form-label col-form-label-sm">Jam berakhir :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->jam_berakhir }}" type="time" class="form-control form-control-sm"
                                id="jam_berakhir" name="jam_berakhir" placeholder="Masukan jam berakhir event">
                            <span class="err__fields">{{ $errors->first('jam_berakhir') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi Event :</label>
                        <div class="col-sm-10">
                            <input value="{{ $event->lokasi }}" type="text" class="form-control form-control-sm"
                                id="lokasi" name="lokasi" placeholder="Masukan lokasi event">
                            <span class="err__fields">{{ $errors->first('lokasi') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label col-form-label-sm">status Event :</label>
                        <div class="col-sm-10">
                            <input {{ $event->status == 'belum-mulai' ? 'checked' : '' }} type="radio"
                                id="status_belum_mulai" name="status" value="belum-mulai" />
                            <label for="status_belum_mulai">belum mulai</label><br>

                            <input {{ $event->status == 'sudah-selesai' ? 'checked' : '' }} type="radio"
                                id="status_sudah_selesai" name="status" value="sudah-selesai" />
                            <label for="status_sudah_selesai">sudah selesai</label><br>

                            <input {{ $event->status == 'cancel' ? 'checked' : '' }} type="radio" id="status_cancel"
                                name="status" value="cancel" />
                            <label for="status_cancel">cancel</label><br>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">keterangan Event :</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" class="form-control form-control-sm" id="keterangan"
                                name="keterangan"
                                placeholder="Masukan keterangan event">{{ $event->keterangan }}</textarea>
                            <span class="err__fields">{{ $errors->first('keterangan') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        @if ($event->status == 'sudah-selesai')
                            @if (!$laporanKeuangan && !$laporanKegiatan)
                                <div class=" ml-5 mt-4 mb-4 badge badge-danger">!! event belum menlengkapi laporan keuangan dan laporan kegiatan !!</div>
                            @endif
                        @endif
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection
@push('script')
    <script type="text/javascript">
    var date           = new Date();
    var day            = date.getDate()
    var month          = date.getMonth()+1
    var year           = date.getFullYear()
    if(day < 10){
        day  = '0'+ day
    }
    if(month < 10){
        month = '0'+month
    }
    var minDate = year +'-'+month+'-'+day
    document.getElementById('tanggal_mulai').setAttribute("min", minDate);
    document.getElementById('tanggal_berakhir').setAttribute("min", minDate);

    </script>
@endpush

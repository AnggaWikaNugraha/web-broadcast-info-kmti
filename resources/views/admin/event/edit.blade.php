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
                            @if ($event->foto)
                                <img src="{{ asset('storage/' . $event->foto) }}" width="250px" />
                            @endif
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

                    @if ($event->status == 'sudah-selesai')
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Laporan kegiatan :</label>
                            <div class="col-sm-5">
                                <input style="height: calc(2.25rem + 2px)" value="{{ old('laporan-kegiatan') }}" type="file"
                                    class="form-control form-control-sm" id="laporan-kegiatan" name="laporan-kegiatan"
                                    placeholder="Masukan laporan-kegiatan event">
                                <span class="err__fields">{{ $errors->first('laporan-kegiatan') }}</span>
                            </div>
                            @if ($laporanKegiatan)
                                <div class="col-sm-5">
                                    <a class="col-sm-10" href="{{ Storage::url($laporanKegiatan) }}">Download Laporan
                                        kegiatan</a>

                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($event->status == 'sudah-selesai')
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Laporan keuangan :</label>
                            <div class="col-sm-5">
                                <input style="height: calc(2.25rem + 2px)" value="{{ old('laporan-keuangan') }}" type="file"
                                    class="form-control form-control-sm" id="laporan-keuangan" name="laporan-keuangan"
                                    placeholder="Masukan laporan-keuangan event">
                                <span class="err__fields">{{ $errors->first('laporan-keuangan') }}</span>
                            </div>
                            @if ($laporanKeuangan)
                                <div class="col-sm-5">
                                    <a class="col-sm-10" href="{{ Storage::url($laporanKeuangan) }}">Download Laporan
                                        keuangan</a>
                                </div>
                            @endif
                        </div>
                    @endif

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
                        <label for="tipe_event" class="col-sm-2 col-form-label col-form-label-sm">Tipe event :</label>
                        <div class="col-sm-10">
                            {{-- <input placeholder="Divisi KMTI/IT Spekta/Kampung IT/etc" value="{{ old('keterangan') }}" class="form-control form-control-sm" name="keterangan"></textarea> --}}
                            <select name="tipe_event" class="form-control" id="exampleFormControlSelect1">
                                <option {{ $event->tipe_event == 'Event KMTI' ? 'selected' : '' }} value="Event KMTI">Event KMTI</option>
                                <option {{ $event->tipe_event == 'Acara KMTI' ? 'selected' : '' }} value="Acara KMTI">Acara KMTI</option>
                                <option {{ $event->tipe_event == 'Divisi KMTI' ? 'selected' : '' }} value="Divisi KMTI">Divisi KMTI</option>
                              </select>
                            <span class="err__fields">{{ $errors->first('tipe_event') }}</span>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>

                </form>

            </div>
        </div>
    </div>

@endsection

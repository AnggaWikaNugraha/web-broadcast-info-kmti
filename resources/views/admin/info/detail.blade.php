@extends('layouts.admin')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Detail info</h5>
            
            <div class="position-relative mt-4 row form-group"><label class=" col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-9 offset-1">{{ $info->subject }}</div>
            </div>

            <div class="position-relative row form-group"><label class="col-sm-2 col-form-label">Terkirim</label>
                <div class="col-sm-9 offset-1">{{ $info->mahasiswa()->first()->pivot->tanggal_kirim }}</div>
            </div>

            <div class="position-relative row form-group"><label class="col-sm-2 col-form-label">Content</label>
                <div class="col-sm-9 offset-1">{{ $info->content }}</div>
            </div>

            <div class="position-relative row form-group"><label class="col-sm-2 col-form-label">Terkirim ke :</label>
                <div class="col-sm-9 offset-1">{{ $info->divisi ? $info->divisi->nama_divisi : 'Anggota KMTI' }}</div>
            </div>

            <div style="height: 220px;" class="position-relative row form-group"><label class="col-sm-2 col-form-label">Daftar kontak terkirim : </label>
                <div style="height: 200px; overflow-y: auto" class="col-sm-9 offset-1">

                    <table class="table table-striped">
                        <thead>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Angkatan</th>
                            <th>Whatsapp</th>
                        </thead>
                        <tbody>

                            @foreach ($info->mahasiswa as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->nim}}</td>
                                <td>{{ $item->angkatan}}</td>
                                <td>{{ $item->no_wa}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
            </div>
            
            <a class="text-white mt-4 btn btn-primary" href="{{ route('manage-info.index') }}">Kembali</a>
        </div>
    </div>

@endsection

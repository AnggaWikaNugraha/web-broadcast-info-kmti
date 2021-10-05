@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <h5 class="card-header">Detail Divisi</h5>

                <div class="form-group row mt-4">
                    <label for="nama_divisi" class="col-sm-2 col-form-label col-form-label-sm">Nama Divisi :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->nama_divisi }}</div>
                    </div>
                </div>

                @if ($divisi->foto)
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto :</label>
                        <div class="col-sm-10">
                            <img style="margin-left: 10%;" src="{{asset('storage/' . $divisi->foto)}}" width="250px"/>
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="fungsi" class="col-sm-2 col-form-label col-form-label-sm">Fungsi Divisi :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->fungsi }}</div>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-10">
                        <div class="col-sm-9 offset-1">{{ $divisi->keterangan }}</div>
                    </div>
                </div>
                
                <div style="height: 220px;" class="position-relative row form-group"><label class="col-sm-2 col-form-label">Daftar mahasiswa terkait</label>
                    <div style="height: 200px; overflow-y: auto" class="col-sm-9 offset-1">
    
                        <table class="table table-striped">
                            <thead>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nim</th>
                            </thead>
                            <tbody>

                                @forelse ($divisi->mahasiswa as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->nim}}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">tidak ada mahasiswa</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
    
                    </div>
                </div>

                <a href="{{ route('manage-divisi.index') }}" class="mt-3 col-sm-2 btn btn-info text-white">Kembali</a>

            </div>
        </div>
    </div>

@endsection

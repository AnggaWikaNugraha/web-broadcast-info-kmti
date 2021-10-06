@extends('layouts.admin')

@section('content')

    <div class="main-card mb-3">
        <div>
            <h5 class="card-header">Profile user</h5>

            <div class="row mt-3">
                <div class="col-md-5">
                    <div class="card p-3">
                        <div class="cad-body">
                            
                            <div class="card-header position-relative row form-group"><label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->name }}</div>
                            </div>
                            
                            <div class="card-header position-relative row form-group"><label for="nim" class="col-sm-2 col-form-label">Nim</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->nim }}</div>
                            </div> 

                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card p-3">
                        <div class="cad-body">
                            
                            <div class="card-header position-relative row form-group"><label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->angkatan }}</div>
                            </div>

                            <div class="card-header position-relative row form-group"><label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->jenis_kelamin }}</div>
                            </div>

                            <div class="card-header position-relative row form-group"><label for=email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-9 offset-1">{{ $user->email }}</div>
                            </div>
                
                            <div class="card-header position-relative row form-group"><label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->no_wa }}</div>
                            </div>
                
                            <div class="card-header position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                                <div class="col-sm-9 offset-1">{{ $user->mahasiswa->id_tele }}</div>
                            </div>
                            
                            <div class="card-header position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Status mahasiswa</label>
                                <div class="col-sm-9 offset-1">
                                    <select disabled id="select-pengurus" class="custom-select custom-select-sm" name="status">
                                        <option {{ $user->mahasiswa->status == '["anggota"]' ? 'selected' : '' }} value='["anggota"]'>Anggota KMTI</option>
                                        <option {{ $user->mahasiswa->status == '["anggota", "pengurus"]' ? 'selected' : '' }} value='["anggota", "pengurus"]'>Pengurus KMTI</option>
                                    </select>
                                </div>
                            </div>

                            @if ($user->mahasiswa->status !== '["anggota"]')
                                <div style="height: 100px" class="card-header position-relative row form-group"><label for="Telegram" class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-9 offset-1" style="height: 100%; display: flex; align-items: center">
                                      
                                            @if ( $mhs->divisi()->count() > 0 )
                                                <ul>
                                                    @foreach ($mhs->divisi()->get() as $item)
                                                        <li>{{ $item->nama_divisi}}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                !! Tidak ada Divisi !!
                                            @endif  
                                            
                                    </div>
                                </div> 
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            
            <a style="float: right" class="text-white mt-4 btn btn-primary" href="{{ route('manage-users.index') }}">Kembali</a>
        </div>
    </div>

@endsection

@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Edit Profile</h5>

           <form c
                lass="mt-4"
                method="post"
                action="{{ route('user.profile.saveedit', $user->id) }}"
                enctype="multipart/form-data">

                @method('PATCH')
                @csrf

                <div class="position-relative row form-group">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-9 offset-1"><input name="name" value="{{ $user->mahasiswa->name }}" id="nama" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                    <div class="col-sm-9 offset-1"><input disabled name="nim" value="{{ $user->mahasiswa->nim }}" id="nim" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for=email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-9 offset-1"><input disabled name="email" value="{{ $user->email }}" id="email" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                    <div class="col-sm-9 offset-1"><input disabled name="angkatan" value="{{ $user->mahasiswa->angkatan }}" id="angkatan" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                    <div class="col-sm-9 offset-1"><input disabled name="jenis_kelamin" value="{{ $user->mahasiswa->jenis_kelamin }}" id="jenis_kelamin" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-9 offset-1"><input name="no_wa" value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                    <div class="col-sm-9 offset-1"><input name="id_tele" value="{{ $user->mahasiswa->id_tele }}" id="Telegram" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                    <div class="col-sm-9 offset-1">
                        <select onchange="selecOptions()" id="select-pengurus" class="custom-select custom-select-sm" name="status">
                            <option {{ $user->mahasiswa->status == 'anggota' ? 'selected' : '' }} value='anggota'>Anggota KMTI</option>
                            <option {{ $user->mahasiswa->status == 'pengurus' ? 'selected' : '' }} value='pengurus'>Pengurus KMTI</option>
                        </select>
                    </div>
                </div>

                <div id="WrappSelectDivisi" class="position-relative row form-group">
                        <label for="Telegram" class="col-sm-2 col-form-label">Divisi</label>
                        <div class="col-sm-9 offset-1">
                            <select id="SelectDivisi" multiple  class="custom-select custom-select-sm" name="divisi[]"></select>
                        </div>
                </div>

                <input class="btn btn-primary" type="submit" value="Simpan">
                <a href="{{ route('user.profile') }}" class="btn btn-info">Kembali</a>
           </form>

        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">

        $('#SelectDivisi').select2({
            ajax: {
                url: '{{ route('user.search.divisi') }}',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.nama_divisi
                            }
                        })
                    }
                }
            }
        });

        if (document.getElementById('select-pengurus').value === 'pengurus') {
            document.getElementById('WrappSelectDivisi').style.display = 'flex'
            document.getElementById("SelectDivisi").setAttribute('required','required');
        } else {
            document.getElementById('WrappSelectDivisi').style.display = 'none'
            document.getElementById("SelectDivisi").required =false;
        }

        var divisi = {!! $mhs->divisi !!}
        divisi.forEach(function(category){
            var option = new Option(category.nama_divisi, category.id, true, true);
            $('#SelectDivisi').append(option).trigger('change');
        });

        function selecOptions() {
            if (document.getElementById('select-pengurus').value === 'pengurus') {
                document.getElementById('WrappSelectDivisi').style.display = 'flex'
                document.getElementById("SelectDivisi").setAttribute('required','required');
            } else {
                $("#SelectDivisi option[value]").remove();
                document.getElementById('WrappSelectDivisi').style.display = 'none'
                document.getElementById("SelectDivisi").required =false;
            }
        }


    </script>

@endpush

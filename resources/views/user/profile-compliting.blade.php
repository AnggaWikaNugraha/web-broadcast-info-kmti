@extends('layouts.user')

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-header">Melengkapi Profile</h5>

            <form class="mt-4" method="post" action="{{ route('user.profile.savecompliting', $user->id) }}"
                enctype="multipart/form-data">

                @method('PATCH')
                @csrf

                <div class="position-relative row form-group"><label for="whatsapp"
                        class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-9 offset-1"><input placeholder="08xxx" name="no_wa"
                            value="{{ $user->mahasiswa->no_wa }}" id="whatsapp" class="form-control"></div>
                </div>

                <div class="position-relative row form-group">
                    <label for="Telegram" class="col-sm-2 col-form-label">Telegram</label>
                    <div class="col-sm-9 offset-1">
                        <input placeholder="@" name="id_tele" value="{{ $user->mahasiswa->id_tele }}" id="Telegram"
                            class="form-control">
                    </div>
                </div>

                <div class="position-relative row form-group">
                    <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                    <div class="col-sm-9 offset-1">
                        <select onchange="selecOptions()" id="select-pengurus" class="custom-select custom-select-sm "
                            name="status">
                            <option value='["anggota"]'>Anggota KMTI</option>
                            <option value='["anggota", "pengurus"]'>Pengurus KMTI</option>
                        </select>
                    </div>
                </div>

                <div id="DivisiOptions" class="position-relative row form-group" style="display: none">
                    <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Divisi :</label>
                    <div class="col-sm-9 offset-1">
                        <select multiple id="SelectDivisi" class="custom-select custom-select-sm " name="divisi[]">
                            <option value=''>Pilih Divisi</option>
                        </select>
                    </div>
                </div>

                <input class="btn mt-5 btn-primary" type="submit" value="Simpan">
            </form>

        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">

        function selecOptions() {
            if (document.getElementById('select-pengurus').value === '["anggota", "pengurus"]') {
                document.getElementById('DivisiOptions').style.display = 'flex'
            } else {
                document.getElementById('DivisiOptions').style.display = 'none'
            }
        }

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

    </script>

@endpush

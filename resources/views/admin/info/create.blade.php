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
                        <label for="status" class="col-sm-2 col-form-label col-form-label-sm">Kirim Ke :</label>
                        <div class="col-sm-10">
                            <select id="select-pengurus" onchange="selecOptions()" class="custom-select custom-select-sm mr-sm-2" name="status" >
                                <option value='["anggota"]'>Anggota KMTI</option>
                                <option value='["anggota", "pengurus"]'>Pengurus KMTI</option>
                                @foreach ($angkatan as $item)
                                    <option value="{{ $item->angkatan }}">Angkatan {{ $item->angkatan}}</option>
                                @endforeach
                            </select>
                            <span class="err__fields">{{ $errors->first('divisi') }}</span>
                        </div>
                    </div>

                    <div id="DivisiOptions" class="position-relative row form-group" style="display: none">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Divisi :</label>
                        <div class="col-sm-10">
                            <select id="SelectDivisi" class="custom-select custom-select-sm " name="divisi">
                                <option value=''>Pilih Divisi</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>
                    <a class="text-white ml-2 btn btn-primary" href="{{ route('manage-info.index') }}">Kembali</a>

                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">

        function selecOptions() {
            if (document.getElementById('select-pengurus').value === '["anggota", "pengurus"]') {
                document.getElementById('DivisiOptions').style.display = 'flex';
            } else {
                document.getElementById('DivisiOptions').style.display = 'none'
                document.getElementById('SelectDivisi').value = null
            }
        }

        $('#SelectDivisi').select2({
            ajax: {
                url: '{{ route("admin.search.divisi") }}',
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

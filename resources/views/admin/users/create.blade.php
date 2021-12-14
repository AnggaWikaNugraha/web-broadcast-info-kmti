@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0 mb-4">Create User</div>

                @if (count($errors->getMessages()) > 0)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Validation Errors:</strong>
                        <ul>
                            @foreach ($errors->getMessages() as $errorMessages)
                                @foreach ($errorMessages as $errorMessage)
                                    <li>
                                        {{ $errorMessage }}
                                        <a href="#" class="close" data-dismiss="alert"
                                            aria-label="close">&times;</a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- <form 
                    class="form__create" 
                    method="post" 
                    action="{{ route('manage-users.store') }}"
                    enctype="multipart/form-data">
                    
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label col-form-label-sm">name :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('name') }}" type="text" class="form-control form-control-sm" id="name"
                                name="name" placeholder="Masukan name">
                            <span class="err__fields">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label col-form-label-sm">nim :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nim') }}" type="text" class="form-control form-control-sm" id="nim"
                                name="nim" placeholder="Masukan nim">
                            <span class="err__fields">{{ $errors->first('nim') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('email') }}" type="email" class="form-control form-control-sm" id="email"
                                name="email" placeholder="Masukan email">
                            <span class="err__fields">{{ $errors->first('email') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="angkatan" class="col-sm-2 col-form-label col-form-label-sm">Angkatan
                            :</label>
                        <div class="col-sm-10">
                            <input value="{{ old('angkatan') }}" type="text" class="form-control form-control-sm"
                                id="angkatan" name="angkatan" placeholder="Masukan angkatan">
                            <span class="err__fields">{{ $errors->first('angkatan') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Jenis kelamin :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="jenis_kelamin">
                                <option value='laki-laki'>Laki-Laki</option>
                                <option value='perempuan'>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label col-form-label-sm">Roles :</label>
                        <div class="col-sm-10">
                            <select class="custom-select custom-select-sm mr-sm-2" name="roles">
                                <option value='["mahasiswa"]'>Mahasiswa</option>
                                <option value='["admin"]''>Admin</option>
                                    <option value=' ["superadmin"]'>Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-info text-white">Submit</button>
                    <a class="text-white ml-2 btn btn-primary" href="{{ route('manage-users.index') }}">Kembali</a>

                </form> --}}

            </div>
        </div>

        <div class="col-12">
            <div class="main-card mb-3 card p-4">

                <a id="btnBatal" style="display: none;" class="col-1 text-white mb-4 btn btn-primary"
                    href="{{ route('manage-users.create') }}">Batal import</a>

                <form action="{{ route('import.excel') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="input-group">
                        <input style="height: calc(2.7rem + 2px)" id="importExcel" type="file" name="file"
                            class="form-control" placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="button-addon2">

                        <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
                    </div>
                </form>

            </div>
        </div>

        <div id="wrapperTable" style="display: none" class="col-12">
            <div class="main-card mb-3 card p-4">
                <table id="tableImport" class="table "></table>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>

    <script type="text/javascript">
        var input = document.getElementById('importExcel')
        input.addEventListener('change', function() {

            document.getElementById('wrapperTable').style.display = 'block'
            document.getElementById('btnBatal').style.display = 'block'

            readXlsxFile(input.files[0]).then(function(data) {
                var i = 0;
                data.map((row, index) => {
                    if (i == 0) {
                        let table = document.getElementById('tableImport');
                        generateHead(table, row)
                    }
                })
            })
        })

        function generateHead(table, data) {
            let thead = table.createTHead();
            let row = thead.insertRow();
            for (let key of data) {
                let th = document.createElement('th');
                let text = document.createTextNode(key);
                th.appendChild(text);
                row.appendChild(th)
            }
        }
    </script>

@endpush

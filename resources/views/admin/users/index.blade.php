@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0">List Users
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ route('manage-users.create') }}">
                                <button class="btn btn-focus mr-3">Create user</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-3 d-flex align-items-center">
                        <label class="col-6 pl-0 pr-0 mr-1" style="font-size: 12px" for="filter-satuan">Filter
                            berdasarkan angkatan : </label>

                        <select data-column="1" class="form-control form-select-sm" id="filter-satuan">
                            <option value="">Pilih angkatan</option>
                            
                            @foreach ($angkatan as $item)
                                <option>{{ $item->angkatan}}</option>
                            @endforeach

                        </select>
                        <br /> <br />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table table-striped">
                        <thead class="thead__dark">
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>nim</th>
                                <th>angkatan</th>
                                <th>Email</th>
                                <th>Whatsapp</th>
                                <th>Telegram</th>
                                <th>Status</th>
                                <th>Jenis kelamin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>

    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('manage-users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nim',
                        name: 'nim'
                    },
                    {
                        data: 'angkatan',
                        name: 'angkatan'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'whatsapp',
                        name: 'whatsapp'
                    },
                    {
                        data: 'telegram',
                        name: 'telegram'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            //filter Berdasarkan satuan product
            $('#filter-satuan').change(function() {

            table
                .search($(this).val())
                .draw();

            });

        });
    </script>

@endpush

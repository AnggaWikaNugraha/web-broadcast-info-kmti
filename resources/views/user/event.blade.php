@extends('layouts.user')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0">List Events</div>

                <div class="table-responsive">
                    <table class="data-table table-striped table-hover">
                        <thead class="thead__dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Lokasi</th>
                                <th>Status</th>
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
                ajax: "{{ route('user.event') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'jam_mulai',
                        name: 'jam_mulai'
                    },
                    {
                        data: 'jam_berakhir',
                        name: 'jam_berakhir'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'statusEvent',
                        name: 'statusEvent'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

    </script>

@endpush

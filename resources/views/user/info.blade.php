@extends('layouts.user')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0">List info {{ Auth::user()->roles == '["mahasiswa"]' ? Auth::user()->mahasiswa->name : '' }}
                </div>

                <div class="table-responsive">
                    <table class="data-table table-striped table-hover">
                        <thead class="thead__dark">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Tanggal kirim</th>
                                <th>Status</th>
                                <th>Terkirim ke</th>
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
                ajax: "{{ route('user.info') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'tanggal_kirim',
                        name: 'tanggal_kirim'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'terkirim',
                        name: 'terkirim'
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

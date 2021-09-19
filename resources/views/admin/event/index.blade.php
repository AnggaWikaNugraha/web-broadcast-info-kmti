@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0">List Events
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ route('manage-event.create') }}">
                                <button class="btn btn-focus mr-3">Create Event</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table table-striped">
                        <thead class="thead__dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Cover</th>
                                <th>Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Keterangan</th>
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
                ajax: "{{ route('manage-event.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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

        var user_id;
        $(document).on('click', '.delete', function() {

            user_id = $(this).attr('id');

            $('#confirmModal').modal('show')
        });

        $('#ok_button').click(function() {
            var contentType = "application/x-www-form-urlencoded; charset=utf-8";
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "manage-users/" + user_id,
                type: "POST",
                data: {
                    token: token,
                    _method: 'DELETE',
                    id: user_id,
                },
                contentType: contentType,

                success: function(data) {
                    $('#confirmModal').modal('hide');
                    $('.data-table').DataTable().ajax.reload();
                }
            })
        });
    </script>

@endpush

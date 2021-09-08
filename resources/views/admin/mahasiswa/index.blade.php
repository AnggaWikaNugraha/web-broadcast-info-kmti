@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card p-4">

                <div class="card-header pl-0">List Mahasiswa
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ route('manage-mahasiswa.create') }}">
                                <button class="btn btn-focus mr-3">Create Mahasiswa</button>
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
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>
                        <br /> <br />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table table-striped">
                        <thead class="thead__dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Nim</th>
                                <th>Angkatan</th>
                                <th>No_wa</th>
                                <th>Id_tele</th>
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
                ajax: "{{ route('manage-mahasiswa.index') }}",
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
                        data: 'no_wa',
                        name: 'no_wa'
                    },
                    {
                        data: 'id_tele',
                        name: 'id_tele'
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

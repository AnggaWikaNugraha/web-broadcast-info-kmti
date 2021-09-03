@extends('layouts.app')

@section('body')

    @include('layouts.components.navbar')

    <div class="app-main">

        @include('layouts.components.sidebar')

        <div class="app-main__outer">
            <div class="app-main__inner">

                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card p-4">

                            <div class="card-header">List Users
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <a href="{{ route('manage-users.create') }}">
                                            <button class="btn btn-focus mr-3">Create user</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="data-table table-striped">
                                    <thead class="thead__dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>roles</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
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

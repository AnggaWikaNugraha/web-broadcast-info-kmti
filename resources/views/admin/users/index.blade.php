@extends('layouts.app')

@section('body')
    <div id="app">
        <main class="page__Dashboard">
            <div class="container-fluid h-100">

                <div class="row h-100">

                    <div class="col-2 h-100 w-100 pr-0">

                        @include('layouts.components.sidebar')

                    </div>

                    <div class="col-10 pr-4">
                        <div><h4 class="mt-4 mb-4 font-weight-bold title__admin"">WEB BROADCAST KMTI</h4></div>
                        @section('navbartitle', 'List users')
                        @include('layouts.components.navbar')

                        {{-- content --}}
                        <div class="card wrapper__card shadow-sm" >

                            <div style="height: 75vh; overflow-y: auto">

                                <a href="{{ route('manage-users.create')}}"><button class="btn btn-info text-white mb-3">Create user</button></a>
                                <table class="table data-table">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>
                        {{-- akhir conten --}}

                        <div id="confirmModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmation</h5>
                                    </div>
                                    <div class="modal-body">
                                        <h6 align="center" style="margin:0;">Are you sure you want to remove this data?</h6>
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>

<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('manage-users.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'roles', name: 'roles'},
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

    $(document).on('click', '.delete', function(){

        user_id = $(this).attr('id');

        $('#confirmModal').modal('show')});
        $('#ok_button').click(function(){

            var contentType = "application/x-www-form-urlencoded; charset=utf-8";
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url:"manage-users/"+user_id,
                type: "POST",
                data: {
                    token: token,
                    _method: 'DELETE',
                    id: user_id,
                },
                contentType: contentType,

                success:function(data)
                {
                    $('#confirmModal').modal('hide');
                    $('.data-table').DataTable().ajax.reload();
                }
            })
        });

</script>

@endpush

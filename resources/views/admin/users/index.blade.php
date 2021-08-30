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
                orderable: true,
                searchable: true
            },
          ]
      });

    });
</script>

@endpush

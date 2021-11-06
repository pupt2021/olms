@extends('main')
@section('content')
@include('UserProfile.modal.searchbook')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('Dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">List of Reserve Book</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modal">
                                <span class="fa fa-book"></span>
                                Search Book to Reserve
                            </button>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID NO</th>
                                    <th class="text-center">ACC NUM</th>
                                    <th class="text-center">ISBN</th>
                                    <th class="text-center">TITLE</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('Reserve.Datatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'accnum', name: 'accnum'},
                    {data: 'isbn', name: 'isbn'},
                    {data: 'title', name: 'title'},
                    {data: 'reservation_status', name: 'reservation_status'}
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })

        $('#datatable_search').DataTable({
            processing: true,
            serverSide: true,
            bjQueryUI: true,
            ajax : {
                url : "{{ route('Reserve.BooksDatatables') }}",
                type : "GET",
                dataType: 'JSON'
            },
            columns: [
                {data: 'mat_id', name: 'mat_id'},
                {data: 'accnum', name: 'accnum'},
                {data: 'isbn', name: 'isbn'},
                {data: 'title', name: 'title'},
                {data: 'type', name: 'type'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            responsive: true,  "autoWidth": false,
            buttons: ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $(document).on('click' , '.data-edit' , function(){
            var id = $(this).attr("data-id");
            $.ajax({
                type:"POST",
                url: '{{ route('Reserve.add') }}' ,
                data: {
                    _token: '{{ csrf_token() }}',
                    'materials_id' : id,
                }, // get all form field value in serialize form
                success: function(response){
                    /*swal.fire("Sorry this function currently not working");*/
                    if(response.status == "success"){
                        swal.fire("Reservation of Materials is Success","","success").then(function(){
                            window.location.href = "{{ route('Reserve.main') }}"
                        });
                    }else{
                        swal.fire("Something is error please contact developer", "","error");
                    }
                }
            });
        })


    </script>
@endsection


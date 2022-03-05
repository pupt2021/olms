@extends('main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('student_dashboard') }}">My Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                            <div class="">
                                <span> History of Borrowings </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID NO</th>
                                    <th class="text-center">MATERIALS ACC NUM</th>
                                    <th class="text-center">BORROWER NAME</th>
                                    <th class="text-center">CLAIM DATE</th>
                                    <th class="text-center">RETURN DATE</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                <span> Issued Books </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable2" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID NO</th>
                                    <th class="text-center">MATERIALS ACC NUM</th>
                                    <th class="text-center">BORROWER NAME</th>
                                    <th class="text-center">CLAIM DATE</th>
                                    <th class="text-center">RETURN DATE</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                <span> List Of Extension Made </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable3" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID NO</th>
                                    <th class="text-center">MATERIALS ACC NUM</th>
                                    <th class="text-center">BORROWER NAME</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div>
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

@section('scripts') {{-- Edit below for the javascript--}}
    <script>
        $(document).ready(function(){

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('StudentTable-borrow_history') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                    },
                    {data: 'accession_number', name: 'c.accession_number'},
                    {data: 'fullname', name: 'fullname'},
                    {
                        data: 'formattedBorroweddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: 'formattedReturneddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            var table2 = $('#datatable2').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                searching: false,
                ajax : {
                    url : "{{ route('StudentTable-issue-extensions') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                    },
                    {data: 'accession_number', name: 'c.accession_number'},
                    {data: 'fullname', name: 'fullname'},
                    {
                        data: 'formattedBorroweddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: 'formattedReturneddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
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

            var table3 = $('#datatable3').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                searching: false,
                ajax : {
                    url : "{{ route('StudentTable-issue-extensions_list') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                    },
                    {data: 'accession_number', name: 'c.accession_number'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'extension_status', name: 'extension_status'},
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('click' , '.extension' , function(){
                var id = $(this).attr("data-id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to request extension!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"GET",
                            url: '{{ route('book_extension') }}' ,
                            data: {
                                'borrowings_id' : id,
                                'user_id' : {{ Auth::user() -> id}},
                                'type' : "extension"
                            }, // get all form field value in serialize form
                            success: function(response){
                                /*swal.fire("Sorry this function currently not working");*/
                                if(response.status == "success"){
                                    Swal.fire(
                                        'Extension Succces!',
                                        'Your extension is pending please wait!!.',
                                        'success'
                                    ).then(function(){
                                        location.reload();
                                    });
                                }else{
                                    swal.fire("Something is error please contact developer", "","error");
                                }
                            }
                        });

                    }else{
                        Swal.fire(
                            'Extension is not requested!',
                            '',
                            'info'
                        )
                    }
                })
            });

        })
    </script>
@endsection

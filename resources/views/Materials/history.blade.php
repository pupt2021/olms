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
                            <a href="{{ route('Dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">History of Materials</li>
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
                        <div class="card-header text-center">
                            <h1 class="display-5">{{ $material->title }}</h1>
                            <h5 class="display-6">Material Borrowing/Returning History</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ACCESSION NUMBER</th>
                                    <th class="text-center">BORROWER</th>
                                    <th class="text-center">BORROW-RETURN DATES</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route('Material.index') }}">Back to Material List</a>
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

@section('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('Materials_History_Datatables', ['id' => $id]) }}",
                    type : "POST",
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                },
                // THE COLUMNS HERE ARE THE ONES QUERIED IN THE SEARCH BAR
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false
                    },
                    {
                        data: 'accession_number', 
                        name: 'materialCopy.accession_number', 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: 'borrower', 
                        name: 'user.userDetails.lastname', 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: 'borrowDates', 
                        name: 'borrowDates', 
                        orderable: true, 
                        searchable: true},
                    {
                        data: 'status', 
                        name: 'status', 
                        orderable: true, 
                        searchable: true
                    },
                ],
                responsive: true,  "autoWidth": false, "searching": true,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })
    </script>
@endsection

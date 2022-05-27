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
                        <li class="breadcrumb-item active">List of Penalty</li>
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
                            <div class="row d-flex justify-content-between">
                                <div class="col"></div>
                                
                                <div class="col text-center">
                                    <h1 class="display-4">My Penalties</h1>
                                </div>
                                @if($penaltyCount > 0)
                                    <div class="col d-flex align-items-center justify-content-end">
                                        <a href="{{route('AllPenaltyPDF')}}" class="btn btn-primary">
                                            <span class="fa fa-file-download"></span>
                                                Print All Penalty
                                        </a>
                                    </div>
                                @else
                                    <div class="col"></div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">BOOK</th>
                                    <th class="text-center">DUE DATE</th>
                                    <th class="text-center">PENALTY DAYS</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>

                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                   url : "{{ route('Penalty.My_Penalty_Datatables') }}",
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
                    {
                        data: 'book', 
                        name: 'borrowing.materialCopy.material.title' ,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: 'due_date', 
                        name: 'borrowing.date_returned',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'penalty_days', 
                        name: 'penalty_days',
                        orderable: false,
                        searchable: false,
                    }, 
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },

                 ],
                 responsive: true,
                 autoWidth: false,
                 buttons: ["csv", "excel", "pdf", "print"]
             }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         })
    </script>
@endsection

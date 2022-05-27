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
                            
                        </div>
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">BOOK</th>
                                    <th class="text-center">USER</th>
                                    <th class="text-center">PENALTY DAYS</th>
                                    @if($user_perm->contains('slug_name', 'Penalty.PDF'))
                                    <th class="text-center">ACTIONS</th>
                                    @endif
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
                    url : "{{ route('PenaltyDatatables') }}",
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
                        data: 'student', 
                        name: 'borrowing.user.userDetails.lastname' ,
                        orderable: true,
                        searchable: true,
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
             }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('click', '.settlePenaltyAndReturnBookButton', function(){
                var id = $(this).attr("data-id");
                var url = '{{ route('SettlePenaltyAndReturnBook', ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url,
                    success: function(response){
                        swal.fire(
                            response.message, 
                            "",
                            response.status)
                        .then(function(){
                            location.reload();
                        });
                    }
                });
            });
         })
    </script>
@endsection

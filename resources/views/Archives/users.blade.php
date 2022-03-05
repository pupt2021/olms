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
                        <li class="breadcrumb-item active">Archives Of Users</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%;">#</th>
                                    <th> FULLNAME </th>
                                    <th> EMAIL </th>
                                    <th> ACTION </th>
                                </tr>
                                </thead>
                                <tbody>

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
            $('#modal').on('hidden.bs.modal', function (e) {
                $('.form-control').removeClass('is-invalid');
                $('.modal-body .form-group')
                    .find("input,textarea,select")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('Users_List_Datatables') }}",
                    type : "POST",
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                },
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                    },
                    {
                        data: 'formatted_fullname_with_student_number', 
                        name: 'userDetails.lastname',
                        orderable: true, 
                        searchable: true,
                    },
                    {
                        data: 'email', 
                        name: 'email',
                        orderable: true, 
                        searchable: true,
                    },
                    {
                        data: 'action', 
                        name: 'action',
                        orderable: false, 
                        searchable: false,
                    },

                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $(document).on('click' , '.data-edit' , function(){
                var id = $(this).attr("data-id");
                var type = $(this).attr("data-type");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to restore this data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            url: '{{ route('Archive_Restore') }}' ,
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id' : id,
                                'type' : type
                            }, // get all form field value in serialize form
                            success: function(response){
                                Swal.fire(
                                    'Archive Restore',
                                    response.message,
                                    response.status,
                                ).then(function(){
                                    location.reload();
                                });
                            }
                        });

                    }else{
                        Swal.fire(
                            'Data is not restored!',
                            '',
                            'info'
                        )
                    }
                })
            });

        })
    </script>
@endsection

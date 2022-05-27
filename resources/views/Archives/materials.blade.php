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
                        <li class="breadcrumb-item active">Archives Of Materials</li>
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
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ISBN</th>
                                    <th class="text-center" style="width: 40%;">TITLE</th>
                                    <th class="text-center">TYPE</th>
                                    <th class="text-center">COPIES</th>
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
            $('.select2').select2({
                theme: "classic",
                width: "resolve"
            });

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

            $('.btn-add').on('click', function(){
                $('.for_edit').attr("hidden", false);
                $('.add_mask').addClass("col-md-6").removeClass("col-md-12");
            });

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('Materials_List_Datatables') }}",
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
                        data: 'isbn', 
                        name: 'isbn',
                        orderable: true, 
                        searchable: true,
                    },
                    {
                        data: 'title_with_subjects', 
                        name: 'title',
                        orderable: true, 
                        searchable: true,
                    },
                    {
                        data: 'type', 
                        name: 'type',
                        orderable: true, 
                        searchable: false,
                    },
                    {
                        data: 'copies', 
                        name: 'copies',
                        orderable: true, 
                        searchable: false,
                    },
                    {
                        data: 'action', 
                        name: 'action',
                        orderable: false, 
                        searchable: false,
                    },

                ],
                dom: 'Bfrtip',
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

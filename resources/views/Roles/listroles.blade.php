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
                        <li class="breadcrumb-item active">List of Roles</li>
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
                                @if($user_perm -> contains('slug_name', "Roles.store"))
                                <button type="button" class="btn btn-block btn-primary btn-md col-md-2" data-toggle="modal" data-target="#modal">
                                    <span class="fa fa-plus"></span>
                                    Add Roles
                                </button>
                                @endif
                                <div class="modal" id="modal">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Roles Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="form">
                                                <div class="modal-body">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="role_id" id="role_id">
                                                    <div class="form-group">
                                                        <label for="">Role Name</label>
                                                        <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter Role Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Role Description</label>
                                                        <input type="text" class="form-control" name="role_description" id="role_description" placeholder="Enter Role Description">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>


                                    <!-- /.modal-dialog -->
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">ID NO</th>
                                    <th class="text-center">ROLE NAME</th>
                                    @if($user_perm -> contains('slug_name', "Roles.show") || $user_perm -> contains('slug_name', "RolesDelete"))
                                    <th class="text-center">ACTIONS</th>
                                    @endif
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

            $('#form').validate({
                rules: {
                    role_name: {
                        required: true,
                    }
                },
                messages: {
                    role_name: {
                        required: "Please enter a Role Name",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    jQuery.ajax({
                        url:'{{ route('Roles.store') }}',
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'role_name': $('#role_name').val(),
                            'role_description': $('#role_description').val(),
                            'role_id' : $('#role_id').val()
                        },
                        success: function(response){
                            if(response.status == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message
                                }).then((result) => {
                                    location.reload();
                                });
                            }else{

                            }
                        }
                    });
                }
            });

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('RolesDatatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'id', name: 'role_id'},
                    {data: 'role_name', name: 'role_name'},
                    @if($user_perm -> contains('slug_name', "Roles.show") || $user_perm -> contains('slug_name', "RolesDelete"))
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    @endif
                ],
                dom: 'Bfrtip',
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



            $(document).on('click', '.data-edit', function(){
                $('#modal').modal('show');
                var id = $(this).attr("data-id");
                var url = '{{ route('Roles.show', ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type:"GET",
                    url: url,
                     // get all form field value in serialize form
                    success: function(response){
                        /*swal.fire("Sorry this function currently not working");*/
                        if(response[0]){
                            $('#role_id').val(response[0].role_id);
                            $('#role_name').val(response[0].role_name);
                            $('#role_description').val(response[0].role_description);
                        }else{
                            swal.fire("Something is error please contact developer", "","error");
                        }
                    }
                });
            });

            $(document).on('click' , '.data-delete' , function(){
                var id = $(this).attr("data-id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"POST",
                            url: '{{ route('RoleDelete') }}' ,
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id' : id,
                            }, // get all form field value in serialize form
                            success: function(response){
                                /*swal.fire("Sorry this function currently not working");*/
                                if(response.status == "success"){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your Data has been deleted.',
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
                            'Roles is not deleted!',
                            '',
                            'info'
                        )
                    }
                })
            });

        })
    </script>
@endsection

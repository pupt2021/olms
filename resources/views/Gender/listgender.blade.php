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
                        <li class="breadcrumb-item active">List of Genders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content" style="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                @if($user_perm -> contains('slug_name', "Gender.store"))
                                <button type="button" class="btn btn-block btn-primary btn-md col-md-2" data-toggle="modal" data-target="#modal">
                                    <span class="fa fa-plus"></span>
                                    Add Gender
                                </button>
                                @endif
                                <div class="modal fade" id="modal">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Gender Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="gender_form">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Gender Description</label>
                                                        <input type="text" class="form-control" name="gender_description" id="gender_description" placeholder="Enter Gender Description" autofocus>
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
                                        <th class="text-center">GENDER NAME</th>
                                        @if($user_perm -> contains('slug_name', "Gender.show") || $user_perm->contains('slug_name', 'GenderDelete'))
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


            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('GenderDatatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'gender_name', name: 'gender_name'},
                    @if($user_perm -> contains('slug_name', "Gender.show") || $user_perm->contains('slug_name', 'GenderDelete'))
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    @endif
                ],
                buttons: [
                    'excel',
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
            });
            $('.modal').on('show.bs.modal', function(e) {
                var activeElement = document.activeElement;
                $(this).on('hidden.bs.modal', function () {
                    activeElement.focus();
                    $(this).off('hidden.bs.modal');    
                });
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

            $('#gender_form').validate({
                rules: {
                    gender_description: {
                        required: true,
                    }
                },
                messages: {
                    gender_description: {
                        required: "Please enter a Gender Description",
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
                        url:'{{ route('Gender.store') }}',
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'gender_name': $('#gender_description').val()
                        },
                        success: function(response){
                            if(response.status == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Gender Data is successfully inserted'
                                }).then((result) => {
                                    location.reload();
                                });
                            }else{

                            }
                        }
                    });
                }
            });

            $(document).on('click' , '.data-edit' , function(){
                var id = $(this).attr("data-id");
                Swal.fire({
                    title: 'Submit new Gender Name Here',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    preConfirm: (edited_name) => {
                        if(edited_name){
                            var name = (`${edited_name}`);
                            $.ajax({
                                type:"POST",
                                url: '{{ route('GenderUpdate') }}' ,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id' : id,
                                    'gender_name' : name
                                }, // get all form field value in serialize form
                                success: function(response){
                                    /*swal.fire("Sorry this function currently not working");*/
                                    if(response.status == "success"){
                                        swal.fire("Update of Gender Name is Success","","success").then(function(){
                                            location.reload();
                                        });
                                    }else{
                                        swal.fire("Something is error please contact developer", "","error");
                                    }
                                }
                            });
                        }else{
                            Swal.showValidationMessage('Please input Gender Name')
                        }
                    },
                });
            })

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
                            url: '{{ route('GenderDelete') }}' ,
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
                            'Gender is not deleted!',
                            '',
                            'info'
                        )
                    }
                })
            })

        });
    </script>
@endsection

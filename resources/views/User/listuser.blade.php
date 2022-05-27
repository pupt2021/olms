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
                        <li class="breadcrumb-item active">List of Users</li>
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
                                @if($user_perm -> contains('slug_name', "User.store"))
                                <button type="button" class="btn btn-block btn-primary btn-md col-md-2" data-toggle="modal" data-target="#modal">
                                    <span class="fa fa-plus"></span>
                                    Add User
                                </button>
                                @endif
                                <div class="modal fade" id="modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">User details</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="form" class="form-horizontal">
                                                <div class="modal-body">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" id="id">
                                                    <section id="login_details">
                                                        <div class="separator">Login Details</div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">ID Number: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Number">
                                                                <small>Tip: You can use your student number or employee number</small>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Role</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <select class="form-control" name="user_role" id="user_role">
                                                                    <option value=""> Choose Option </option>
                                                                    @foreach($role as $role)
                                                                        <option value="{{ $role -> role_id }}" > {{ $role -> role_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">Password</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Confirm Password</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Email Address</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <section id="user_details">
                                                        <div class="separator">User Details</div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="">First Name: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Last Name: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Middle Name: </label>
                                                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter Middlename">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="">Gender:</label>
                                                                <select class="form-control" name="gender" id="gender">
                                                                    <option value=""> Choose Option </option>
                                                                    @foreach($gender as $gender)
                                                                        <option value="{{ $gender -> id }}" > {{ $gender -> gender_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Course:</label>
                                                                <select class="form-control" name="course" id="course">
                                                                    <option value=""> Choose Option </option>
                                                                    @foreach($course as $course)
                                                                        <option value="{{ $course -> id }}" > {{ $course -> course_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Birthdate:</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                                                <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Enter Birthday">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="">Contact No: </label>
                                                                <input type="text" class="form-control" name="contactno" id="contactno" placeholder="Enter Contact Number">
                                                            </div>
                                                            <div class="form-group col-md-8">
                                                                <label for="">Address: </label>
                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="">Barangay: </label>
                                                                <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Enter Barangay">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">City: </label>
                                                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Zip Code: </label>
                                                                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zip Code">
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <section id="role_details">
                                                        <div class="separator">Role Details</div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Student Number</label>
                                                                <input type="text" class="form-control" name="student_number" id="" placeholder="Enter Student Number">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Faculty Code</label>
                                                                <input type="text" class="form-control" name="faculty_code" id="" placeholder="Enter Faculty Code">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">Employee Number</label>
                                                                <input type="text" class="form-control" name="employee_number" id="" placeholder="Enter Employee Number">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Emplyee Status</label>
                                                                <select class="form-control" name="employee_status" id="employee_status">
                                                                    <option value="">Choose Option</option>
                                                                    <option value="1">Full Time</option>
                                                                    <option value="2">Part Time</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>

                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            </div>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th> USER ID </th>
                                        <th> USER FULLNAME </th>
                                        <th> USER EMAIL </th>
                                        @if($user_perm -> contains('slug_name', "User.show") || $user_perm->contains('slug_name', 'UserDelete'))
                                        <th> ACTIONS </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

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
                    username:{
                        required: true,
                    },
                    user_role:{
                        required: true,
                        notEqualTo: "",
                    },
                    email:{
                        required: true,
                    },
                    firstname:{
                        required: true,
                    },
                    lastname:{
                        required: true,
                    },
                    birthdate:{
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    confirm_password:{
                        required:true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    username:{
                        required: "Provide a username",
                    },
                    user_role:{
                        required: "Provide a User Role",
                    },
                    email:{
                        required: "Provide a Email Address",
                    },
                    firstname:{
                        required: "Provide a First Name",
                    },
                    lastname:{
                        required: "Provide a Last Name",
                    },
                    birthdate:{
                        required: "Provide a Birthdate",
                    },
                    password: {
                        required: "Provide a password",
                    },
                    confirm_password: {
                        required: "Repeat your password",
                        equalTo: "Your passwords do not match"
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
                        url:'{{ route('User.store') }}',
                        type: "post",
                        data: $(form).serialize(),
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
                    url : "{{ route('UserDatatables') }}",
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
                    {data: 'fullname', name: 'user_details.lastname'},
                    {data: 'email', name: 'email'},
                    @if($user_perm -> contains('slug_name', "User.show") || $user_perm->contains('slug_name', 'UserDelete'))
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    @endif
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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
                            url: '{{ route('UserDelete') }}' ,
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
                            'User is not deleted!',
                            '',
                            'info'
                        )
                    }
                })
            });

        })
    </script>
@endsection

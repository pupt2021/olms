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
                        <li class="breadcrumb-item active">Edit of User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @foreach($data as $data)
    @endforeach

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form id="form" class="form-horizontal">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                    <section id="user_details">
                                        <div class="separator">User Details</div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">First Name: </label>
                                                <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $data->firstname }}" placeholder="Enter Firstname">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Last Name: </label>
                                                <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $data->lastname }}" placeholder="Enter Lastname">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Middle Name: </label>
                                                <input type="text" class="form-control" name="middlename" id="middlename" value="{{ $data->middlename }}" placeholder="Enter Middlename">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Gender:</label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value=""> Choose Option </option>
                                                    @foreach($gender as $gender)
                                                        <option value="{{ $gender -> id }}" {{ $gender -> id == $data -> gender_id  ? 'selected' : '' }} > {{ $gender -> gender_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Course:</label>
                                                <select class="form-control" name="course" id="course">
                                                    <option value=""> Choose Option </option>
                                                    @foreach($course as $course)
                                                        <option value="{{ $course -> id }}" {{ $course -> id == $data -> course_id  ? 'selected' : '' }} > {{ $course -> course_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Birthdate:</label>
                                                <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ $data->birthday }}" placeholder="Enter Birthday">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Contact No: </label>
                                                <input type="text" class="form-control" name="contactno" id="contactno" value="{{ $data->contact_no }}" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="">Address: </label>
                                                <input type="text" class="form-control" name="address" id="address" value="{{ $data->address }}" placeholder="Enter Address">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Barangay: </label>
                                                <input type="text" class="form-control" name="barangay" id="barangay" value="{{ $data->barangay }}" placeholder="Enter Barangay">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">City: </label>
                                                <input type="text" class="form-control" name="city" id="city" value="{{ $data->city }}" placeholder="Enter City">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Zip Code: </label>
                                                <input type="text" class="form-control" name="zipcode" id="zipcode" value="{{ $data->zip_code }}" placeholder="Enter Zip Code">
                                            </div>
                                        </div>
                                    </section>
                                    <section id="role_details">
                                        <div class="separator">Role Details</div>
                                        @if($data->stud_number != "")
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Student Number</label>
                                                    <input type="text" class="form-control" name="student_number" id="student_number" value="{{ $data->stud_number }}" placeholder="Enter Student Number">
                                                </div>
                                            </div>
                                            <div class="row" hidden>
                                                <div class="form-group col-md-12">
                                                    <label for="">Faculty Code</label>
                                                    <input type="text" class="form-control" name="faculty_code" id="faculty_code" value="{{ $data->faculty_code }}" placeholder="Enter Faculty Code">
                                                </div>
                                            </div>
                                            <div class="row" hidden>
                                                <div class="form-group col-md-6">
                                                    <label for="">Employee Number</label>
                                                    <input type="text" class="form-control" name="employee_number" id="employee_number" value="{{ $data->employee_number }}" placeholder="Enter Employee Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Emplyee Status</label>
                                                    <select class="form-control" name="employee_status" id="employee_status">
                                                        <option value="" {{ $data -> employee_status == ""  ? 'selected' : '' }}>Choose Option</option>
                                                        <option value="1" {{ $data -> employee_status == 1  ? 'selected' : '' }}>Full Time</option>
                                                        <option value="2" {{ $data -> employee_status == 2 ? 'selected' : '' }}>Part Time</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @if($data->faculty_code != "")
                                            <div class="row" hidden>
                                                <div class="form-group col-md-12" >
                                                    <label for="">Student Number</label>
                                                    <input type="text" class="form-control" name="student_number" id="student_number" value="{{ $data->stud_number }}" placeholder="Enter Student Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Faculty Code</label>
                                                    <input type="text" class="form-control" name="faculty_code" id="faculty_code" value="{{ $data->faculty_code }}" placeholder="Enter Faculty Code">
                                                </div>
                                            </div>
                                            <div class="row" hidden>
                                                <div class="form-group col-md-6">
                                                    <label for="">Employee Number</label>
                                                    <input type="text" class="form-control" name="employee_number" id="employee_number" value="{{ $data->employee_number }}" placeholder="Enter Employee Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Emplyee Status</label>
                                                    <select class="form-control" name="employee_status" id="employee_status">
                                                        <option value="" {{ $data -> employee_status == ""  ? 'selected' : '' }}>Choose Option</option>
                                                        <option value="1" {{ $data -> employee_status == 1  ? 'selected' : '' }}>Full Time</option>
                                                        <option value="2" {{ $data -> employee_status == 2 ? 'selected' : '' }}>Part Time</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @if($data->employee_number != "")
                                            <div class="row" hidden>
                                                <div class="form-group col-md-12">
                                                    <label for="">Student Number</label>
                                                    <input type="text" class="form-control" name="student_number" id="student_number" value="{{ $data->stud_number }}" placeholder="Enter Student Number">
                                                </div>
                                            </div>
                                            <div class="row" hidden>
                                                <div class="form-group col-md-12">
                                                    <label for="">Faculty Code</label>
                                                    <input type="text" class="form-control" name="faculty_code" id="faculty_code" value="{{ $data->faculty_code }}" placeholder="Enter Faculty Code">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Employee Number</label>
                                                    <input type="text" class="form-control" name="employee_number" id="employee_number" value="{{ $data->employee_number }}" placeholder="Enter Employee Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Emplyee Status</label>
                                                    <select class="form-control" name="employee_status" id="employee_status">
                                                        <option value="" {{ $data -> employee_status == ""  ? 'selected' : '' }}>Choose Option</option>
                                                        <option value="1" {{ $data -> employee_status == 1  ? 'selected' : '' }}>Full Time</option>
                                                        <option value="2" {{ $data -> employee_status == 2 ? 'selected' : '' }}>Part Time</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    </section>
                                    {{-- <section id="role_details_faculty">

                                     </section>
                                     <section id="role_details_employee">

                                     </section>--}}
                                    {{--<div class="row">
                                        <div class="form-group col-md-4">
                                            <label for=""></label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for=""></label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for=""></label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter">
                                        </div>
                                    </div>--}}
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <a type="button" href="{{ route('User.index') }}" class="btn btn-warning">Back</a>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
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
            $('#form').validate({
                rules: {
                    firstname:{
                        required: true,
                    },
                    lastname:{
                        required: true,
                    },
                    gender:{
                        required: true,
                        notEqualTo: "",
                    },
                    birthdate:{
                        required: true,
                    },
                },
                messages: {
                    firstname:{
                        required: "Provide a First Name",
                    },
                    lastname:{
                        required: "Provide a Last Name",
                    },
                    gender:{
                        required: "Provide a Gender",
                    },
                    birthdate:{
                        required: "Provide a Birthdate",
                    },
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
                            Swal.fire({
                                icon: response.status,
                                title: response.message
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        })
    </script>
@endsection

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
                        <li class="breadcrumb-item active">Add User Permissions</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="form" class="form-horizontal">

                    {{ csrf_field() }}
                        <input type="hidden" name="hidden_id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><h3>List of Users</h3></label>
                                <select class="select2" id="users" name="users[]" multiple="multiple" data-placeholder="Select Users" required style="width: 100%;">
                                    @foreach($users as $users)
                                        <option value="{{ $users->id }}"> {{ $users -> username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @foreach($parent_links as $parent_links)
                            <div class="form-group">
                                <div class="card card-info">
                                    <div class="card-header">
                                            <label>{{ $parent_links -> user_link_parent_name }}</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($links as $link)
                                                @if($parent_links ->id == $link -> parent_link_id)
                                                    <div class="form-group col-md-3">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" id="checkbox{{$link->id}}" name="permissions[]" value="{{ $link->id }}">
                                                            <label for="checkbox{{$link->id}}">
                                                                {{ $link -> link_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                                <div class="modal-footer justify-content-between">
                                    <a href="{{ route('Permissions.index') }}" type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                                    <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            </form>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.select2').select2();

            $('#form').validate({
                rules: {
                    users:{
                        required: true,
                    },
                },
                messages: {
                    users:{
                        users: "This field is required",
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
                        url:'{{ route('Permissions.store') }}',
                        type: "post",
                        data: $(form).serialize(),
                        success: function(response){
                            if(response.status == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message
                                }).then((result) => {
                                    window.location.href = "{{ url('/Permissions') }}"
                                });
                            }else{

                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

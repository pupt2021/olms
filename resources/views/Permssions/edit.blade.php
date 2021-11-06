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
                        <input type="hidden" name="hidden_id" value="{{ $id }}">
                        <label><h3>Edit User Permissions</h3></label>
                        <div class="row">
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
                                                                    <input type="checkbox" class="ckbox" id="{{$link->id}}" name="permissions[]" value="{{ $link->id }}"
                                                                        @foreach($user_permissions as $permissions)
                                                                            @if($link -> id == $permissions -> link_id && $permissions -> status == "On")
                                                                                checked
                                                                            @endif
                                                                        @endforeach
                                                                    >
                                                                    <label for="{{$link->id}}">
                                                                        {{ $link -> link_name }}
                                                                    </label>
                                                                    @foreach($user_permissions as $permissions1)
                                                                        @if($link -> id == $permissions1 -> link_id)
                                                                            <input type="hidden" id="link{{$link->id}}" name="original_link[]" value="{{ $permissions1 -> link_id }}">
                                                                            <input type="hidden" id="status{{$link->id}}" name="status[]" value="{{ $permissions1 ->status }}">
                                                                        @endif
                                                                    @endforeach

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
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.select2').select2();

            $('.ckbox').on('click', function(){
                var id = $(this).attr('id');
                if($(this).prop("checked") == true) {
                    $('#status' + id).val("On");
                }
                else if($(this).prop("checked") == false) {
                    $('#status' + id).val("Off");
                }
            });

            $('#form').validate({
                rules: {
                    users:{
                        required: true,
                    },
                },
                messages: {
                    username:{
                        users: "Provide a users",
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

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
                        <li class="breadcrumb-item active">Manage Penalty Settings</li>
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
                        <!-- /.card-header -->
                        @foreach($data as $data)
                        @endforeach
                        <div class="card-body table-responsive">
                            <form id="gender_form">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $data -> id}}" id="id" name="id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Penalty Days</label>
                                            <input type="number" class="form-control" name="days" id="days" value="{{ $data -> penalty_days }}" placeholder="Enter Penalty Days" {{ $user_perm -> contains('slug_name', "ManagePenalty.store") ? '' : 'disabled'}}>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Penalty Fee</label>
                                            <input type="number" class="form-control" name="fee" id="fee" value="{{ $data -> penalty_fee }}" placeholder="Enter Penalty Fee" {{ $user_perm -> contains('slug_name', "ManagePenalty.store") ? '' : 'disabled'}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-primary float-lef" onclick="history.back()">Back</button>
                                    @if($user_perm -> contains('slug_name', "ManagePenalty.store"))
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    @endif
                                </div>
                            </form>
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

            $('#gender_form').validate({
                rules: {
                    days: {
                        required: true,
                    },
                    fee: {
                        required: true,
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
                        url:'{{ route('ManagePenalty.store') }}',
                        type: "post",
                        data: $(form).serialize(),
                        success: function(response){
                            if(response.status == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message
                                }).then((result) => {
                                    window.location.href = "{{ url('/ManagePenalty') }}"
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

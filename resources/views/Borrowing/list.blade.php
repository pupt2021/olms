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
                        <li class="breadcrumb-item active">List of Borrowings</li>
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
                                @if($user_perm -> contains('slug_name', "Borrowing.store"))
                                        <h3><center><strong>For Room Use Books</strong></center></h3>
                                        <button type="button" class="btn  btn-primary btn-md col-md-2" data-toggle="modal" data-target="#modal">
                                            <span class="fa fa-plus"></span>
                                            Borrow Materials
                                        </button>
                                @endif
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">MATERIALS ACCESSION NUMBER</th>
                                    <th class="text-center">BOOK</th>
                                    <th class="text-center">BORROWER NAME</th>
                                    <th class="text-center">CLAIM DATE</th>
                                    <th class="text-center">RETURN DATE</th>
                                    @if($user_perm -> contains('slug_name', 'Borrowing.show') || $user_perm -> contains('slug_name', 'BorrowingDelete'))
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

            {{-- MODAL --}}
            <div class="modal" id="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Room Use Form</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Search Material Accession No.: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <select  class="form-control" name="materials" id="materials" placeholder="Search Materials">
                                            <option value="" disabled selected> Choose option </option>
                                            @foreach($materials as $material)
                                                <option value={{ $material -> material_copy_id}}> {{ $material -> title}}( {{ $material -> accession_number}} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <label for="">Borrower: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <select class="form-control" id="borrower" name="borrower" placeholder="Enter Borrower">
                                            <option value="" disabled selected> Choose option </option>
                                            @foreach($borrower as $borrower)
                                            <option value={{ $borrower -> id}}> {{ $borrower -> lastname}},{{ $borrower -> firstname}} {{ $borrower -> middlename}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
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

            $('#form').validate({
                rules: {
                    borrower: {
                        required: true,
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
                        url:'{{ route('Borrowing.store') }}',
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id' : $('#id').val(),
                        },
                        data: $('#form').serialize(),
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
                    url : "{{ route('BorrowingDatatables') }}",
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
                    {data: 'accession_number', name: 'c.accession_number'},
                    {data: 'title', name: 'd.title'},
                    {data: 'fullname', name: 'fullname'},
                    {
                        data: 'formattedBorroweddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: 'formattedReturneddates', 
                        name: 'borrowedDates', 
                        orderable: true, 
                        searchable: true
                    },
                    @if($user_perm -> contains('slug_name', 'Borrowing.show') || $user_perm -> contains('slug_name', 'BorrowingDelete'))
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
                var url = '{{ route('Borrowing.show', ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type:"GET",
                    url: url,
                    // get all form field value in serialize form
                    success: function(response){
                        /*swal.fire("Sorry this function currently not working");*/
                        if(response[0]){
                            $('#id').val(response[0].id);
                            $('#materials').val(response[0].materials_id);
                            $('#borrower').val(response[0].users_id);
                            // $('#claim').val(response[0].date_borrowed);
                            // $('#return').val(response[0].date_returned);
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
                    text: "Do you want to return the book!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Return it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"POST",
                            url: '{{ route('BorrowingDelete') }}' ,
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id' : id,
                            }, // get all form field value in serialize form
                            success: function(response){
                                Swal.fire(
                                    response.title,
                                    response.message,
                                    response.status,
                                ).then(function(){
                                    location.reload();
                                });
                            }
                        });

                    }else{
                        Swal.fire(
                            'Book is not returned!',
                            '',
                            'info'
                        )
                    }
                })
            });

        })
    </script>
@endsection

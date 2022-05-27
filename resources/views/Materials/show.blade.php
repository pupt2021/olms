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
                        <li class="breadcrumb-item">
                            <a href="{{ route('Material.index') }}">Materials</a>
                        </li>
                        <li class="breadcrumb-item active">Material View</li>
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
                        <div class="card-body table-responsive">
                            {{-- Title and ISBN --}}
                            <div class="row my-1">
                                <div class="col text-left">
                                    <h1 class="display-5 fw-bold">{{$material->title}}</h4>
                                    <p><b>{{$material->isbn ?? 'NO ISBN PROVIDED'}}</b></p>
                                </div>
                                <div class="col text-center d-flex justify-content-end">
                                    <div class="mr-1">
                                        <a type="button" title="ADD COPIES" data-id="{{$material->materials_id}}" class="btn btn-primary material-add-copy" id="material-add-copy">
                                            <span class="fa fa-plus"></span>
                                        </a>
                                    </div>

                                    <div class="mr-1">
                                        <a type="button" title="HISTORY" href="{{ route('Materials_History', ['id' => base64_encode($material->materials_id)]) }}" class="btn btn-info" style="background-color: green">
                                            <span class="fa fa-history"></span>
                                        </a>
                                    </div>

                                    @if ($user_permission->contains('slug_name', 'Material.show'))
                                        <div class="mr-1">
                                            <a type="button" title="EDIT" class="btn btn-info data-edit" id="data-edit" data-id="{{$material->materials_id}}">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                        </div>
                                    @endif

                                    @if ($user_permission->contains('slug_name', 'MaterialsDelete'))
                                        <div>
                                            <a type="button" title="DELETE" class="btn btn-warning data-delete" id="data-delete" data-id="{{$material->materials_id}}">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Material Details --}}
                            <div class="row my-1">

                                {{-- Column 1 --}}
                                <div class="col">
                                    <p><b>Author</b>: {{$material->author ?? 'NONE PROVIDED'}}</p>
                                    <p><b>Publisher</b>: {{$material->publisher ?? 'NONE PROVIDED'}}</p>
                                    <p><b>Edition</b>: {{$material->edition ?? 'NONE PROVIDED'}}</p>
                                    <p><b>Copyright</b>: {{$material->copyright ?? 'NONE PROVIDED'}}</p>
                                </div>

                                {{-- Column 2 --}}
                                <div class="col">
                                    <p><b>Call No.</b>: {{$material->callno ?? 'NONE PROVIDED'}}</p>
                                    <p><b>Type</b>: 
                                        @if($material->type === 1)
                                            {{ 'Borrowing' }}
                                        @elseif($material->type === 2)
                                            {{ 'Room Use' }}
                                        @endif
                                    </p>
                                    <p><b>Total Copies</b>: 
                                        @if($materialCopies->isNotEmpty())
                                            {{$materialCopies->count()}}
                                        @else
                                            NONE
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Material Copies Table --}}
                            <table class="table table-bordered table-striped my-2">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">DATE RECIEVED</th>
                                    <th class="text-center">ACCESSION NUMBER</th>
                                    <th class="text-center">IS AVAILABLE</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if($materialCopies->isNotEmpty())
                                        @php $i = 1; @endphp
                                        @foreach($materialCopies as $materialCopy)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$materialCopy->formatted_date_recieved}}</td>
                                                <td>{{$materialCopy->accession_number}}</td>
                                                <td>
                                                    @if(! $materialCopy->borrows_id === NULL)
                                                        {{ 'Borrowing ID: ' . $materialCopy->borrows_id}}
                                                    @else
                                                        YES
                                                    @endif
                                                </td>
                                                <td>
                                                    <a type="button" title="EDIT" class="btn btn-info material-copy-edit" id="material-copy-edit" data-id="{{$materialCopy->material_copy_id}}">
                                                        <span class="fa fa-edit"></span>
                                                    </a>

                                                </td>
                                            </tr>
                                            @php $i += 1; @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                <p>NO COPIES FOUND.
                                                    <a title="ADD COPIES" data-id="{{$material->materials_id}}" class="material-add-copy" id="material-add-copy">ADD ONE HERE
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        

            {{-- MODALS --}}

            {{-- MATERIALS FORM MODAL --}}
            <div class="modal" id="modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Materials Edit Form</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="materialForm">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">ISBN: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ISBN">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Title:</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 add_mask">
                                        <label for="">CALL NO:</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="text" class="form-control" name="callno" id="callno" placeholder="Enter Call No.">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Author:</label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="text" class="form-control" name="author" id="author" placeholder="Enter Author">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Publisher: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter Publisher.">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Edition: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <select type="text" class="form-control" name="edition" id="edition" placeholder="Enter Edition: ">
                                            <option value="" > Choose Option</option>
                                            <option value="1st Edition">1st Edition</option>
                                            <option value="2nd Edition">2nd Edition</option>
                                            <option value="3rd Edition">3rd Edition</option>
                                            <option value="4th Edition">4th Edition</option>
                                            <option value="5th Edition">5th Edition</option>
                                            <option value="6th Edition">6th Edition</option>
                                            <option value="7th Edition">7th Edition</option>
                                            <option value="8th Edition">8th Edition</option>
                                            <option value="9th Edition">9th Edition</option>
                                            <option value="10th Edition">10th Edition</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Copyright:  </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="number" class="form-control" name="copyright" id="copyright" placeholder="Enter Copyright: ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Type:  </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <select type="text" class="form-control" name="type" id="type" placeholder="Enter Type: ">
                                            <option value="" > Choose Option</option>
                                            <option value="1"> Borrowing</option>
                                            <option value="2"> Room Use</option>
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
            </div><!-- /.modal -->

            {{-- MATERIAL ADD COPY FORM MODAL --}}
            <div class="materialAddCopyModal modal" id="materialAddCopyModal">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Material Copy</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="materialAddCopyForm">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Number of Copies: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="number" class="form-control" name="copies" id="copies" placeholder="Enter Number of Copies" min="1" required>
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
            </div><!-- /.modal -->

            {{-- MATERIAL EDIT COPY FORM MODAL --}}
            <div class="materialEditCopyModal modal" id="materialEditCopyModal">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Material Copy</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="materialEditCopyForm">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="copy_id" name="copy_id">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Accession Number: </label>
                                        <input type="text" class="form-control" id="accession_number" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Date Recieved: </label><small style="color:red;">&nbsp&nbsp&nbsp(Required)</small>
                                        <input type="date" class="form-control" name="date_recieved" id="date_recieved" required>
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
            </div><!-- /.modal -->

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

            // MATERIAL
            $('#materialForm').validate({
                rules: {
                    structure: {
                        required: true,
                    },
                    isbn: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    author: {
                        required: true,
                    },
                    publisher: {
                        required: true,
                    },
                    copyright: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    subject: {
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
                        url:'{{ route('Material.store') }}',
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

            $(document).on('click', '.data-edit', function(){
                $('#modal').modal('show');
                var url = "{{ route('Materials.ShowEditValues', ['id' => $material->materials_id]) }}";
                $.ajax({
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url,
                    // get all form field value in serialize form
                    success: function(response){
                        /*swal.fire("Sorry this function currently not working");*/
                        if(response[0]){
                            $('.for_edit').attr("hidden", true);
                            $('.add_mask').removeClass("col-md-6").addClass("col-md-12");
                            $('#id').val(response[0].materials_id);
                            $('#isbn').val(response[0].isbn);
                            $('#title').val(response[0].title);
                            $('#callno').val(response[0].callno);
                            $('#author').val(response[0].author);
                            $('#publisher').val(response[0].publisher);
                            $('#edition').val(response[0].edition);
                            $('#copyright').val(response[0].copyright);
                            $('#type').val(response[0].type);
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
                            url: '{{ route('MaterialsDelete') }}' ,
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
                                        window.location = "{{ route('Material.index') }}"
                                    });
                                }else{
                                    swal.fire("Something is error please contact developer", "","error");
                                }
                            }
                        });

                    }else{
                        Swal.fire(
                            'Data is not deleted!',
                            '',
                            'info'
                        )
                    }
                })
            });

            // MATERIAL COPY

            $(document).on('click', '.material-copy-edit', function(){
                $('#materialEditCopyModal').modal('show');
                var copy_id = $(this).attr("data-id");
                var url = "{{ route('Material.MaterialCopy.ShowEditValues', ['id' => $material->materials_id, 'copy_id' => ':id']) }}";
                url = url.replace(':id', copy_id);
                $.ajax({
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url,
                    // get all form field value in serialize form
                    success: function(response){
                        /*swal.fire("Sorry this function currently not working");*/
                        if(response[0]){
                            $('#accession_number').val(response[0].accession_number);
                            $('#date_recieved').val(response[0].date_recieved);
                            $('#copy_id').val(response[0].material_copy_id);
                        }else{
                            swal.fire("Something is error please contact developer", "","error");
                        }
                    }
                });
            });

            $(document).on('click', '.material-add-copy', function(){
                $('#materialAddCopyModal').modal('show');
            });

            $('#materialEditCopyForm').validate({
                rules: {
                    date_recieved: {
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
                    var copy_id = $('#copy_id').val();
                    var url = "{{ route('Material.MaterialCopy.update', ['id' => $material->materials_id, 'copy_id' => ':id']) }}";
                    url = url.replace(':id', copy_id);
                    jQuery.ajax({
                        url: url,
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'copy_id' : $('#copy_id').val(),
                            'date_recieved': $('#date_recieved').val(),
                        },
                        data: $('#materialEditCopyForm').serialize(),
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


            $('#materialAddCopyForm').validate({
                rules: {
                    copies: {
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
                        url:'{{ route('Material.MaterialCopy.store', ['id' => base64_encode($material->materials_id)]) }}',
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'copies' : $('#copies').val(),
                        },
                        data: $('#materialAddCopyForm').serialize(),
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
        })
    </script>
@endsection

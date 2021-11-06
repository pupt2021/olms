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
                        <li class="breadcrumb-item active">List of Penalty</li>
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
                                <div class="modal" id="modal">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Materials Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="form">
                                                <div class="modal-body">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">ISBN: </label>
                                                            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ISBN">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Title:</label>
                                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Author:</label>
                                                            <input type="text" class="form-control" name="author" id="author" placeholder="Enter Author">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Publisher: </label>
                                                            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter Publisher.">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Edition: </label>
                                                            <input type="number" class="form-control" name="edition" id="edition" placeholder="Enter Author">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Date Received: </label>
                                                            <input type="date" class="form-control" name="daterec" id="daterec" placeholder="Enter Date Received: ">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Copyright:  </label>
                                                            <input type="number" class="form-control" name="copyright" id="copyright" placeholder="Enter Copyright: ">
                                                        </div>
                                                        {{-- <div class="form-group col-md-6">
                                                            <label for="">Copies: </label>
                                                            <input type="number" class="form-control" name="copies" id="copies" placeholder="Enter Copies: ">
                                                        </div> --}}
                                                        <div class="form-group col-md-6">
                                                            <label for="">Type:  </label>
                                                            <select type="text" class="form-control" name="type" id="type" placeholder="Enter Type: ">
                                                                <option value=""> Choose Option</option>
                                                                <option value="1"> ISSUING</option>
                                                                <option value="2"> BORROWING</option>
                                                            </select>
                                                        </div>
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
                                    <th class="text-center">PENALTY NO</th>
                                    <th class="text-center">USER</th>
                                    <th class="text-center">PENALTY DAYS</th>
                                    @if($user_perm->contains('slug_name', 'Penalty.PDF'))
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

        //     $('.select2').select2({
        //         theme: "classic",
        //         width: "resolve"
        //     });

        //     $('#modal').on('hidden.bs.modal', function (e) {
        //         $('.form-control').removeClass('is-invalid');
        //         $('.modal-body .form-group')
        //             .find("input,textarea,select")
        //             .val('')
        //             .end()
        //             .find("input[type=checkbox], input[type=radio]")
        //             .prop("checked", "")
        //             .end();
        //     })

        //     $('#form').validate({
        //         rules: {
        //             structure: {
        //                 required: true,
        //             },
        //             isbn: {
        //                 required: true,
        //             },
        //             title: {
        //                 required: true,
        //             },
        //             callno: {
        //                 required: true,
        //             },
        //             author: {
        //                 required: true,
        //             },
        //             publisher: {
        //                 required: true,
        //             },
        //             edition: {
        //                 required: true,
        //             },
        //             daterec: {
        //                 required: true,
        //             },
        //             copyright: {
        //                 required: true,
        //             },

        //             type: {
        //                 required: true,
        //             },

        //             subject: {
        //                 required: true,
        //             },

        //         },
        //         errorElement: 'span',
        //         errorPlacement: function (error, element) {
        //             error.addClass('invalid-feedback');
        //             element.closest('.form-group').append(error);
        //         },
        //         highlight: function (element, errorClass, validClass) {
        //             $(element).addClass('is-invalid');
        //         },
        //         unhighlight: function (element, errorClass, validClass) {
        //             $(element).removeClass('is-invalid');
        //         },
        //         submitHandler: function(form) {
        //             jQuery.ajax({
        //                 url:'{{ route('Material.store') }}',
        //                 type: "post",
        //                 data: {
        //                     '_token': $('input[name=_token]').val(),
        //                     'id' : $('#id').val(),
        //                 },
        //                 data: $('#form').serialize(),
        //                 success: function(response){
        //                     if(response.status == "success"){
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: response.message
        //                         }).then((result) => {
        //                             location.reload();
        //                         });
        //                     }else{

        //                     }
        //                 }
        //             });
        //         }
        //     });

            var table = $('#datatable').DataTable({
                processing: true,
               serverSide: true,
               bjQueryUI: true,
               ajax : {
                   url : "{{ route('PenaltyDatatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
             columns: [
                   {data: 'penalty_id', name: 'penalty_id'},
                   {data: 'username', name: 'username'},
                   {data: 'penalty_days', name: 'penalty_days'},
                     @if($user_perm->contains('slug_name', 'Penalty.PDF'))
                     {
                         data: 'action',
                         name: 'action',
                         orderable: true,
                         searchable: true
                    },
                    @endif
                 ],
                 responsive: true,
                 autoWidth: false,
                //  buttons: ["csv", "excel", "pdf", "print"]
             }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        //     $(document).on('click', '.data-edit', function(){
        //         $('#modal').modal('show');
        //         var id = $(this).attr("data-id");
        //         var url = '{{ route('Material.show', ":id") }}';
        //         url = url.replace(':id', id);
        //         $.ajax({
        //             type:"GET",
        //             url: url,
        //             // get all form field value in serialize form
        //             success: function(response){
        //                 /*swal.fire("Sorry this function currently not working");*/
        //                 if(response[0]){
        //                     $('.for_edit').attr("hidden", true);
        //                     $('.add_mask').removeClass("col-md-6").addClass("col-md-12");
        //                     $('#id').val(response[0].materials_id);
        //                     $('#isbn').val(response[0].isbn);
        //                     $('#title').val(response[0].title);
        //                     $('#callno').val(response[0].callno);
        //                     $('#author').val(response[0].author);
        //                     $('#publisher').val(response[0].publisher);
        //                     $('#edition').val(response[0].edition);
        //                     $('#daterec').val(response[0].date_received);
        //                     $('#copyright').val(response[0].copyright);
        //                     $('#type').val(response[0].type);
        //                 }else{
        //                     swal.fire("Something is error please contact developer", "","error");
        //                 }
        //             }
        //         });
        //     });


        //     $(document).on('click' , '.data-delete' , function(){
        //         var id = $(this).attr("data-id");
        //         Swal.fire({
        //             title: 'Are you sure?',
        //             text: "You won't be able to revert this!",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, delete it!'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $.ajax({
        //                     type:"POST",
        //                     url: '{{ route('MaterialsDelete') }}' ,
        //                     data: {
        //                         '_token': $('input[name=_token]').val(),
        //                         'id' : id,
        //                     }, // get all form field value in serialize form
        //                     success: function(response){
        //                         /*swal.fire("Sorry this function currently not working");*/
        //                         if(response.status == "success"){
        //                             Swal.fire(
        //                                 'Deleted!',
        //                                 'Your Data has been deleted.',
        //                                 'success'
        //                             ).then(function(){
        //                                 location.reload();
        //                             });
        //                         }else{
        //                             swal.fire("Something is error please contact developer", "","error");
        //                         }
        //                     }
        //                 });

        //             }else{
        //                 Swal.fire(
        //                     'Data is not deleted!',
        //                     '',
        //                     'info'
        //                 )
        //             }
        //         })
        //     });

         })
    </script>
@endsection

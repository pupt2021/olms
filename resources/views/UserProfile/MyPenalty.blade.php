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
                            <a href="{{ route('student_dashboard') }}">My Dashboard</a>
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
                                    <th class="text-center">BOOK</th>
                                    <th class="text-center">PENALTY DAYS</th>
                                    <th class="text-center">ACTIONS</th>
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
                   url : "{{ route('Penalty.My_Penalty_Datatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
             columns: [
                   {data: 'penalty_id', name: 'penalty_id'},
                   {data: 'accnum', name: 'accnum'},
                   {data: 'penalty_days', name: 'penalty_days'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                 ],
                 responsive: true,
                 autoWidth: false,
                 buttons: ["csv", "excel", "pdf", "print"]
             }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


         })
    </script>
@endsection

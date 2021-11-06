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
                        <li class="breadcrumb-item active">List of Daily Time Record</li>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead class="text-center">
                                <tr>
                                    <th class="text-center">USER IMAGES</th>
                                    <th class="text-center">USER</th>
                                    <th class="text-center">TIME IN</th>
                                    <th class="text-center">TIME OUT</th>
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
                searching: false,
                ajax : {
                    url : "{{ route('DTR.view_datatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'images', name: 'images'},
                    {data: 'username', name: 'username'},
                    {data: 'timein', name: 'timein'},
                    {data: 'timeout', name: 'timeout'},
                ],
                responsive: true,  "autoWidth": false,
            });
        })
    </script>
@endsection

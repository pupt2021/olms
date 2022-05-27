@include('partials._head')
<body class="hold-transition login-page">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="register-box">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-thumbnail" src="{{ asset('img/avatar.png') }}" alt="User profile picture" width="500" height="600">
                            </div>
                        </div>
                        @foreach($user_data as $data)
                        @endforeach
                        <div class="card-body register-card-body">
                            <div class="user-details text-center">
                                <strong><i class="fas fa-user mr-1"></i> Full Name: </strong>

                                <p class="text-muted">
                                    {{ $data -> lastname  }} , {{ $data -> firstname }} {{ $data -> middlename }}
                                </p>

                                <hr>

                                @if(!empty($data->stud_number))
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Student Number</strong>
                                    <p class="text-muted">{{ $data -> stud_number }}</p>
                                @endif
                                @if(!empty($data->faculty_code))
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Faculty Code</strong>
                                    <p class="text-muted">{{ $data -> faculty_code }}</p>
                                @endif
                                @if(!empty($data->employee_number))
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Employee Number</strong>
                                    <p class="text-muted">{{ $data -> employee_number }}</p>
                                @endif
                                <hr><hr>
                            </div>
                            <div class="social-auth-links text-center">
                                <button type="button" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modal">
                                    <span class="fa fa-book"></span>
                                    Search Book
                                </button>
                                <a href="{{ route('DTR.main') }}" class="btn btn-block btn-danger">
                                    <i class="fa fa-power-off mr-2"></i>
                                    Logout
                                </a>
                            </div>
                            <div class="modal" id="modal">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Book Searching</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="form">
                                            <div class="modal-body">
                                                <div class="card-body table-responsive">
                                                    <table id="datatable" class="table table-bordered table-striped">
                                                        <thead class="text-center">
                                                        <tr>
                                                            <th class="text-center">ID NO</th>
                                                            <th class="text-center">ISBN</th>
                                                            <th class="text-center">TITLE</th>
                                                            <th class="text-center">TYPE</th>
                                                            <th class="text-center">AVAILABLE COPIES</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-center">

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</body>
@include('partials._javascript')

<script>
    var timeoutInMiliseconds = 30000;
    var timeoutId;

    function startTimer() {
        // window.setTimeout returns an Id that can be used to start and stop a timer
        timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds)
    }

    function resetTimer() {
        window.clearTimeout(timeoutId)
        startTimer();
    }

    function doInactive() {
        window.location.href = '{{ route('DTR.main') }}'
    }

    function setupTimers () {
        document.addEventListener("mousemove", resetTimer, false);
        document.addEventListener("mousedown", resetTimer, false);
        document.addEventListener("keypress", resetTimer, false);
        document.addEventListener("touchmove", resetTimer, false);
        startTimer();
    }

    $(document).ready(function(){
        setupTimers();

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            bjQueryUI: true,
            ajax : {
                url : "{{ route('DTR.search') }}",
                type : "GET",
                dataType: 'JSON'
            },
            columns: [
                {data: 'materials_id', name: 'materials_id'},
                {data: 'isbn', name: 'isbn'},
                {data: 'title', name: 'title'},
                {data: 'material_type', name: 'material_type'},
                {data: 'available_copies', name: 'available_copies'}
            ],
            responsive: true,  "autoWidth": false,
            buttons: ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })

</script>

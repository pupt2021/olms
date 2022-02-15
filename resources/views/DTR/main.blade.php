@include('partials._head')
@include('DTR.modal.searchbook')
<head>
<style>
#contentTime {
	float: right;
	font-size: 150px;
	color: #FFFFFF;
	width: 80%;
	font-family: century gothic;
	text-align: left;
    margin-right:80px;
}

#contentDate {
    padding-top:30px;
	float: left;
	font-size: 40px;
	color: #FFFFFF;
	width: 93%;
	font-family: century gothic;
	text-align: left;
    margin-left:350px;
}

#txt {
    color:#FFFFFF;
}

#txt1 {
    margin-top:-50px;
    font-size: 20px;
    float:left;
}

body {
    background-image: url('{{ asset('img/background1.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.row_cell--fill {
    flex: 1;
}

hr {
    border-top: 7px solid #ffc511 !important;
}

#button1, #button2, #button3, #button4 {
    background-color:#801e1d;
    border: none;
}

#main {
    padding-top:250px;

}

</style>
</head>
<body onload="startTime()" class="hold-transition">
<!-- <div class="login-box"> -->
    <!-- /.login-logo -->


    <div id="main" class="container">
        <div class="row">
            <div id="timein" class="col-md-4" style="margin-left:-90px;">
                <div class="card card-primary">
                    <div class="card-body">
                        <h3 class="login-box-msg"><strong>Time-in / Time-out </strong></h3>
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <button id="button1" type="submit" id="save" class="btn-block btn btn-primary">Time-in/Time-out</button>
                                    <br>
                                    <hr style="border-top: 2px solid #808080 !important;"><br>
                                    <button id="button3" type="button" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modal">
                                        <span class="fa fa-book"></span>&nbsp Search Book
                                    </button>
                                    <button id="button4" type="button" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modal">
                                        <span class="fas fa-user-secret"></span>&nbsp Enter as a Guest
                                    </button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-8">
            <!--  -->
                <div id="contentTime" >
                    <div>
                    <p id="txt"></p>

                    <p id="txt1">&nbspHOURS  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMINUTES  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp&nbsp  SECONDS&nbsp&nbsp&nbsp&nbsp&nbsp</p>

                    <div id="contentDate">
                        <?php
                            echo date("l");
                            echo  ", ".date("F d, Y");
                        ?>
                    </div>
                    </div>
                </div>
            <!--  -->
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-">
            <!--  -->

            <!--  -->
            </div>
        </div>
    </div>
    <!-- /.card -->
<!-- </div> -->
<!-- /.login-box -->

@include('partials._javascript')

<script>

        $(document).ready(function(){

            $('#form').validate({
                rules: {
                    username:{
                        required: true,
                    },
                    password:{
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "Please enter Username",
                    },
                    password: {
                        required: "Please enter Password"
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
                        url:'{{ route('DTR.login') }}',
                        type: "post",
                        data: $(form).serialize(),
                        success: function(response){
                            if(response.status == "success"){
                                Swal.fire({
                                    icon: 'success',
                                    title: String(response.message),
                                }).then((result) => {
                                    location.reload();
                                });
                            }else if(response.status == "error"){
                                Swal.fire({
                                    icon: 'error',
                                    title: String(response.message),
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });

            var table = $('#search_book').DataTable({
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
                    {data: 'accnum', name: 'accnum'},
                    {data: 'isbn', name: 'isbn'},
                    {data: 'title', name: 'title'},
                    {data: 'callno', name: 'callno'},
                    {data: 'type', name: 'type'},
                    {data: 'is_available', name: 'is_available'}
                ],
                responsive: true,  "autoWidth": false,
                buttons: ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
// ------------------
        function startTime() {
    const today=new Date();
    let h=today.getHours();
    let m=today.getMinutes();
    let s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
	if( h == 12 )
	{
    document.getElementById('txt').innerHTML = "12"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 13 )
	{
    document.getElementById('txt').innerHTML = "01"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 14 )
	{
    document.getElementById('txt').innerHTML = "02"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 15 )
	{
    document.getElementById('txt').innerHTML = "03"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 16 )
	{
    document.getElementById('txt').innerHTML = "04"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 17 )
	{
    document.getElementById('txt').innerHTML = "05"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 18 )
	{
    document.getElementById('txt').innerHTML = "06"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 19 )
	{
    document.getElementById('txt').innerHTML = "07"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 20 )
	{
    document.getElementById('txt').innerHTML = "08"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 21 )
	{
    document.getElementById('txt').innerHTML = "09"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 22 )
	{
    document.getElementById('txt').innerHTML = "10"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 23 )
	{
    document.getElementById('txt').innerHTML = "11"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 24 )
	{
    document.getElementById('txt').innerHTML = "12"+":"+m+":"+s+"&nbspPM";
    var t = setTimeout(function(){startTime()},500);
	}
	else if( h == 0 )
	{
    document.getElementById('txt').innerHTML = "12"+":"+m+":"+s+"&nbspAM";
    var t = setTimeout(function(){startTime()},500);
	}
	else
	{
	document.getElementById('txt').innerHTML = h+":"+m+":"+s+"&nbspAM";
    var t = setTimeout(function(){startTime()},500);
	}
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>

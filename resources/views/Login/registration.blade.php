@include('partials._head')
<head>
<style>
  .login {
    min-height: 100vh;
  }

  .bg-image {
    background-image: url('{{ asset('img/PUP-2.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .login-heading {
    font-weight: 300;
  }

  .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
  }

  .img {
    margin:20px;
    width:150px;
    height:150px;
  }
</style>
</head>
<body class="hold-transition login-page">
<!-- <div class="login-box"> -->
    <!-- /.login-logo -->

    <div class="container-fluid ps-md-0">
    <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">

            <div class="image">
              <center>
                <img style="width:180px;height:160px;padding-bottom: 20px;margin-top:-30px;" src="{{ asset('landing/images/logo.png') }}" class="imgs" alt="LIBRARY LOGO">
              </center>
            </div>
              <h1 class="login-heading mb-4"><strong><center>PUP-Taguig&nbsp; </strong>Online Library Management System</center></h1>
              <h6 style="padding-bottom: 20px;"><center>Sign up Here</center></h6>

              <!-- Sign In Form -->
        <div class="card-body">
            <form action="{{ route('user_login') }}" method="post" id="form">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-8 input-group mb-3">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username or ID Number" autofocus>
                      <div class="input-group-append">
                          <div class="input-group-text">
                              <span class="fas fa-user"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 input-group mb-3">
                      <input type="text" class="form-control" placeholder="Student" disabled>
                      <div class="input-group-append">
                          <div class="input-group-text">
                              <span class="fas fa-user-tag"></span>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-at"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-6 input-group mb-3">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <div class="input-group-append">
                          <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 input-group mb-3">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype Password">
                      <div class="input-group-append">
                          <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <!-- <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #801e1d;border: none;">Sign Up</button>
                    </div>
                    <div class="col-12" style="padding-top:20px;">
                      <span><a href="{{URL::to('/Login')}}" style="color:maroon;text-decoration: underline;">I already have an account</a></span>
                      <br>
                      <span><a href="{{URL::to('')}}" style="color:maroon;text-decoration: underline;">Go back to page</a></span>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- </div> -->



</div>
<!-- /.login-box -->

@include('partials._javascript')

<script>
    $(document).ready(function(){
        $('#form').validate({
            rules: {
                username:{
                    required: true,
                },
                email:{
                    required: true,
                },
                firstname:{
                    required: true,
                },
                lastname:{
                    required: true,
                },
                password: {
                    required: true,
                },
                confirm_password:{
                    required:true,
                    equalTo: '#password'
                }
            },
            messages: {
                username:{
                    required: "Provide a username",
                },
                email:{
                    required: "Provide a Email Address",
                },
                firstname:{
                    required: "Provide a First Name",
                },
                lastname:{
                    required: "Provide a Last Name",
                },
                password: {
                    required: "Provide a password",
                },
                confirm_password: {
                    required: "Repeat your password",
                    equalTo: "Your passwords do not match"
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
                    url:'{{ route('user_registration') }}',
                    type: "get",
                    data: $(form).serialize(),
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

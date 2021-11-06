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
                <img style="width:180px;height:160px;padding-bottom: 20px;" src="{{ asset('landing/images/logo.png') }}" class="imgs" alt="LIBRARY LOGO">
              </center>
            </div>
              <h1 class="login-heading mb-4"><strong><center>PUP-Taguig&nbsp; </strong>Online Library Management System</center></h1>
              <h6 style="padding-bottom: 20px;"><center>Sign in to start your session</center></h6>
              


              <!-- Sign In Form -->
        <div class="card-body">
            <form action="{{ route('user_login') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username or ID Number" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
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
                    <div class="col-12" style="padding-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #801e1d;border: none;">Sign In</button>
                    </div>
                    <div class="col-12" style="padding-top:20px;">
                      <span><a href="{{URL::to('/Register')}}" style="color:maroon;text-decoration: underline;">Sign Up</a></span>
                      <br>
                      <span><a href="{{URL::to('')}}" style="color:maroon;text-decoration: underline;">Go back to page</a></span>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row" style="padding-top:50px;">
                  <p><center>By using this service, you understood and agree to the PUP Online Services <a herf="#">Terms of Use</a> and <a herf="#">Privacy Statement</a></center></p>
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

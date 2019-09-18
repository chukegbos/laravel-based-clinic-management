<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from healthadmin.thememinister.com/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2019 10:23:02 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <!-- style css -->
    <link href="assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylehealth-rtl.css" rel="stylesheet" type="text/css"/>-->
    <style>
        body{
            background-image: url('assets/img/hospital.jpg');
            background-repeat: no-repeat, repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="back-link">
            <a href="{{ url('/') }}" class="btn btn-success">Back to Dashboard</a>
        </div>

        @if(isset($status))
            <div class="alert alert-success alert-dismissable" style="margin:20px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                {{ $status}}
            </div>
          @endif

          @if(isset($error))
            <div class="alert alert-danger alert-dismissable" style="margin:20px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-times"></i> Oops!</h4>
                {{ $error}}
            </div>
          @endif

                      
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label" for="email">Login Email</label>
                            <input type="email" placeholder="example@gmail.com" title="Please enter you login email" required autofocus value="{{ old('email') }}" name="email" id="email" class="form-control">
                             @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <span class="help-block small">Your unique email to app</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password"  required=""  name="password" id="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <span class="help-block small">Your strong password</span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary">Login</button>
                            <a class="btn btn-warningk" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

<!-- Mirrored from healthadmin.thememinister.com/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2019 10:23:02 GMT -->
</html>
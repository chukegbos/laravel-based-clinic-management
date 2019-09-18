<!DOCTYPE html>
<html lang="en">
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
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Hospital Setup</h3>
                                <small><strong>Please put the hospital credentials to set the hospital up</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/activate') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label">Name of the Hospital</label>
                                <input type="text" placeholder="Univeristy of Nigeria Teaching Hospital" required autofocus value="{{ old('sitename') }}" name="sitename" id="sitename" class="form-control">
                                 @if ($errors->has('sitename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sitename') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you login email" required autofocus value="{{ old('email') }}" name="email" id="email" class="form-control">
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block small">Your unique email to app</span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input type="tel"  title="Please enter you login email" required autofocus  name="phone" class="form-control">
                            </div>

                            <div>
                                <button class="btn btn-primary">Register</button>
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
</html>
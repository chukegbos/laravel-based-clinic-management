<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', 'roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                position: fixed;
                
                color: blue;
            }

            .title {
                font-size: 65px;
                font-weight: bolder;
                color: white;
                font-family: roboto;
            }

            .links > a {
                color: #210984;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 900;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 20px;
            }

            #myVideo {
              position: fixed;
              right: 0;
              bottom: 0;
              min-width: 100%; 
              min-height: 100%;
            }
        </style>
    </head>
    <body>
        <video autoplay muted loop id="myVideo">
              <source src="video/vid.mp4" type="video/mp4">
            </video>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links" style="color: white;font-weight: bold;">
                    @auth
                        <a href="{{ url('/home') }}" >Dashboard</a>
                    @else
                        @if(isset($reactivate))
                            <span  style="color: white;">Your account has expired, </span> <a href="#" style="color: white"><i class="fa fa-sign-in"></i>Click to Reactivate</a>
                        
                        @elseif(isset($login))
                            <span  style="color: white;">Your account will on {{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->date_expire))->toFormattedDateString() }}, </span> <a href="{{ route('login') }}" style="color: white"><i class="fa fa-sign-in"></i>Login</a>
                        @else
                            <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="color: red">
                    Welcome to SMIS Clinic<br>
                    <span style="font-size: 26px">Secure Management Information System</span>
                </div>

                <div class="links">
                    <a href="#">Documentation</a>
                    <a href="#">About SMIS</a>
                    <a href="#">Contact Us</a>
                    <a href="#">FAQ</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </body>
</html>

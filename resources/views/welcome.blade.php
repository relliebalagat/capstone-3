<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/general-style.css') }}" rel="stylesheet" type="text/css" >
        <style>
            html, body {
                color: #636b6f;
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
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .content-right, .content-left {
                width: 50%;
                display: inline;
                height: 100vh;
            }

            .content-left {
                background-image: linear-gradient(-150deg, #B7F8DB 0%, #50A7C2 100%);
            }

            .content-left > ul {
                list-style-type: none;
                transform: translate(0, 28vh);
            }

            .content-left li {
                margin: 25px;
            }

            .content-left i.fas {
                word-spacing: 3em;
            }

            li {
                font-size: 3em;
                color: #eee;
                vertical-align: middle;
            }

            .content-left span {
                padding-left: 20px;
                display: inline-block;
            }

            .content-right form {
                transform: translate(-3vh, 30vh);
            }

            .message-block {
                position: absolute;
                top: 15%;
                right: 12.5%;
                text-align: center;
                color: #50A7C2;
            }

            .item-block {
                width: 50px;
                display: inline-block;
            }

            a.btn-link {
                margin-left: 40px;
            }

        </style>

        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content-left">
                <ul>
                    <li><div class="item-block"><i class="far fa-question-circle"></i></div><span>Ask questions.</span></li>
                    <li><div class="item-block"><i class="fas fa-users"></i></div><span>Share what you know.</span></li>
                    <li><div class="item-block"><i class="far fa-comments"></i></div><span>Join the thread.</span></li>
                </ul>
            </div>

            <div class="content-right">
                <div class="message-block">
                    <h2>Ask and be answered.</h2>
                    <h3>Join us today.</h3>
                </div>

                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="col-md-7 col-md-offset-3">
                            <input id="name" type="text" class="form-control curve-edge" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                        <div class="col-md-7 col-md-offset-3">
                            <input id="username" type="text" class="form-control curve-edge" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-7 col-md-offset-3">
                            <input id="email" type="email" class="form-control curve-edge" name="email" value="{{ old('email') }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        
                        <div class="col-md-7 col-md-offset-3">
                            <input id="password" type="password" class="form-control curve-edge" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-md-7 col-md-offset-3">
                            <input id="password-confirm" type="password" class="form-control curve-edge" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <button type="submit" class="btn btn-primary curve-edge main-button hvr-radial-out">
                                Register
                            </button>
                            <a class="btn btn-link" href="{{ route('login') }}">
                                Have an account? Log in Here
                            </a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </body>
</html>

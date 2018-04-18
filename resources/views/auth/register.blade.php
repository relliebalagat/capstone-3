@extends('layouts.app')

@section('page-style')
    <style type="text/css">
        h3 {
            margin-bottom: 30px;
            font-weight: bold;
            letter-spacing: 4px;
            font-size: 2.5em;
        }

        .panel {
            margin-top: 15vh;
        }

        .panel, .panel-footer {
            border-radius: 15px;
        }

        .panel-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .register-btn {
            width: 73.3%;
            padding: 10px;
            margin: 15px 0 15px 0;
        }

    </style>

@endsection

@section('content')
<div class="gradient-bg-color body-height">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h3 class="col-md-6 col-md-offset-3 text-center">Register</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="name" type="text" class="form-control curve-edge" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="username" type="text" class="form-control curve-edge" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="email" type="email" class="form-control curve-edge" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                
                                <div class="col-md-6 col-md-offset-3">
                                    <input id="password" type="password" class="form-control curve-edge" name="password" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="password-confirm" type="password" class="form-control curve-edge" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary curve-edge main-button register-btn">
                                        Register
                                    </button>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="text-center">
                                    Have an account?
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        Log in Here
                                    </a>                        
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

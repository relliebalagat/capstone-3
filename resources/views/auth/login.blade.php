@extends('layouts.app')

@section('page-style')
    <style type="text/css">
        .panel {
            margin-top: 25vh;
        }

        .panel, .panel-footer {
            border-radius: 15px;
        }

        .panel-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    
        .rmbr-me-text {
           margin-left: 20px;
        }

        .new-to-us-text {
            margin-left: 12px
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
                        <h3 class="col-md-6 col-md-offset-3 text-center">Login</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="email" type="email" class="form-control curve-edge" name="email" value="{{ old('email') }}" placeholder="Username or email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}

                                <div class="col-md-6 col-md-offset-3">
                                    <input id="password" type="password" class="form-control curve-edge" name="password" placeholder="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <div class="checkbox">
                                        <button type="submit" class="btn btn-primary curve-edge main-button">
                                            Login
                                        </button>
                                        <label class="rmbr-me-text">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-3">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>

                                    <div class="col-md-8 col-md-offset-3">
                                        <span class="new-to-us-text">New to us?</span>
                                        <a class="btn btn-link" href="{{ route('register') }}">
                                            Sign up now >>
                                        </a>
                                    </div>
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

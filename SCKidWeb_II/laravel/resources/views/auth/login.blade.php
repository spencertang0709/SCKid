@extends('layouts.auth')
@section('content')

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="/img/OPC/SCKid_Logo.svg" height="100" width="400" alt=""/></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form role="form" action="{{ url('/login') }}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
            </div>
        </form>

        <a href="{{ url('/password/reset') }}">Forgot Password?</a><br>
        <a href="/register" class="text-center">Don't have an Account?</a>

    </div>
</div>



</body>

@endsection



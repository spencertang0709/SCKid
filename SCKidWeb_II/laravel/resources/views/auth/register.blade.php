@extends('layouts.auth')
@section('content')

<body class="hold-transition register-page">

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terms</h4>
            </div>
            <div class="modal-body">

                {{--TODO sample terms and conditions - replace with real TC--}}
                Website usage terms and conditions – sample template
                Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern [business name]’s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.
                The term ‘[business name]’ or ‘us’ or ‘we’ refers to the owner of the website whose registered office is [address]. Our company registration number is [company registration number and place of registration]. The term ‘you’ refers to the user or viewer of our website.
                The use of this website is subject to the following terms of use:
                The content of the pages of this website is for your general information and use only. It is subject to change without notice.
                This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: [insert list of information].
                Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.
                Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.
                This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.
                All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.
                Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.
                From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).
                Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="register-box">
    <div class="register-logo">
        <a href="/"><img src="/img/OPC/SCKid_Logo.svg" height="100" width="400"/></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Create a SCKid Account</p>
        <form role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}" tabindex="1">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group has-feedback {{$errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" tabindex="2">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{$errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="3">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{$errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" name="password_confirmation" id="passwordConfirm" class="form-control" placeholder="Confirm Password" tabindex="4">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck {{$errors->has('agreeterm') ? ' has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="agreeterm" id="agreeterm" value="Yes"> I agree to the <a href="" data-toggle="modal" data-target="#myModal">Terms</a>
                            @if ($errors->has('agreeterm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('agreeterm') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" value="Register" name="submit" class="btn btn-primary btn-block btn-flat" tabindex="5">Register</button>
                </div>
            </div>
        </form>

        <a href="/login" class="text-center">All ready have an account?</a>

    </div>
    <!-- /.form-box -->
</div>

</body>

@endsection

@extends('layouts.admin')
@section('content')

<div id="wrapper">
  <div id="page-wrapper">
    <div class="container-fluid">

        @if(Session::has('msg'))
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Oooops!</strong> {{Session::get('msg')}}
            <br/>
        </div>
        @endif

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Account</h1>
        </div>
      </div>

      <div class="row">          
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">General Details</h3>
            </div>
            <div class="box-body">
              <ul class="list-group">
                <li class="list-group-item">
                  {{Auth::user()->name}}
                </li>
                <li class="list-group-item">
                  {{Auth::user()->email}}
                </li>

              </ul>
              <ul class="list-group">

                <form class="form-horizontal" role="form" method="POST" action="{{ route('changePassword') }}">
                  {!! csrf_field() !!}

                  <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Current Password</label>

                    <div class="col-md-6">
                      <input type="password" class="form-control" name="old_password">

                      @if ($errors->has('old_password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('old_password') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">New Password</label>

                    <div class="col-md-6">
                      <input type="password" class="form-control" name="password">

                      @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Confirm New Password</label>
                    <div class="col-md-6">
                      <input type="password" class="form-control" name="password_confirmation">

                      @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-refresh"></i>Save Password
                      </button>
                    </div>
                  </div>
                </form>
              </ul>
            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Security</h3>
            </div>
            <div class="box-body">

            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Privacy</h3>
            </div>
            <div class="box-body">

            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Other</h3>
            </div>
            <div class="box-body">

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  @endsection

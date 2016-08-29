@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
    <form action="saveCategory" method="post">

          <div class="form-group has-feedback{{ $errors->has('category') ? ' has-error' : '' }}">
              <label class="inline" for="title">New Category:</label>
              <input class="form-control" type="text" name="category" id="category" value="{{ Request::old('category') }}">
              @if ($errors->has('category'))
              <span class="help-block">
                  <strong>{{ $errors->first('category')}}</strong>
              </span>
              @endif
          </div>

          <button type="submit" class="btn btn-primary">Save</button>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
      </form>
  </div>
</div>
</div>
@endsection

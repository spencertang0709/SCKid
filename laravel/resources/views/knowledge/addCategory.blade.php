@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
    <form action="saveArticle" method="post">
          <div class="form-group">
              <label class="inline" for="category">Categories:</label>
              <select class="form-control" name="category" id="category">
                  @foreach($categories as $category)
                    <option>{{$category->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group has-feedback{{ $errors->has('title') ? ' has-error' : '' }}">
              <label class="inline" for="title">Title:</label>
              <input class="form-control" type="text" name="title" id="title" value="{{ Request::old('title') }}">
              @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title')}}</strong>
              </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('article') ? ' has-error' : '' }}">
              <label class="inline" for="article">Article:</label>
              <input class="form-control" type="text" name="article" id="article" value="{{ Request::old('article') }}">
              @if ($errors->has('article'))
              <span class="help-block">
                  <strong>{{ $errors->first('article')}}</strong>
              </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('content') ? ' has-error' : '' }}">
            <label for="content">Content:</label>
            <textarea class="form-control" rows="9" name="content" id="content" value="{{ Request::old('content') }}"></textarea>
            @if ($errors->has('content'))
             <span class="help-block">
                 <strong>{{ $errors->first('content')}}</strong>
             </span>
             @endif
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
      </form>
  </div>
</div>
</div>
@endsection

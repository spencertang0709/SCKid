@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
    <form action="{{Route('saveArticle')}}" method="post">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="inline" for="category">Categories:</label>
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                        <option>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback{{ $errors->has('newCategory') ? ' has-error' : '' }}">
                    <div class="row">
                        <label class="inline" for="newCategory">New Category:</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="newCategory" id="newCategory" value="{{ Request::old('category') }}">
                            @if ($errors->has('newCategory'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newCategory')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <input type="button" id="saveCategoryBt" class="btn btn-primary" value="save" />
                        </div>
                    </div>
                </div>
            </div>
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
<script>
$('#saveCategoryBt').on('click',function(){
    var newCategory = $('#newCategory').val();
    var urlString = "newCategory=" + newCategory;
    $.ajax
    ({
        url: "{{ route('saveCategory') }}",
        type: "GET",
        data: urlString,
        success: function(responseText) {
            if(responseText=="success")
            {
                window.location="{{Route('addArticle.knowledge')}}";
            }
        }
    });
});
</script>
@endsection

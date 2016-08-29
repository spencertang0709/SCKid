@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
    <div class="col-sm-4">.col-sm-4</div>
    <div class="col-sm-4">
        <form action="{{Route('saveArticle')}}" method="post">
            <div class="form-group has-feedback{{ $errors->has('category') ? ' has-error' : '' }}">
                <label class="inline" for="category">Categories:</label>
                <select class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                    <option>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group has-feedback{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="inline" for="title">Title:</label>
                <select class="form-control" name="title" id="title">
                    @foreach($titles as $title)
                    <option>{{$title->name}}</option>
                    @endforeach
                </select>
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
$('#content').val('{{$content}}');
</script>
@endsection

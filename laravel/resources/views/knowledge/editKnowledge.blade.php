@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
    <div class="col-sm-4">.col-sm-4</div>
    <div class="col-sm-4">
        <form action="{{Route('saveConent.knowledge')}}" method="get">
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
                    <option value={{$title->id}}>{{$title->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group has-feedback{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content">Content:</label>
                <textarea class="form-control" rows="9" name="content" id="content" value="{{ Request::old('content') }}">{{$article->content}}</textarea>
                @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content')}}</strong>
                </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input id="articleId" type="hidden" name="articleId" value='{{$article->id}}'/>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>

<script>
// $('#content').val('{{--$article->content--}}');
// $('div[class*=" nicEdit-main"]').html('{{--$article->content--}}');
$('#category').change(function(){
    var selectedCategory = $('#category').val();
    urlString = "selectedCategory=" + selectedCategory;
    //  alert(urlString);
    $.ajax
    ({
        url: "{{ route('updateTitles.knowledge') }}",
        type: "GET",
        data: urlString,
        success: function(responseText) {
            var response = JSON.parse(responseText);
            //construct title
            var options = "";
            for(var index in response[0]){
                // alert(response[0][index]);
                options += "<option value='"+response[2][index]+"'>" + response[0][index] +"</option>";
            }
            // alert(options);
            $("#title").html(options);
            $('div[class*=" nicEdit-main"]').html(response[1].toString());
        }
    });
});

$('#title').change(function(e){
    var selectedTitle = $('#title').val();
    var urlString = "selectTitle= " + selectedTitle;
    //   alert(urlString);
    $.ajax
    ({
        url: "{{ route('updateContent.knowledge') }}",
        type: "GET",
        data: urlString,
        success: function(responseText) {
            // alert(responseText);
            $response = JSON.parse(responseText);
            //  alert($response[1]);
             $('div[class*=" nicEdit-main"]').html($response[0].toString());
             $('#articleId').val($response[1].toString());
        }
    });
});

</script>
@endsection

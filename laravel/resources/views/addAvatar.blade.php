@extends('layouts.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Add Avatar to your kids</h3></header>
            <form action="saveAvatar" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="inline" for="kid">Kids:</label>
                    <select class="form-control" name="kid" id="kid">
                        @foreach($kids as $kid)
                            <option value='{{$kid->id}}'>{{$kid->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group has-feedback{{ $errors->has('images') ? ' has-error' : '' }}">
                    <label for="images">Image (only .jpg)</label>
                    <!-- <input type="text" name="images" id="images" /> -->
                    <input type="file" name="images" class="form-control" id="images" enctype="multipart/form-data" value="{{--Request::old('images')--}}">
                    @if ($errors->has('images'))
                    <span class="help-block">
                        <strong>{{ $errors->first('images')}}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <!-- <input type="hidden" value="{{ Session::token() }}" name="_token">  -->
            </form>
        </div>
    </section>
    @if (Storage::disk('local')->has(Session::get('filename')))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('avatar.image', ['filename' => Session::get('filename')]) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
    </div>
    <!-- /.container-fluid -->
</div>
@if(Session::has('filename'))
<script>
alert("{{Session::get('filename')}}");
</script>
@endif
@if(Session::has('kidId'))
<script>
alert("{{$user->name . '-' . Session::get('kidId') . '.jpg'}}");
</script>
@endif
@if(Session::has('msg'))
<script>
alert("{{Session::get('msg')}}");
</script>
@endif
<!-- /#page-wrapper -->

@endsection

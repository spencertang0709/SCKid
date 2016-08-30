@extends('layouts.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Add Avatar to your kids</h3></header>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="inline" for="kid">Kids:</label>
                    <select class="form-control" name="kid" id="kid">
                        @foreach($kids as $kid)
                        <option>{{$kid->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection

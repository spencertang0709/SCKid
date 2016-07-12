@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
      <header>
          <h2>All the categories</h2>
          <p>Select an article below or search for a term</p>
      </header>
      <div class="form-group">
        <div class="row">
          <form action="{{ route('searchKeyWord.knowledge') }}" method="post">
              <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search: Try, Social Media...">
              <button type="submit" class="btn btn-primary">Search</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
          </form>
          @if(count($categories) > 0)
            @foreach($categories as $category)
            <div class="6u 12u(narrower)">
              <a href="{{ route('showTitle.knowledge', ['category_id' => $category->id]) }}">
                <section class="box special">
                  <span class="image featured"><img src="/img/portfolio/1.png" alt="" /></span>
                  <h3>{{$category->name}}</h3>
                </section>
              </a>
            </div>
            @endforeach
          @else
          <div class="alert alert-info">
          <strong>Oooops!</strong> I have got nothing here.
          </div>
          @endif
        </div>
      </div>
  </div>
</div>
</div>
@endsection

@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
    <form action="#" method="get">
      <h1>
        All the titles
      </h1>
      <div class="form-group">
        <div class="row">
          @if(count($titles) > 0)
            @foreach($titles as $title)
            <div class="6u 12u(narrower)">
              <a href="{{ route('showArticle.knowledge', ['title_id' => $title->id]) }}">
                <section class="box special">
                  <span class="image featured"><img src="/img/portfolio/1.png" alt="" /></span>
                  <h3>{{$title->name}}</h3>
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
    </form>
  </div>
</div>
</div>
@endsection

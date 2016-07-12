@extends('layouts.admin2')
@section('content')
<div class="row" style="margin-top:50px;">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-4">
    <form action="#" method="get">
      <h1>
        All the article
      </h1>
      <div class="form-group">
        <div class="row">
          @if(count($articles) > 0)
            @foreach($articles as $article)
            <div class="6u 12u(narrower)">
                <section class="box special">
                  <span class="image featured"><img src="/img/portfolio/1.png" alt="" /></span>
                  <h3>{{$article->subheading}}</h3>
                  <p>{{$article->content}}</p>
                </section>
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

@section('title')
Knowledgebase - Articles
@append
@section('customStyle')
    <link rel="stylesheet" href="/css/welcome/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/welcome/ie8.css" /><![endif]-->
@include('includes.backgroundVideo')

@append
@include('includes.header')

<video autoplay loop poster="#" id="bgvid">
    <source src="\video\screen_cast_app.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div id="page-wrapper">
    @include('includes.learn_header')
    <section id="main" class="container">
{{--original--}}
    <header>
      <h2 style="color:white;">
        All the Articles
     </h2>
    </header>
      <div class="form-group">
        @if(count($articles) == 0)
        <div class="alert alert-info">
        <strong>Oooops!</strong> I have got nothing here.
        <a href="{{route('showCategory.knowledge')}}">Click here go Home</a>
        </div>
        @endif
        <!-- <div class="row">
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
          @endif
        </div> -->
        <div class="list-group">
            @if(count($articles) > 0)
              @foreach($articles as $article)
                <section class="box special">
                    <h3>{{$article->subheading}}</h3>
                    <p>{{$article->content}}</p>
                </section>
            @endforeach
            @endif
        </div>
      </div>
      {{--original--}}
  </section>
 </div>

 @section('customFunction')
 <!--[if lte IE 8]><script src="/js/welcome/ie/html5shiv.js"></script><![endif]-->
 <script src="/js/welcome/jquery.min.js"></script>
 <script src="/js/welcome/jquery.dropotron.min.js"></script>
 <script src="/js/welcome/jquery.scrollgress.min.js"></script>
 <script src="/js/welcome/skel.min.js"></script>
 <script src="/js/welcome/util.js"></script>
 <!--[if lte IE 8]><script src="/js/welcome/ie/respond.min.js"></script><![endif]-->
 <script src="/js/welcome/main.js"></script>
 @append
 @include('includes.footer')

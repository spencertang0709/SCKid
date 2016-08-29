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
        @if(count($article) == 0)
        <div class="alert alert-info">
        <strong>Oooops!</strong> I have got nothing here.
        <a href="{{route('showCategory.knowledge')}}">Click here go Home</a>
        </div>
        @endif
        <div class="list-group">
            <p>{{html_entity_decode($article->content)}}</p>
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

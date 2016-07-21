@section('title')
	Knowledgebase - Categories
@append
@section('customStyle')

@append
@include('includes.header')

<video autoplay loop poster="#" id="bgvid">
  <source src="\video\screen_cast_app.mp4" type="video/mp4">
  <source src="\video\screen_cast_app.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>

{{--TODO fetch url of content from DB--}}
@include('knowledgeContent.categories')

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

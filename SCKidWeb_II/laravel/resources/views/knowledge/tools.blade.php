@section('title')
    Knowledgebase - Tools
@append
@section('customStyle')
    <link rel="stylesheet" href="/css/welcome/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/welcome/ie8.css" /><![endif]-->
    @append
@include('includes.header')

{{--TODO fetch url of content from DB--}}
@include('knowledgeContent.contentTools')

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
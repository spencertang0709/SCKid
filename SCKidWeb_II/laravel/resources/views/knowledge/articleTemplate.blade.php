@section('title')
	KnowledgeBase - Articles
@append
@section('customStyle')
	<link href="/css/article.css" rel="stylesheet" type='text/css'>
@append
@include('includes.header')


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SCKid</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Information</a></li>
      <li><a href="#">Dashboard</a></li> 
    </ul>
  </div>
</nav>

{{--TODO fetch url of content from DB--}}
{{$content = 'knowledgeContent.content1'}}
<hr>
@include($content)

<hr>
<div id='bottomPanel'>
	extra info here
</div>

@include('includes.footer')

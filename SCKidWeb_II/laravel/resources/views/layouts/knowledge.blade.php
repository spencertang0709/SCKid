@extends('includes.header')
@section('title')
	KnowledgeBase - Articles
@endsection('title')

{{--TODO fetch url of content from DB--}}
{{$content = 'knowledgeContent.content1'}}
@include($content)

@include('includes.footer')

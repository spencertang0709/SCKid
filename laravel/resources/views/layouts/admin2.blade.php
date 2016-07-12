@section('title')
	Admin - Dashboard
@append
@section('customStyle')
	<!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <!--other CSS-->
    <link href="/css/AdminLTE.css" rel="stylesheet">
    <link href="/css/AdminLTE.min.css" rel="stylesheet">

		<!-- include summernote css/js-->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>

@append
@include('includes.header')

@include('includes.sidebar2')
@yield('content')

@include('includes.footer')


@extends('layouts.admin')
@section('content')

 <div id="wrapper">

        <!-- Navigation -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Albums</h1>
					</div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
					  <ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#All">All Photos</a></li>
							@if(count($albums)>0)
								@foreach($albums as $album)
						 		 <li>
									 <a data-toggle="tab" href="#{{$album->album_id}}">{{$album->name}}({{$album->privacy}})({{$album->count}})
									 </a>
								 </li>
						  		@endforeach
						    @endif

					  </ul>

					  <div class="tab-content">
						<div id=All class="tab-pane fade in active">
								<div class='list-group gallery'>

									{{--$all_photos_output TODO--}}


								</div> <!-- list-group / end -->
						</div>
						  {{--$album_photo_output TODO--}}
					  </div>
					
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
	<script>
		$(document).ready(function(){
			//FANCYBOX
			//https://github.com/fancyapps/fancyBox
			$(".fancybox").fancybox({
				openEffect: "none",
				closeEffect: "none"
			});
		});
	</script>

	@endsection

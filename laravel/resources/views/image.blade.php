@extends('layouts.admin')
@section('content')

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

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

									@if(count($photos_albums)>0)
										@foreach($photos_albums as $photo)
												<div class="col-sm-4">
													<a class="thumbnail fancybox" rel="ligthbox" href="{{$photo["source"]}}" >
														<img class="img-responsive" alt="" src="{{$photo["source"]}}" style="width:320px;height:200px;"/>
														<div class="text-right">
															<small class="text-muted">{{$photo["name"]}}</small>
														</div> <!-- text-right / end -->
													</a>
												</div>

										@endforeach
									@endif

								</div> <!-- list-group / end -->
						</div>
						  @if(count($albums)>0)
							  @foreach($albums as $album)
						  <div id="{{$album->album_id}}" class="tab-pane fade">
							  <div class="list-group gallery">
								  @if(count($photos_albums)>0)
									  @foreach($photos_albums as $photo)
										  @if($photo["album_id"]=$album->id)
											  <div class="col-sm-4">
												  <a class="thumbnail fancybox" rel="ligthbox" href="{{$photo["source"]}}" >
													  <img class="img-responsive" alt="" src="{{$photo["source"]}}" style="width:320px;height:200px;"/>
													  <div class="text-right">
														  <small class="text-muted">{{$photo["name"]}}</small>
													  </div> <!-- text-right / end -->
												  </a>
											  </div>
										  @endif
									  @endforeach
								  @endif
							  </div>
						  </div>
							  @endforeach
						  @endif
					  </div>
					
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
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

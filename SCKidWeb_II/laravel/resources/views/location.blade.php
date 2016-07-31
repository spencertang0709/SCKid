
@extends('layouts.admin')
@section('content')


<!--show map Modal -->
<div class="modal fade" id="showmap" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Google Map Location</h4>
			</div>
			<div class="modal-body">
				<div id="map-canvas" class="" style="width: 550px; height:500px"></div>
			</div>
			<form action="" method="post">
				<div class="modal-footer ">
					<input type="hidden" name="web_id" value=""/>

				</div>
			</form>
		</div>
	</div>
</div>

    <div id="wrapper">

        <!-- Navigation -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Location</h1>

						<div class="box box-info">
							<div class="box-header">
								{{--<h3 class="box-title">Location List</h3>--}}
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table id="datatable" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th>Time</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th></th>
									</tr>
									</thead>
									@if(count($locations)>0)
										@foreach($locations as $location)
										<tr>
											<td>{{$location->time}}</td>
											<td>{{$location->latitude}}</td>
											<td>{{$location->longitude}}</td>
											<td>
												<button class="btn btn-primary btn-xs"  data-title="Show Google Map" data-l_time={{$location->time}} data-longitude={{$location->longitude}} data-latitude={{$location->latitude}}  data-toggle="modal" data-target="#showmap" >
													<span class="glyphicon glyphicon-map-marker"></span>
												</button>
											</td>
										</tr>
										@endforeach
									@endif

									{{--LOcation output TODO--}}

								</table>
							</div>
							<!-- /.box-body -->
						</div>

                    </div>
                    <!-- /.col-lg-12 -->

					<!-- /.box -->
				</div>
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    <!-- /#wrapper -->



	<!-- Bootstrap Core JavaScript -->
	<!--if move this js to admin, the map modal does not work-->
	{{--<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}

	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?language=en"></script>

	<script>
		$(function () {
			$("#datatable").DataTable();
		});
	</script>

<!--Bootstrap Google Map-->


<script>
	$('#showmap').on('show.bs.modal', function(e) {
		//Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
		var l_time = $(e.relatedTarget).data('l_time');
		var latitude = $(e.relatedTarget).data('latitude');
		var longitude = $(e.relatedTarget).data('longitude');
		var latlng = new google.maps.LatLng(latitude, longitude);
		addmarker(latlng,l_time);
		resizeMap();
	});
	var map;

	function initialize() {
		var mapProp = {
			zoom: 14,
			draggable: true,
			scrollwheel: true,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
		marker.setMap(map);

		google.maps.event.addListener(marker, 'click', function() {

			infowindow.setContent(contentString);
			infowindow.open(map, marker);

		});
	}

	function addmarker(latilongi,content) {
		var infowindow = new google.maps.InfoWindow();

		var marker = new google.maps.Marker({
			position: latilongi,
			title: 'new marker',
			draggable: true,
			map: map
		});
		google.maps.event.addListener(marker, 'click', (function (marker) {
			return function () {
				infowindow.setContent(content);
				infowindow.open(map, marker);
			}
		})(marker));
		map.setCenter(marker.getPosition())
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	google.maps.event.addDomListener(window, "resize", resizingMap());

	function resizeMap() {
		if(typeof map =="undefined") return;
		setTimeout( function(){resizingMap();} , 400);
	}

	function resizingMap() {
		if(typeof map =="undefined") return;
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	}

</script>

{{--check current kid if they exist--}}
<script>
kid_name="{{Session::get('current_kid_name')}}";
var check =checkKid(kid_name,'#nonKidAlert');
</script>
@endsection

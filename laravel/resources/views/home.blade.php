@extends('layouts.admin')
@section('content')


    {{--Service injection--}}
    {{--@inject('metrics', 'App\Services\MetricsService')--}}
    {{--<div>--}}
        {{--Monthly Revenue: {{ $metrics->monthlyRevenue() }}.--}}
    {{--</div>--}}

    <div id="wrapper">

        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
		
		        <div class="row">
		        	{{--
		            <div class="col-lg-12">
		                <h1 class="page-header">Current Children</h1>
		                <button id="add kid" data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Add new Child</button>
		            </div>
					--}}
		
		            {{--Interesting stuff we can do with blade--}}
		            {{--@each('view.name', $jobs, 'job', 'view.empty')--}}

		            @if(count($kids) > 0)
		                @foreach($kids as $kid)
		                    <div class="col-md-3">
                                {{--Well is for colouring--}}
                                <div class="box box-primary">
                                    <div class="box-body box-profile @if($kid->id == Session::get('current_kid')) well @endif">
                                        <img class="profile-user-img img-responsive img-circle select_button" src="/img/avatar{{rand(1,4)}}.png" alt="User profile picture"
                                             data-id={{$kid->id}} data-kidname={{$kid->name}}>
                                        <h3 class="profile-username text-center">{{$kid->name}}</h3>
                                        <p class="text-muted text-center"></p>
                                    </div>
                                </div>
		                    </div>
		                @endforeach
		            @endif
		        </div>
	
	                <div class="col-md-6">
	                    <!-- APP USAGE -->
	                    <div class="box box-primary">
	                        <div class="box-header with-border">
	                            <h3 class="box-title">Top Apps</h3>
	                        </div>
	                        <div class="box-body">
	                            <div class="chart">
	                                <div id="donut-example" style="height: 250px;"></div>
	                            </div>
	                        </div>
	                        <!-- /.box-body -->
	                    </div>
	                    <!-- /.box -->
	                </div>
	                
	                <div class="col-md-6">
	                    <!-- SMS rank -->
	                    <div class="box box-info">
	                        <div class="box-header with-border">
	                            <h3 class="box-title">Top SMS & Calls</h3>
	                        </div>
	                        <div class="box-body">
	                            <div class="chart">
	                                <div id="bar-example" style="height: 250px;"></div>
	                            </div>
	                        </div>
	                        <!-- /.box-body -->
	                    </div>
	                    <!-- /.box -->
	                </div>

                <!-- /.col-lg-12 -->
                <div class="col-md-12">
                    <!-- location -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recent Locations</h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                @if(count($locations) > 0)
                                    <script>
                                        var locations = JSON.parse('{!!json_encode($locations)!!}');
                                    </script>
                                @endif
                                <div id="googleMap" style=" height: 250px"></div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?language=en"></script>
    <script>

        var time = locations[0].time;
        var myCenter=new google.maps.LatLng(locations[0].latitude,locations[0].longitude);

        function initialize() {

            var map = new google.maps.Map(document.getElementById('googleMap'), {
                zoom: 6,
                center: myCenter,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            for (i = 0; i < locations.length; i++) {
                var coord=new google.maps.LatLng(locations[i].latitude,locations[i].longitude);

                var marker;
                marker = new google.maps.Marker({
                    position: coord,
                    map: map
                });
                google.maps.event.addListener(marker, 'click', (function (marker) {
                    return function () {
                        infowindow.setContent(time);
                        infowindow.open(map, marker);
                    }
                })(marker));
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <script>
        //Morris charts snippet - js

        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',function(){
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js',function(){

                Morris.Donut({
                    element: 'donut-example',
                    data: [
                        {label: "Facebook", value: 60},
                        {label: "Twitter", value: 30},
                        {label: "Other", value: 10}
                    ]
                });


                Morris.Bar({

                    element: 'bar-example',
                    data: [

                            @if(count($sms)>0)
                                {y:'{{$sms[0]->contact}}' , a: '{{$sms[0]->count}}'},
                                {y:'{{$sms[1]->contact}}' , a: '{{$sms[1]->count}}'},
                                {y:'{{$sms[2]->contact}}' , a: '{{$sms[2]->count}}'},
                                {y:'{{$sms[3]->contact}}' , a: '{{$sms[3]->count}}'},
                                {y:'{{$sms[4]->contact}}' , a: '{{$sms[4]->count}}'}
                            @endif


                    ],
                    xkey: 'y',
                    ykeys: 'a',
                    labels: ['Contact Times']
                });

            });
        });
    </script>
@endsection

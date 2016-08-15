@extends('layouts.admin')
@section('content')


    {{--Service injection--}}
    {{--@inject('metrics', 'App\Services\MetricsService')--}}
    {{--<div>--}}
        {{--Monthly Revenue: {{ $metrics->monthlyRevenue() }}.--}}
    {{--</div>--}}

    <div id="wrapper">
	<!--loading image-->
		<!--<div id="loading">-->
		<!--<img id="loading-image" src="/img/ajax-loader.gif" alt="Loading..." />-->
		<!--</div>-->

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

                    {{--<div class="alert alert-info">--}}
                        {{--current kid id is: {{$currentKidId}}--}}
                        {{--<br>--}}
                        {{--apps' packages:--}}
                        {{--{{$apps}} --}}
                        {{--<br>--}}
                        {{--@foreach($apps as $app)--}}
                        {{--{{$app->package}}--}}
                        {{--@endforeach--}}


                        {{--calls' packages:
                        {{$calls}}--}}
                        <br>
                        {{--
                        @foreach($calls as $call)
                        time gap: {{strtotime($call->end_time)-strtotime($call->start_time)}}
                        {{$call->start_time}}==>
                        {{$call->end_time}}
                        @endforeach
                        <br>
                        <br>
                        message:
                        @foreach($smss as $s)
                            <br>
                        {{$s->time}}
                        @endforeach
                        <br>
                        number of messages:
                        {{count($smss)}}
                        {{var_dump($time)}}
                        --}}
                    {{--</div>--}}

		            {{--Interesting stuff we can do with blade--}}
		            {{--@each('view.name', $jobs, 'job', 'view.empty')--}}

		            @if(count($kids) > 0)
		                @foreach($kids as $kid)
		                    <div class="col-md-3">
                                {{--Well is for colouring--}}
                                <div class="box box-primary">
                                    <div class="box-body box-profile @if($kid->id == Session::get('current_kid')) well @endif">
                                        <img class="stats_select profile-user-img img-responsive img-circle" src="/img/avatar{{rand(1,4)}}.png" alt="User profile picture"
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
	                            <div id="piechart_3d"></div>
	                        </div>                        
	                        <!-- /.box-body -->
	                    </div>
	                    <!-- /.box -->
	                </div>

	                <div class="col-md-6">
	                    <!-- SMS rank -->
	                    <div class="box box-info">
	                        <div class="box-header with-border">
	                            <h3 class="box-title" id="smsCall">Top SMS & Calls</h3>
	                        </div>
	                        <div id="yi" class="box-body">
	                            <div id="chart_call"></div>
                                <div id="chart_sms"></div>
                           </div>
	                        <!-- /.box-body -->
	                    </div>
	                    <!-- /.box -->
	                </div>
                    <script>
                    //var tog=0;
                    //
                    //$('#smsCall').click(function(){
                    //    if(tog===0){
                    //        $('#chart_call').fadeIn();
                    //        $('#chart_sms').fadeOut();
                    //        tog++;
                    //    }
                    //    else{
                    //        $('#chart_call').fadeOut();
                    //        $('#chart_sms').fadeIn();
                    //        tog--;
                    //    }
                    //});
                    //
                    $(window).load(function(){
                         $('#chart_call').fadeOut();
                         $('#chart_sms').fadeIn();
                         $('#chart_call').fadeOut();
                         $('#chart_sms').fadeIn();
                    });

					var flip_call=0;
					var flip_sms=0;
					$('#smsCall').click(function(){
						$('#chart_call').toggle(flip_call++ % 2 === 1).toggle(1000);
						$('#chart_sms').toggle(flip_sms++ % 2 === 0).toggle(1000);
					});

                	</script>

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

	<!--<script language="javascript" type="text/javascript">-->
	<!--	 $(window).load(function() {-->
	<!--	 $('#loading').hide();-->
	<!--  });-->
	<!--</script>-->
    <!-- delare app list -->
    <script>
    var appArray=[['Apps', 'times']]; //instaniate app list
    var smsArray=[];
    var callsArray=[];
    var timegap;
    var start_datetime;

    function containsArr(arr, obj) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][0] == obj.toString()) {
                return true;
            }
        }
        return false;
    }
    </script>

    <!-- get all top apps -->
    <!-- @if(count($topApp)>0){
        @if(count($topApp)<8){
            @foreach($topApp as $app)
                <script>
                appArray.push(['{{$app->package}}', {{$app->count}}]);
                </script>
            @endforeach
        }
        @else{
            @for($x=0;$x<8;$x++){
                <script>
                appArray.push(['{{$topApp[$x]->package}}', {{$topApp[$x]->count}}]);
                </script>
            }
            @endfor
        }
        @endif
    }
    @endif -->

    @if(count($topApp)>0){
        @foreach($topApp as $app)
            <script>
            appArray.push(['{{$app->package}}', {{$app->count}}]);
            </script>
        @endforeach
    @endif

    <!-- draw 3d pie chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
              google.charts.load('current', {packages: ['corechart', 'line']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable(appArray);

                var webOptions = {
                  title: 'Top apps/webs',
                  is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, webOptions);
              }
    </script>

    <!-- retrieve date  -->
    @foreach($calls as $call)
    <script>
    var timegap={{strtotime($call->end_time)-strtotime($call->start_time)}};
    start_datetime='{{$call->start_time}}';
    var datetime=start_datetime.split(' ');
    callsArray.push([new Date(datetime[0]), timegap/60]);
    </script>
    @endforeach

<!-- sms -->
    <script>
      google.charts.setOnLoadCallback(drawSmsChart);
      function drawSmsChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'msgs');

        data.addRows(smsArray);


        var options = {
          title: 'sms logs',
          hAxis: {
            format: 'M/d/yy',
            gridlines: {count: 10}
          },
          vAxis: {
            gridlines: {color: '#ecf9ec'},
            minValue: 0
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_sms'));

        chart.draw(data, options);
      }
    </script>

    <!-- call logs -->
    <script>
    google.charts.setOnLoadCallback(drawCallChart);

      function drawCallChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Minutes');

        data.addRows(callsArray);


        var callOptions = {
          title: 'call logs',
          hAxis: {
            format: 'M/d/yy',
            gridlines: {count: 10}
          },
          vAxis: {
            gridlines: {color: '#ecf9ec'},
            minValue: 0
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_call'));

        chart.draw(data, callOptions);
      }
    </script>

    @if(count($time)>0)
        @foreach($time as $t)
            <script>
            var newDate = new Date('{{$t}}');
                if(!containsArr(smsArray,newDate)){
                    smsArray.push([new Date('{{$t}}'), 1]);
                }else {
                    //find object then add number
                    for(index in smsArray){
                        if(smsArray[index][0] == newDate.toString()){
                            smsArray[index][1] += 1;
                        }
                    }
                }

            </script>
        @endforeach
    @endif
    <!-- <script>
    for(index in smsArray){
        alert(smsArray[index]);
    }
    </script> -->


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
        // //Morris charts snippet - js
        //
        // $.getScript('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',function(){
        //     $.getScript('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js',function(){
        //
        //         Morris.Donut({
        //             element: 'donut-example',
        //             data: [
        //                 {label: "Facebook", value: 60},
        //                 {label: "Twitter", value: 30},
        //                 {label: "Other", value: 10}
        //             ]
        //         });
        //
        //
        //         Morris.Bar({
        //
        //             element: 'bar-example',
        //             data: [
        //
        //                     @if(count($sms)>0)
        //                         {y:'{{$sms[0]->contact}}' , a: '{{$sms[0]->count}}'},
        //                         {y:'{{$sms[1]->contact}}' , a: '{{$sms[1]->count}}'},
        //                         {y:'{{$sms[2]->contact}}' , a: '{{$sms[2]->count}}'},
        //                         {y:'{{$sms[3]->contact}}' , a: '{{$sms[3]->count}}'},
        //                         {y:'{{$sms[4]->contact}}' , a: '{{$sms[4]->count}}'}
        //                     @endif
        //
        //
        //             ],
        //             xkey: 'y',
        //             ykeys: 'a',
        //             labels: ['Contact Times']
        //         });
        //
        //     });
        // });
    </script>

@endsection

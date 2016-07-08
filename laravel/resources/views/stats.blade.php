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
                    <h1 class="page-header">Stats</h1>
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
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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



                    ],
                    xkey: 'y',
                    ykeys: 'a',
                    labels: ['Contact Times']
                });

            });
        });
    </script>
@endsection

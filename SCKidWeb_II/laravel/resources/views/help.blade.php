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
                    <h1 class="page-header">Help</h1>
                </div>

	                <div class="col-md-6">
	                    <!-- APP USAGE -->
	                    <div class="box box-primary">
	                        <div class="box-header with-border">
	                            <h3 class="box-title">Video Introduction</h3>
	                        </div>
	                        <div class="box-body">

	                        </div>
	                        <!-- /.box-body -->
	                    </div>
	                    <!-- /.box -->
	                </div>

	                <div class="col-md-6">
	                    <!-- SMS rank -->
	                    <div class="box box-info">
	                        <div class="box-header with-border">
	                            <h3 class="box-title">Basics</h3>
	                        </div>
	                        <div class="box-body">

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

@endsection

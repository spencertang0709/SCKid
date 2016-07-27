
@extends('layouts.admin')
@section('content')

<!-- DataTables -->
 <!-- Navigation -->
{{--<!-- DataTables -->--}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap2/bootstrap-switch.css">
        <!-- Page Content -->
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Calls</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#all">All Calls</a></li>
					<li><a data-toggle="tab" href="#incoming">Incoming Calls</a></li>
					<li><a data-toggle="tab" href="#outgoing">Outgoing Calls</a></li>
				</ul>

				<div class="tab-content">
					<div id="all" class="tab-pane fade in active">
						<div class="row">
							<div class="col-xs-12">
								<div class="box box-info">
									<div class="box-header">
										{{--<h3 class="box-title">All Calls</h3>--}}
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table id="datatable" class="table table-bordered table-hover">
											<thead>
											<tr>
												<th>Contact</th>
												<th>Phone Number</th>
												<th>Time</th>
											</tr>
											</thead>
											@if(count($calls) > 0)
												@foreach($calls as $call)
													<tr>
														<td>{{$call->contact}}
															@if($call->direction==0) <i class="fa fa-arrow-circle-down fa-fw"></i>
															@else <i class="fa fa-arrow-circle-up fa-fw"></i>
															@endif
														</td>
														<td>{{$call->number}}</td>
														<td>{{$call->time}}</td>
													</tr>
												@endforeach
											@endif
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
						</div>
					</div>
					<!--DATABASE in_out = 0 stands for incoming-->
					<div id="incoming" class="tab-pane fade">
						<div class="row">
							<div class="col-xs-12">
								<div class="box box-info">
									<div class="box-header">
										{{--<h3 class="box-title">Incoming Calls</h3>--}}
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table id="datatable_in" class="table table-bordered table-hover" style="width:100%;">
											<thead>
											<tr>
												<th>Contact</th>
												<th>Phone Number</th>
												<th>Time</th>
											</tr>
											</thead>
											@if(count($calls) > 0)
												@foreach($calls as $call)
													@if($call->direction==0)
														<tr>
															<td>{{$call->contact}}</td>
															<td>{{$call->number}}</td>
															<td>{{$call->time}}</td>
														</tr>
													@endif
												@endforeach
											@endif
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
						</div>
					</div>
					<!--DATABASE in_out = 1 stands for outgoing-->
					<div id="outgoing" class="tab-pane fade">
						<div class="row">
							<div class="col-xs-12">
								<div class="box box-info">
									<div class="box-header">
										{{--<h3 class="box-title">Outgoing Calls</h3>--}}
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table id="datatable_out" class="table table-bordered table-hover" style="width:100%;">
											<thead>
											<tr>
												<th>Contact</th>
												<th>Phone Number</th>
												<th>Time</th>
											</tr>
											</thead>
											@if(count($calls) > 0)
												@foreach($calls as $call)
													@if($call->direction==1)
														<tr>
															<td>{{$call->contact}}</td>
															<td>{{$call->number}}</td>
															<td>{{$call->time}}</td>
														</tr>
													@endif
												@endforeach
											@endif
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
						</div>
					</div>
				</div>

			</div>

            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
	<!-- /#wrapper -->
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
		$(function () {
			$("#datatable").DataTable();
			$("#datatable_in").DataTable();
			$("#datatable_out").DataTable();
		});
	</script>
	{{--check current kid if they exist--}}
	<script>
	kid_name="{{Session::get('current_kid_name')}}";
	var check =checkKid(kid_name,'#nonKidAlert');
	</script>
@endsection

@extends('layouts.admin')
@section('content')

        <!-- Page Content -->
		<link rel="stylesheet" href="/plugins/switcher/dist/css/bootstrap3/bootstrap-switch.css">
        <div id="page-wrapper">

			<div id="addApp" class="modal fade" role="dialog">
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add A New App</h4>
							</div>
							<div class="modal-body">
								<div class="form-group has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
									<label for="name">App Name:</label>
									<input type="text" class="form-control" id="name" name="name" value="">
									@if ($errors->has('name'))
										<span class="help-block">
                                    <strong>{{ $errors->first('name')}}</strong>
                                </span>
									@endif
								</div>
								<div class="form-group has-feedback{{ $errors->has('package') ? ' has-error' : '' }}">
									<label for="package">Package:</label>
									<input type="text" class="form-control" id="package" name="package" value="">
									@if ($errors->has('package'))
										<span class="help-block">
                                    <strong>{{ $errors->first('package')}}</strong>
                                </span>
									@endif
								</div>
								<div class="form-group has-feedback{{ $errors->has('blocked') ? ' has-error' : '' }}">
									<label for="blocked">Blocked</label>
									<input type="checkbox" class="form-control" id="package" name="package" value="">
									@if ($errors->has('blocked'))
										<span class="help-block">
                                    <strong>{{ $errors->first('blocked')}}</strong>
                                </span>
									@endif
								</div>
							</div>
							<div class="modal-footer">
								<input name="AddApp" type="submit" id="AddApp" value="Add" class="btn btn-primary" />
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</form>
			</div>

            <div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Mobile Applications</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<div class="row">
					<div class="col-xs-12">
					  <div class="box box-info">
						<div class="box-header">
						  <h3 class="box-title">Change App settings below for: 
						  	<button>{{Session::get('current_kid_name')}}</button>

						  </h3>
							<button id="add app" data-toggle="modal" data-target="#addApp" class="btn btn-primary" style="float: right;" >Add new App</button>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <table id="datatable" class="table table-bordered table-hover">
							  <thead>
								  <tr>
									  <th>Name</th>
									  <!--<th>Installed Time</th>-->
									  <th>Use Frequency</th>
									  <th>Action(Block/Allow)</th>
									  <th>Privacy Grade Check Link</th>
								  </tr>
							  </thead>
							  <meta name="csrf-token" content="{{ csrf_token() }}">
								  @if(count($apps) > 0)
									  @foreach($apps as $app)
										  <tr>
											  <td>{{$app->package}}</td>
											  <td width="100"><span class="label label-success">Often</span></td>
											  <td>
												  <!--<input type="checkbox" '.$checked.'data-toggle="toggle" data-on="Allow" data-off="Block" data-onstyle="primary" data-offstyle="danger" data-width="80">-->
												  <p hidden>{{$app->blocked}}</p>
												  {{ csrf_field() }}
												  <input type="checkbox"  class="probeProbe"
														 @if($app->blocked==1)checked
														 @endif
														 data-off-text="Block" data-on-text="Allow" value={{$app->id}} />
											  </td>
											  <td><a href="https://www.privacygrade.org/apps/{{$app->package}}.html">Check Privacy Grade</a></td>
										  </tr>
									  @endforeach
							  		@endif
						  </table>

							{{--TODO pagination--}}
							{{--!! $apps->render() !!--}}
						</div>
						
						<!-- /.box-body -->
					  </div>
					  <!-- /.box -->
					</div>

				  </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
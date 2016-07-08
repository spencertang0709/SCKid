@extends('layouts.admin')
@section('content')

    <div id="wrapper">

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User Account Profile</h1>
                                <h4>Facebook Account</h4>
								<div class="col-md-3">
						          <div class="box box-primary">
									<div class="box-body box-profile">
									  <center><img class="profile-user-img img-responsive img-circle" src="../welcome/dist/img/user4-128x128.jpg" alt="User profile picture"></center>

									  <h3 class="profile-username text-center">

                                          {{--USERNAME TODO--}}

                                      </h3>

									  <p class="text-muted text-center"></p>

									  <ul class="list-group list-group-unbordered">

										<li class="list-group-item">
										  <b>Likes</b> <a class="pull-right">

                                                {{--response Likes TODO--}}

                                            </a>
										</li>
										<li class="list-group-item">
										  <b>Friends</b> <a class="pull-right">
                                                {{--COUNT TODO--}}

                                            </a>
										</li>
									  </ul>
									</div>
									<!-- /.box-body -->
								  </div>
								</div>
                        <div class="col-md-3">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <a href="#" >
                                        <span class="glyphicon glyphicon-plus" style="font-size: 100px;text-align: center;"></span>
                                    </a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@endsection

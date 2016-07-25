@extends('layouts.admin')
@section('content')

    <!--Delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this Device</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this device?
                    </div>
                </div>
                <form id="delModal" action=" " method="post">
                    {!! csrf_field() !!}
                    {{--Spoofing our delete method--}}
                    {!! method_field('DELETE') !!}
                    <div class="modal-footer ">
                        <input type="hidden" name="web_id" value=""/>
                        <button type="submit" name="removeDevice" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <div id="addWeb" class="modal fade" role="dialog">
            <form action="" method="post">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add a Device</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" class="form-control" id="name" name="name" value="">
                                <label for="model">Model:</label>
                                <input type="text" class="form-control" id="model" name="model" value="">
                                <label for="category">Number: </label>
                                <input type="text" class="form-control" id="cat" name="cat" value="">
                                {!! csrf_field() !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input name="AddDevice" type="submit" id="AddWeb" value="Add" class="btn btn-primary" />
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- verification -->
        <div id="wrapper">
            <div id="verifyDevice" class="modal fade" role="dialog">
                <form action="/devices/verify" method="get">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Verification</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label id="lbVerification"></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <!-- verification -->

        <!-- Navigation -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Your Devices</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Manage Your Mobile Devices</h3>
                            </div>
                            <div class="box-body">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Unique ID</th>
                                        <th>Current Kid</th>
                                    </tr>
                                    </thead>

                                    @if(count($devices) > 0)
                                        @foreach($devices as $device)
                                            <tr>
                                                <td>{{$device->name}}</td>
                                                <td>{{$device->model}}</td>
                                                <td>{{$device->unique_id}}</td>
                                                <td>Kid Name</td>
                                                {{--<td>{{$device->kid()->name}}</td>--}}
                                                <td>
                                                    {{--TODO edit--}}
                                                    <button class="btn btn-primary btn-xs"  data-title="Edit" data-id={{$device->id}} data-toggle="modal" data-target="#edit" >
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </button>
                                                    <button class="btn btn-primary btn-xs"  data-title="Delete" data-id={{$device->id}} data-dir={{Route::getFacadeRoot()->current()->uri()}} data-toggle="modal" data-target="#delete" >
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="verifyDevice" data-toggle="modal" data-target="#verifyDevice" class="btn btn-success" style="float: right;" >Verification</button>
                        <button id="add device" data-toggle="modal" data-target="#addWeb" class="btn btn-primary" style="float: right;" >Add A Device</button>
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

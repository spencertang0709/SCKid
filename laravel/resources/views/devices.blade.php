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
                <form id="delModal" action="" method="post">
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

        <!-- verification -->
        <div id="wrapper">
            <div id="verifyDevice" class="modal fade" role="dialog">
                <form action="" method="get">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Verification</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="product">Enter a passphrase of you choice to generate a verification code (4 chars minimum):</label>
                                    <input type="text" class="form-control" id="passphrase" name="passphrase" value="">
                                </div>
                                <div class="form-group">
                                    <label id="lbVerification"></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="generateCode" type="button" class="btn btn-primary">Generate</button>
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
                                        <th>Device Name</th>
                                        <th>Model</th>
                                        <!--<th>Unique ID</th>-->
                                        <th>Current Kid in Use</th>
                                    </tr>
                                    </thead>

                                    @if(count($devices) > 0)
                                        @foreach($devices as $device)
                                            <tr>
                                                <td class="nameColumn">{{$device->name}}</td>
                                                <td>{{$device->model}}</td>
                                                <!--<td>{{--$device->unique_id--}}</td>-->
                                                {{--<td>Kid Name</td>--}}
                                                @if($device->kid()->first() != NULL)
                                                    @if ($device->kid()->first()->name == Session::get('current_kid_name'))
                                                        <td class="kidColumn" style="border:1px solid red;"><strong>{{$device->kid()->first()->name}}</strong></td>
                                                    @else
                                                        <td class="kidColumn">{{$device->kid()->first()->name}}</td>
                                                    @endif
                                                @else
                                                    <td class="kidColumn">None</td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-primary btn-xs associateKid" editing="false" data-id={{$device->id}}>
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
                        <button data-toggle="modal" data-target="#verifyDevice" class="btn btn-success" style="float: right;" >Verification</button>
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
    <script>
    $('button[data-dismiss="modal"]:contains("Close")').click(function(){
        window.location.replace('{{route("devices")}}');
    });
    </script>
    {{--check current kid if they exist--}}
    <script>
        kid_name="{{Session::get('current_kid_name')}}";
        var check = checkKid(kid_name,'#nonKidAlert');
    </script>
@endsection

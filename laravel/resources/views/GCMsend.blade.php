@extends('layouts.admin')
@section('content')

<!--  add GCM message-->
<div id="GCMMessageModel" class="modal fade" role="dialog">
    <form id="GCMForm" action="" method="post">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add A Message</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback{{ $errors->has('GCMTitle') ? ' has-error' : '' }}">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="GCMTitle" name="GCMTitle" value="{{Request::old('GCMTitle')}}">
                        @if ($errors->has('GCMTitle'))
                        <span class="help-block">
                            <strong>{{ $errors->first('GCMTitle')}}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('GCMMessage') ? ' has-error' : '' }}">
                        <label for="product">Message:</label>
                        <input type="text" class="form-control" id="GCMMessage" name="GCMMessage" value="{{Request::old('GCMMessage')}}">
                        @if ($errors->has('GCMMessage'))
                        <span class="help-block">
                            <strong>{{ $errors->first('GCMMessage')}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="SendMessage" type="submit" id="SendMessage" value="Send" class="btn btn-primary" />
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

    <!-- Navigation -->

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @if(Session::has('GCMmsg'))
            <div class="alert alert-error fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Whooops!</strong> {{Session::get('GCMmsg')}}
                <br/>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">GCM DownStream</h1>
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
                                    {{--<td>Kid Name</td>--}}
                                    @if(count($kids) > 0)
                                    <td>{{$device->kid()->first()->name}}</td>
                                    @endif
                                    <td>
                                    <button class="btn btn-primary btn-xs"  data-title="GCMMessage"
                                    data-id={{$device->id}} data-toggle="modal" data-target="#GCMMessageModel" />
                                        <span class="glyphicon glyphicon-envelope"></span>
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
                {{--<button id="verifyDevice" data-toggle="modal" data-target="#verifyDevice" class="btn btn-success" style="float: right;" >Verification</button>--}}
                {{--<button id="add device" data-toggle="modal" data-target="#addWeb" class="btn btn-primary" style="float: right;" >Add A Device</button>--}}
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
@if(count($errors) > 0)
    @if ($errors->has('GCMMessage')||$errors->has('GCMTitle'))
        <script>
        showModalBox('#GCMMessageModel');
        </script>
    @endif
@endif

<script>
// $('button[data-dismiss="modal"]:contains("Close")').click(function(){
//     window.location.replace('{{route("GCM")}}');
// });
</script>
{{--check current kid if they exist--}}
<script>
kid_name="{{Session::get('current_kid_name')}}";
var check =checkKid(kid_name,'#nonKidAlert');
</script>
@endsection

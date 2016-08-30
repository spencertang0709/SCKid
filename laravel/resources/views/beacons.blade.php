@extends('layouts.admin')
@section('content')

<div id="wrapper">


    <!--  add beacon-->
    <div id="addBeacon" class="modal fade" role="dialog">
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add A Beacon</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="product">Beacon Location:</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{Request::old('location')}}">
                            @if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('major') ? ' has-error' : '' }}">
                            <label for="price">Major Number:</label>
                            <input type="text" class="form-control" id="major" name="major" value="{{Request::old('major')}}">
                            @if ($errors->has('major'))
                            <span class="help-block">
                                <strong>{{ $errors->first('major')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('minor') ? ' has-error' : '' }}">
                            <label for="price">Minor Number:</label>
                            <input type="text" class="form-control" id="minor" name="minor" value="{{Request::old('minor')}}">
                            @if ($errors->has('minor'))
                            <span class="help-block">
                                <strong>{{ $errors->first('minor')}}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input name="AddBeacon" type="submit" id="AddBeacon" value="Add" class="btn btn-primary" />
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Delete Setting</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Beacon's settings?
                    </div>
                </div>
                <form id="delModal" action=" " method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-footer ">
                        {!! method_field('DELETE') !!}
                        <input type="hidden" name="beaconID" value=""/>
                        <button type="submit" name="removeBeacon" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--choose kid--}}
    <div class="modal fade" id="chooseKidAlert" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Choose Kid</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;&nbsp;Please add one of you kids.
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--choose kid--}}


    <!--add policy-->
    <div id="addPolicy" class="modal fade" role="dialog">
        <form action="{{route('addPolicy')}}" method="post">
            <input type="hidden" id='hiddenBeaconId' name="hiddenBeaconId" >
            {{ csrf_field() }}
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add a policy</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback{{ $errors->has('appList') ? ' has-error' : '' }}">
                            <label for="product">App List:</label>
                            {{--<input type="text" class="form-control" id="appList" name="appList" value="">--}}

                            {{--show app list--}}
                            <select class="form-control" name="appList" id="appList">
                                @if(count($apps) > 0)
                                    @foreach($apps as $app)
                                        <option>{{$app->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('appList'))
                            <span class="help-block">
                                <strong>{{ $errors->first('appList')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('screenTime') ? ' has-error' : '' }}">
                            <label for="price">Screen Time: &nbsp;</label>
                            <div class="radio-inline">
                                <label><input type="radio" name="screenTime" value='true' checked="">Allow</label>
                            </div>
                            <div class="radio-inline">
                                <label><input type="radio" name="screenTime" value='false'>Not Allow</label>
                            </div>
                            @if ($errors->has('screenTime'))
                            <span class="help-block">
                                <strong>{{ $errors->first('screenTime')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <label for="price">Start Time:</label>
                            <input type="text" class="form-control" id="startTime" name="startTime" placeholder="YYYY-MM-DD hh:mm:ss" value="{{Request::old('startTime')}}">
                            @if ($errors->has('startTime'))
                            <span class="help-block">
                                <strong>{{ $errors->first('startTime')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <label for="price">End Time:</label>
                            <input type="text" class="form-control" id="endTime" name="endTime" placeholder="YYYY-MM-DD hh:mm:ss" value="{{Request::old('endTime')}}">
                            @if ($errors->has('endTime'))
                            <span class="help-block">
                                <strong>{{ $errors->first('endTime')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input name="addPolicy" type="submit" id="addPolicy" value="Add" class="btn btn-primary" />
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end of add policy-->

    <!--Delete Modal for policy -->
    <div class="modal fade" id="deletePolicy" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Delete Setting</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Policy's settings?
                    </div>
                </div>
                <form id="delPolicy" action=" " method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-footer ">
                        {!! method_field('DELETE') !!}
                        <input type="hidden" name="policyID" value=""/>
                        <button type="submit" name="removePolicy" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @if(count($errors) > 0)
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Oooops!</strong> Please make sure you added right information!
                <br/>
                @if($errors->has('appList'))
                    make sure you have chosen your child as well as the child assigned with a phone.
                @endif

                @if($errors->has('hiddenBeaconId'))
                    make sure you have chosen one beacon location.
                @endif
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Beacon Configuration</h1>
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Existing Beacons for:
                                <button>{{Session::get('current_kid_name')}}</button>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="BeaConfig" class="table table-hover">
                                <tr>
                                    <th>Beacon Location</th>
                                    <th>Major Number</th>
                                    <th>Minor Number</th>
                                </tr>
                                @if(count($beacons) > 0)
                                    @foreach($beacons as $beacon)
                                    <tr data-info="{{$beacon->id}}">
                                        <td>{{$beacon->location}}</td>
                                        <td>{{$beacon->major}}</td>
                                        <td>{{$beacon->minor}}</td>
                                        <td>
                                            <a href="#" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse" data-title="DELETEBEACON" data-id={{$beacon->id}}
                                                        data-dir={{Route::getFacadeRoot()->current()->uri()}} data-toggle="modal" data-target="#delete"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="addbeacon" data-toggle="modal" data-target="#addBeacon" class="btn btn-primary" style="float: right;" >Add new Beacon</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Location-Aware Policy</h1>
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Existing Policies</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Beacon Location</th>
                                        <th>Screen Time</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Kid Name</th>
                                        <th>Blocked APPs</th>
                                        <th></th>
                                    </tr>
                                    <!--existing policy  -->
                                    @if(count($awarePolicies) > 0)
                                    @foreach($awarePolicies as $aware)
                                    <tr>
                                        <td>{{$aware->location}}</td>
                                        <td>{{$aware->screen_time ? 'Allow':'Not Allow'}}</td>
                                        <td>{{$aware->start_time}}</td>
                                        <td>{{$aware->end_time}}</td>
                                        <td>{{$aware->name}}</td>
                                        <td>{{$aware->app_list}}</td>
                                        <td>
                                            <a href="#" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse" data-title="DELETEPOLICY" data-id={{$aware->id}}
                                                         data-toggle="modal" data-target="#deletePolicy"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                        @endforeach
                                        @endif
                                        <!--existing policy-->
                                </table>
                            </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="addpolicy" data-toggle="modal" data-target="#addPolicy" class="btn btn-primary" style="float: right;" >Add A Policy</button>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>

        @if(count($errors) > 0)
            @if ($errors->has('location')||$errors->has('major')||$errors->has('minor'))
                <script>
                showModalBox('#addBeacon');
                </script>
                @else
                <script>
                showModalBox('#addPolicy');
                </script>
            @endif
        @endif



{{--check current kid if they exist--}}
<script>
kid_name="{{Session::get('current_kid_name')}}";
var check =checkKid(kid_name,'#nonKidAlert');
</script>

<script>
var inputBeaconId = -1;
$("#BeaConfig").children().children().each(function() {
    $(this).click(function() {
        if($(this).hasClass("info")){
            $(this).removeClass("info");
            selectedBeaconId = -1;
        }else{
            // var inputBeaconId = $(this).attr("data-info");
            var inputBeaconId = $(this).data("info");
            $(this).addClass("info");
            $('#hiddenBeaconId').val(inputBeaconId);
            if(inputBeaconId != -1){
                $(this).siblings().removeClass("info");
            }
        }
    });
});
</script>
<script>
$('#addPolicy').modalSteps({
    completeCallback: function() {
        var stime = document.getElementById("time_start").value;
        var etime = document.getElementById("time_end").value;
        var e1 = document.getElementById("location");
        var location = e1.options[e1.selectedIndex].value;
        var e = document.getElementById("guardian");
        var rs = e.options[e.selectedIndex].value;
        var apps=$( "#ms" ).val();
        console.log(apps.length);
        //var apps = getSelectedOptions(document.getElementById("ms"));
        var urlString = "context=Complete" +"&location="+location+ "&st=" + stime + "&et=" + etime + "&guardian=" + rs+"&apps="+apps;
        var data = {
            context : "Complete",
            location : location,
            st : stime,
            et : etime,
            guardian : rs,
            apps : apps
        };
        $.ajax
        ({
            url: "context_setting.php",
            type: "POST",
            cache: false,
            dataType:"json",
            //data: urlString
            data: {data: JSON.stringify(data)}
        });
        window.location = "context_setting.php";
    }
});
</script>
<script>
$('#delete').on('show.bs.modal', function(e) {
    var policyid = $(e.relatedTarget).data('policyid');
    $(e.currentTarget).find('input[name="policyid"]').val(policyid);
});
</script>
<script>
$('.clearfix .btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $collapse = $this.closest('.collapse-group').find('.collapse');
    $collapse.collapse('toggle');
});
</script>

<script>
$(function() {
    $('#ms').change(function() {
        console.log($(this).val());
    }).multipleSelect({
        width: '100%';
    });
});
</script>
        <!-- bootstrap time picker -->
@endsection

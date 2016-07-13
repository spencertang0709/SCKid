@extends('layouts.admin')
@section('content')

<div id="wrapper">

    <!-- Navigation -->
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
                            <input type="text" class="form-control" id="appList" name="appList" value="">
                            @if ($errors->has('appList'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('appList')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('screenTime') ? ' has-error' : '' }}">
                            <label for="price">Screen Time:</label>
                            <input type="text" class="form-control" id="screenTime" name="screenTime" value="">
                            @if ($errors->has('screenTime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('screenTime')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <label for="price">Start Time:</label>
                            <input type="text" class="form-control" id="startTime" name="startTime" value="">
                            @if ($errors->has('startTime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('startTime')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <label for="price">End Time:</label>
                            <input type="text" class="form-control" id="endTime" name="endTime" value="">
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

    <!--Delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete Setting</h4>
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
                        <button type="submit" name="removeBeacon" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                        <input type="text" class="form-control" id="location" name="location" value="">
                        @if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback{{ $errors->has('major') ? ' has-error' : '' }}">
                        <label for="price">Major Number:</label>
                        <input type="text" class="form-control" id="major" name="major" value="">
                        @if ($errors->has('major'))
                            <span class="help-block">
                                <strong>{{ $errors->first('major')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback{{ $errors->has('minor') ? ' has-error' : '' }}">
                        <label for="price">Minor Number:</label>
                        <input type="text" class="form-control" id="minor" name="minor" value="">
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


    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
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
	                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse" data-title="DELETE" data-id={{$beacon->id}} data-dir={{Route::getFacadeRoot()->current()->uri()}} data-toggle="modal" data-target="#delete"></i>
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
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Parental Guardian</th>
                                    <th>Blocked APPs</th>
                                    <th></th>
                                </tr>

                                {{--TODO policy output--}}
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

<script>
var selectedBeaconId = -1;
$("#BeaConfig").children().children().each(function() {
    var $thisParagraph = $(this);
    $thisParagraph.click(function() {
        if ($(this).hasClass("info")){
            $(this).removeClass("info");
            
            selectedBeaconId = -1;
        } else{
            var inputBeaconId = $(this).attr("data-info");
            $(this).addClass('info');
            $('#hiddenBeaconId').val(inputBeaconId);
            
            if (selectedBeaconId == -1){
                selectedBeaconId = inputBeaconId;
            }
            else {
                var currentElement = document.getElementById("BeaConfig");
                var childArray = currentElement.childNodes;
                for (var i = 0; i < childArray.length; i++) {
                	if (childArray[i].tagName == "TBODY") {
                		currentElement = childArray[i];
                	}
                }
                
                childArray = currentElement.childNodes;
                for (var i = 0; i < childArray.length; i++) {
                	if (childArray[i].tagName == "TR") {
                		currentElement = childArray[i];
                		if (currentElement.getAttribute("data-info") == selectedBeaconId) {
                			currentElement.className = "";
                		}
                	}
                } 

                selectedBeaconId = inputBeaconId;
            }
            
        }




        // $(this).addClass("info");
        // if($(this).hasClass("info")){
        //     beaconLocation.push($(this).attr("data-info"));
        //     $('#hiddenBeaconId').val(beaconLocation[0]);
        // }
        // else {
        //     beaconLocation.pop();
        // }
        // $.each(beaconLocation,function(index,value){
        //     alert(value);
        // });
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
            width: '100%'
        });
    });
</script>
<!-- bootstrap time picker -->

@endsection

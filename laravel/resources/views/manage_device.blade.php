@extends('layouts.admin')
@section('content')


<div id="edit" class="modal fade" role="dialog">
    <form action="" method="post">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="title"></h4>
                    <input type="hidden" name="feature_name" value=""/>
                </div>
                <div class="modal-body">
                    <!--
                    value 0 == Always Allowed
                    value 1 == Never Allowed
                    value 2 == Allowed Between
                    -->
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="cb1"  name="cb" value="0" onclick="TimeChecker(this.id)"><label>Always Allowed</label>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="cb2"  name="cb" value="1" onclick="TimeChecker(this.id)"><label>Never Allowed</label>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"  id="cb3" name="cb" value="2" onclick="TimeChecker(this.id)"><label>Allowed Between</label>
                        </label>
                    </div>
                    <form>
                        Select a time:
                        <input type="time" name="start_time" id="time_start" >
                        to
                        <input type="time" name="end_time" id="time_end" >
                    </form>

                </div>
                <div class="modal-footer">
                    <input name="save" type="submit" id="save" value="Save" class="btn btn-primary" />
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<body>

    <div id="wrapper">

        <!-- Navigation -->


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Manage mobile devices</h1>
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Phone Features</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Features</th>
                                                <th>Actions</th>
                                                <th></th>
                                            </tr>
                                            {{--@if(count($devices) > 0)--}}
                                                {{--@foreach($devices as $device)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>{{$device->feature}}</td>--}}
                                                        {{--<td>--}}
                                                            {{--@if($device->action==0)--}}
                                                                {{--Allowed--}}
                                                            {{--@elseif($device->action==1)--}}
                                                                {{--Not Allowed--}}
                                                            {{--@elseif($device->action==2)--}}
                                                                {{--Allowed between&nbsp;&nbsp;{{$device->start_time}}&nbsp;&nbsp;to&nbsp;&nbsp;{{$device->end_time}}--}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td><button type="button" data-feature="{{$device->feature}}" data-action="{{$device->action}}" data-st="{{$device->start_time}}" data-et="{{$device->end_time}}" data-toggle="modal" data-target="#edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></button>--}}
                                            {{--</td>--}}
                                                    {{--</tr>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}

                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
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

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>


</body>

<!-- time picker-->
<script type="text/javascript">
    $('#timepicker1').timepicker();
</script>

<script>
    $('#edit').on('show.bs.modal', function(e) {
        var feature_n = $(e.relatedTarget).data('feature');
        $(e.currentTarget).find('input[name="feature_name"]').val(feature_n);
        document.getElementById("title").innerHTML=feature_n;
        var action_v = $(e.relatedTarget).data('action');
        var s_time = $(e.relatedTarget).data('st');
        var e_time = $(e.relatedTarget).data('et');
        if ( action_v == 0 ){
            document.getElementById('cb1').checked=true;
            document.getElementById('cb2').checked=false;
            document.getElementById('cb3').checked=false;
            document.getElementById('time_start').disabled = true;
            document.getElementById('time_end').disabled = true;
            document.getElementById("time_start").value = "";
            document.getElementById("time_end").value = "";
        }
        else if (action_v == 1){
            document.getElementById('cb1').checked=false;
            document.getElementById('cb2').checked=true;
            document.getElementById('cb3').checked=false;
            document.getElementById('time_start').disabled = true;
            document.getElementById('time_end').disabled = true;
            document.getElementById("time_start").value = "";
            document.getElementById("time_end").value = "";
        }
        else if (action_v == 2){
            document.getElementById('cb1').checked=false;
            document.getElementById('cb2').checked=false;
            document.getElementById('cb3').checked=true;
            document.getElementById('time_start').disabled = false;
            document.getElementById('time_end').disabled = false;
            document.getElementById("time_start").value = s_time;
            document.getElementById("time_end").value = e_time;
        }
    });
</script>

<!--disable/enable time picker-->
<script>
    function TimeChecker(id) {
        for (var i = 1;i <= 3; i++)
        {
            document.getElementById("cb" + i).checked = false;
        }
        document.getElementById(id).checked = true;
        var checker = document.getElementById('cb3');
        var time_s = document.getElementById('time_start');
        var time_e = document.getElementById('time_end');
        if (checker.checked == true) {
            time_s.disabled = false;
            time_e.disabled = false;
        }
        else {
            time_s.disabled = true;
            time_e.disabled = true;
        }
    }
</script>

@endsection

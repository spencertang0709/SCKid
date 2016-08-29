@extends('layouts.admin')
@section('content')

<div id="wrapper">
    <!-- Navigation -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <input type="button" id="run" value="Listen"/>
            <input type="button" id="stop" value="Stop"/>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">GCM Messages</h1>
                    <div class="box box-info">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div id="innerTable" class="box-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead id="thd">
                                    <tr>
                                        <th>Kid name</th>
                                        <th>title</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                {{--@if(isset($messages))
                                <tr>
                                    <td>{{$messages->name}}</td>
                                    <td>{{$messages->title}}</td>
                                    <td>{{$messages->content}}</td>
                                </tr>
                                @endif--}}
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->
<script>
$('#run').click(function(){
    $.ajax
    ({
        url: "GCMUpstream",
        type: "GET",
        success: function(responseText) {
            var messages = JSON.parse(responseText);

            var tr = "<table id='datatable' class='table table-bordered table-hover'><thead><tr><th>Kid name</th><th>title</th><th>Content</th></tr></thead>";
            for(var index in messages){
                tr +="<tr><td>" +messages[index]['IMEI'] +"</td><td>"+ messages[index]['title']
                +"</td><td>"+ messages[index]['content'] +"</td></tr>";
            }
            tr +="</table>";
            document.getElementById("innerTable").innerHTML=tr;
            $("#datatable").DataTable();

        }
    });
});

// $('#stop').click(function(){
//     $.ajax
//     ({
//         url: "GCMUpstreamStop",
//         type: "GET",
//         data: "command=stop",
//         success: function(responseText) {
//             var messages = JSON.parse(responseText);
//
//             var tr = "<table id='datatable' class='table table-bordered table-hover'><thead><tr><th>Kid name</th><th>title</th><th>Content</th></tr></thead>";
//             for(var index in messages){
//                 tr +="<tr><td>" +messages[index]['IMEI'] +"</td><td>"+ messages[index]['title']
//                 +"</td><td>"+ messages[index]['content'] +"</td></tr>";
//             }
//             tr +="</table>";
//             document.getElementById("innerTable").innerHTML=tr;
//             $("#datatable").DataTable();
//
//         }
//     });
// });
</script>
<script>
$(function () {
    $("#datatable").DataTable();
});
</script>


{{--check current kid if they exist--}}
<script>
kid_name="{{Session::get('current_kid_name')}}";
var check =checkKid(kid_name,'#nonKidAlert');
</script>
@endsection

@extends('layouts.admin')
@section('content')


<!-- Page Content -->
<div id="page-wrapper">

    <!--modal part-->
    <div id="myModal" class="modal fade" role="dialog">

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Message From:</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input name="EditProduct" type="submit" id="EditProduct" value="Update" class="btn btn" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- end modal part-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Panics</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">

                            <tbody>
                            {{--@if(count($messages) > 0)--}}
                                {{--@foreach($messages as $message)--}}
                                    {{--<tr>--}}
                                        {{--<td><input type="checkbox"></td>--}}
                                        {{--<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>--}}
                                        {{--<td class="mailbox-name"><a href="/messages/read">{{$message->title}}</a></td>--}}
                                        {{--<td class="mailbox-subject" style="font-weight: bold;" data-id={{$message->id}} data-toggle="modal" data-target="#myModal">--}}
                                            {{--{{$message->message}}--}}
                                        {{--</td>--}}
                                        {{--<td class="mailbox-attachment"></td>--}}
                                        {{--<td class="mailbox-date">{{$message->created_at}}</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}


                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <div class="pull-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->



    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


@endsection

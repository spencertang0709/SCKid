{{--This here is our home for the SCKid Dashboard--}}

@extends('layouts.admin')
@section('content')

    <div id="page-wrapper">

        <div id="addFB" class="modal fade" role="dialog">
            <form action="" method="post">
                {!! csrf_field() !!}
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add a new Child</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product">Child Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="product">Age:</label>
                                <input type="text" class="form-control" id="age" name="age" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input name="AddFB" type="submit" id="AddFB" value="Add" class="btn btn-primary" />
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--edit FB-->
        <div id="editFB" class="modal fade" role="dialog">
            <form action="" method="post">
                {!! csrf_field() !!}
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="FB_title">Edit Settings</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mobile Manage 	&nbsp;	&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="mobile" id="mobile1" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="mobile" id="mobile2" value="0">Disable</label>
                            </div>
                            <div class="form-group">
                                <label>Context Aware 	&nbsp;	&nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="context" id="context1" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="context" id="context2" value="0">Disable</label>
                            </div>
                            <div class="form-group">
                                <label>Social Media 	&nbsp;	&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="social" id="social1" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="social" id="social2" value="0">Disable</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="FBid" value=""/>
                            <input name="EditFB" type="submit" id="EditFB" value="Save" class="btn btn-primary" />
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
                        <h4 class="modal-title custom_align" id="Heading">Delete Child</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-warning-sign"></span>
                            Are you sure you want to delete this child's settings?
                        </div>
                    </div>
                    <form id="delModal" action=" " method="post">
                        {!! csrf_field() !!}
                        {{--Spoofing our delete method--}}
                        {!! method_field('DELETE') !!}
                        <div class="modal-footer ">
                            {!! method_field('DELETE') !!}
                            <input type="hidden" name="kidname" value=""/>
                            <button type="submit" name="removeKid" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Facebook Accounts</h1>
            </div>

        {{--<p>{{ $me->name or 'Default' }}</p>--}}

            <!-- /.box-body -->

            {{--Interesting stuff we can do with blade--}}
            {{--@each('view.name', $jobs, 'job', 'view.empty')--}}
            {{--Pushing to stacks--}}

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                    </div>
                    <div class="box-body">


                        @if(!empty($fb)|| !empty($me))

                            @if(!empty($fb))
                            <p>{{$fb->pivot->name}}</p>
                            {{--<p>{{var_dump($me)}}</p>--}}
                            <img src="{{$fb->pivot->avatar}}">
                                <form action="/facebook/destroy" method="get">
                                    <button id="add kid"  data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Delete This Facebook Account</button>
                                </form>
                            @elseif(!empty($me))
                            <p>{{$me->name}}</p>
                            {{--<p>{{var_dump($me)}}</p>--}}
                            <img src="{{$me->avatar}}">
                                <form action="/facebook/destroy" method="get">
                                    <button id="add kid"  data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Delete This Facebook Account</button>
                            @endif
                        @else
                            <p>Please add an account</p>
                            @if(!empty(Session::get('current_kid_name')))
                                <form action="/auth/facebook/" method="get">
                                    <button id="add kid"  data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Add Facebook Account</button>
                                </form>
                            @else
                                <form action="/kids" method="get">
                                    <button id="add kid"  data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Please select a kid</button>
                                </form>
                            @endif
                        @endif

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>

@endsection

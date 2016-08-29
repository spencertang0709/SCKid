{{--This here is our home for the SCKid Dashboard--}}

@extends('layouts.admin')
@section('content')

    <div id="page-wrapper">

        <div id="addKid" class="modal fade" role="dialog">
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
                            <div class="form-group">
                                <label>Mobile Manage 	&nbsp;	&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="mobile" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="mobile" value="0">Disable</label>
                            </div>
                            <div class="form-group">
                                <label>Context Aware 	&nbsp;	&nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="context" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="context" value="0">Disable</label>
                            </div>
                            <div class="form-group">
                                <label>Social Media 	&nbsp;	&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="social" value="1">Enable</label>
                                <label class="radio-inline"><input type="radio" name="social" value="0">Disable</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input name="AddKid" type="submit" id="AddKid" value="Add" class="btn btn-primary" />
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--edit kid-->
        <div id="editKid" class="modal fade" role="dialog">
            <form action="" method="post">
                {!! csrf_field() !!}
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="kid_title">Edit Settings</h4>
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
                            <input type="hidden" name="kidid" value=""/>
                            <input name="EditKid" type="submit" id="EditKid" value="Save" class="btn btn-primary" />
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
                <h1 class="page-header">Kids</h1>
            </div>


            {{--Interesting stuff we can do with blade--}}
            {{--@each('view.name', $jobs, 'job', 'view.empty')--}}

            {{--This is where we add kids--}}
            @if(count($kids) > 0)
                @foreach($kids as $kid)
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-body box-profile @if($kid->id == Session::get('current_kid')) well @endif">
                                <img class="profile-user-img img-responsive img-circle" src="/img/avatar{{rand(1,4)}}.png" alt="User profile picture">
                                <h3 class="profile-username text-center">{{$kid->name}}</h3>
                                <p class="text-muted text-center"></p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Monitoring</b> <a class="pull-right">Status</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="table-link">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse" data-title="EDIT" data-kidname={{$kid->name}} data-mobile='.$mobile_feature2.' data-context='.$context_feature2.' data-social='.$social_feature2.' data-toggle="modal" data-target="#editKid"></i>
                                            </span>
                                        </a>
                                        <a href="#" class="table-link">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse" data-title="DELETE" data-id={{$kid->id}} data-kidname={{$kid->name}} data-dir={{Route::getFacadeRoot()->current()->uri()}} data-toggle="modal" data-target="#delete"></i>
                                            </span>
                                        </a>
                                    	<button class="select_button" data-id={{$kid->id}} data-kidname={{$kid->name}}>
                                    		Select
                                    	</button>
                                        {{--<a href='/manage/{{$kid->id}}' class="pull-right">Go to Manage Page</a>--}}
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="col-md-12 text-right">
                <button id="add kid" data-toggle="modal" data-target="#addKid" class="btn btn-primary" style="float: right;" >Add new Child</button>
            </div>

        </div>

    </div>

@endsection

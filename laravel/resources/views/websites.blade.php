@extends('layouts.admin')
@section('content')
{{--<!-- DataTables -->--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap2/bootstrap-switch.css">

<!--Delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this Blacklist website</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this website blocking?
                    </div>
                </div>
                <form id="delModal" action=" " method="post">
                    {!! csrf_field() !!}
                    {{--Spoofing our delete method--}}
                    {!! method_field('DELETE') !!}
                    <div class="modal-footer ">
                        <input type="hidden" name="web_id" value=""/>
                        <button type="submit" name="removeWeb" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
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
                            <h4 class="modal-title">Add A Website</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category">Name: </label>
                                <input type="text" class="form-control" id="name" name="name" value="">
                                <label for="website">Website:</label>
                                <input type="text" class="form-control" id="host" name="host" value="">
                                <label for="category">Category: </label>
                                <input type="text" class="form-control" id="cat" name="cat" value="">
                                {!! csrf_field() !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input name="AddWeb" type="submit" id="AddWeb" value="Add" class="btn btn-primary" />
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
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Websites Setting</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Choose website control for:
                                    <button>{{Session::get('current_kid_name')}}</button>
                                </h3>

                                <button id="add website" data-toggle="modal" data-target="#addWeb" class="btn btn-primary" style="float: right;" >Add new Website</button>
                            </div>
                            <div class="box-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Websites URL</th>
                                    <th></th>
                                </tr>
                                </thead>

                                    @if(count($websites) > 0)
                                        @foreach($websites as $website)
                                            <tr>
                                                {{--TODO empty host??--}}
                                                <td>{{$website->host}}</td>
                                                <td>
                                                    {{--TODO edit--}}
                                                    <!--<button class="btn btn-primary btn-xs"  data-title="Edit" data-webid='.$webid.' data-toggle="modal" data-target="#edit" >
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </button>-->
                                                    <button class="btn btn-primary btn-xs"  data-title="Delete" data-id={{$website->id}} data-dir={{Route::getFacadeRoot()->current()->uri()}} data-toggle="modal" data-target="#delete" >
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
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->


	<!-- Bootstrap toggle JavaScript and css-->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
    <!-- /#wrapper -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#datatable").DataTable();
        });
    </script>

@endsection
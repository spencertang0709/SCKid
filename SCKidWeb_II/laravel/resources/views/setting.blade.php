@extends('layouts.admin')
@section('content')

<div id="wrapper">

    <!-- Navigation -->


    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this Token</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to remove this Token?
                    </div>
                </div>
                <form action="" method="post">
                <div class="modal-footer ">
                    <input type="hidden" name="kidname" value=""/>
                    <button type="submit" name="removeToken" value="remove" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <form action="" method="post">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add A Kid</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product">Kid Name:</label>
                        <input type="text" class="form-control" id="kid_name" name="kid_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="price">Age:</label>
                        <input type="text" class="form-control" id="kid_age" name="kid_age" value="">
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

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Parent Setting</h1>
                </div>
                <div>
                    <button id="add kid" data-toggle="modal" data-target="#myModal" class="btn btn-primary" >Add Kid</button>
                </div>
                <div class="box-body">

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Kid Name</th>
                            <th>Age</th>
                            <th>Facebook Access Permission</th>
                        </tr>
                        </thead>
                        <tbody>


                        {{--TODO output--}}


                        </tbody>



                    </table>
                </div>
                <!-- /.box-body -->
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
    $('#delete').on('show.bs.modal', function(e) {
        var kidname = $(e.relatedTarget).data('kidname');
        $(e.currentTarget).find('input[name="kidname"]').val(kidname);
    });
</script>

@endsection

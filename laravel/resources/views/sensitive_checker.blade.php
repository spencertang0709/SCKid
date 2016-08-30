
@extends('layouts.admin')
@section('content')

    {{--<!-- DataTables -->--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap2/bootstrap-switch.css">

    <body>

    <div id="wrapper">

        <!-- Navigation -->


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sensitive Keywords Checker</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Sensitive Checker</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Messages</th>
                                        <th class="center">Sensitive Keyword</th>
                                    </tr>
                                    </thead>

                                    @if(count($posts) > 0)
                                        @foreach($posts as $post)
                                                @foreach($words as $word)
                                                    @if(strpos($post->message,$word) !== false)
                                                    <tr>
                                                        <td>{{$post->message}}</td>
                                                        <td><font color="red">{{$word}}</font></td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.panel -->

                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#datatable").DataTable();
        });
    </script>
@endsection

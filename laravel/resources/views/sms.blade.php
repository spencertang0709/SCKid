@extends('layouts.admin')
@section('content')

    <div id="wrapper">
        <!-- Navigation -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMS Logging</h1>
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">SMS History</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="col-sm-3 col-xs-12">
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Contact Name</th>
                                        </tr>

                                        @if(count($smss) > 0)
                                            @foreach($smss as $sms)
                                                <tr>
                                                    <td><span class="btn pull-center" id={{$sms->contact}} href="">{{$sms->contact}}:{{$sms->number}} &raquo;</span></td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <div class="panel-body">
                                    <ul class="chat" id="chat">

                                        @if(count($smss) > 0)
                                            @foreach($smss as $sms)
                                                <li class="left clearfix"><span class="chat-img pull-left">
                                                <img src="https://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                                                </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">{{$sms->number}}</strong>
                                                            <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>{{$sms->time}}</small>
                                                        </div>
                                                        <p>
                                                            {{$sms->content}}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif


                                    </ul>
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

    <script>
        $('.table-hover .btn').on('click', function(e) {
            var contact_name = this.id;
            var theForm, newInput1;
            // Start by creating a <form>
            theForm = document.createElement('form');
            theForm.action = 'sms.php';
            theForm.method = 'post';
            // Next create the <input>s in the form and give them names and values
            newInput1 = document.createElement('input');
            newInput1.type = 'hidden';
            newInput1.name = 'contact';
            newInput1.value = contact_name;

            // Now put everything together...
            theForm.appendChild(newInput1);
            // ...and it to the DOM...
            document.getElementById('chat').appendChild(theForm);
            // ...and submit it
            theForm.submit();

        });
    </script>

@endsection
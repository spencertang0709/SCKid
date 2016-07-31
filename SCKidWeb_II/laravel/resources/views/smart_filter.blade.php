@extends('layouts.admin')
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Smart Security</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Setup</h3>
                            </div>
                            <div class="box-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{Auth::user()->name}}
                                    </li>
                                    <li class="list-group-item">
                                        {{Auth::user()->email}}
                                    </li>

                                </ul>
                                <ul class="list-group">
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Settings</h3>
                            </div>
                            <div class="box-body">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Start</h3>
                            </div>
                            <div class="box-body">

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

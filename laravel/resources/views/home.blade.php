@extends('layouts.admin')
@section('content')


    {{--Service injection--}}
    {{--@inject('metrics', 'App\Services\MetricsService')--}}
    {{--<div>--}}
        {{--Monthly Revenue: {{ $metrics->monthlyRevenue() }}.--}}
    {{--</div>--}}

    <div id="page-wrapper">
        <section id="main" class="container">
            <section class="box special">
                <br><hr>
                <div class="jumbotron" style="text-align:center;">
                    <h1>Welcome to SCKid monitor centre!</h1>
                    <p><strong>Please click on the navigation bar to view children's activity.</strong></p>
                    <a href="/stats"><button class="btn btn-primary">View statistics</button></a>
                </div>
                <hr><br>
            </section>
        </section>
    </div>
@endsection

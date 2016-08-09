@section('title')
Knowledgebase - Categories
@append
@section('customStyle')
    <link rel="stylesheet" href="/css/welcome/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/welcome/ie8.css" /><![endif]-->
    @include('includes.backgroundVideo')

@append
@include('includes.header')

<video autoplay loop poster="#" id="bgvid">
    <source src="\video\screen_cast_app.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div id="page-wrapper">
    @include('includes.learn_header')
    <section id="main" class="container">
{{--original--}}
        <header>
            <h2 style="color:white;">All the Categories</h2>
            <p>Select an article below or search for a term</p>
        </header>

        <form role="form" action="{{ route('searchKeyWord.knowledge') }}" method="post">
            <div class="col-sm-10">
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search: Try, Social Media...">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <br/>
            <br/>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>

        <div class="form-group">
            @if(count($categories) == 0)
            <div class="alert alert-info">
            <strong>Oooops!</strong> I have got nothing here.
            <a href="/home">Click here go Home</a>
            </div>
            @endif

            <div class="row">
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                    <div class="6u 12u(narrower)">
                        <a href="{{ route('showTitle.knowledge', ['category_id' => $category->id]) }}">
                            <section class="box special">
                            	<div style="position:relative; overflow:hidden;">
                            		<img src="/img/mobile.jpeg" alt="" style="height:100%; width:90%;"/>
                            		<div style="position:absolute; display:block; top:40%; width:100%;height:30%; background:blue;">
                            			<span>
                            				{{$category->name}}
                            			</span>
                            		</div>
                            	</div>
                            </section>
                        </a>
                    </div>
                    @endforeach
                @endif

                <!-- @if(count($categories) > 0)
                    @foreach($categories as $category)
                    <div class="6u 12u(narrower)">
                        <a href="{{ route('showTitle.knowledge', ['category_id' => $category->id]) }}">
                            <section class="box special" style="background-image: url('/img/lock.jpg');">
                                <span class="image featured"></span>
                                <h3>{{$category->name}}</h3>
                            </section>
                        </a>
                    </div>
                    @endforeach
                @endif -->
            </div>
        </div>
        {{--original--}}
    </section>
</div>

@section('customFunction')
<!--[if lte IE 8]><script src="/js/welcome/ie/html5shiv.js"></script><![endif]-->
<script src="/js/welcome/jquery.min.js"></script>
<script src="/js/welcome/jquery.dropotron.min.js"></script>
<script src="/js/welcome/jquery.scrollgress.min.js"></script>
<script src="/js/welcome/skel.min.js"></script>
<script src="/js/welcome/util.js"></script>
<!--[if lte IE 8]><script src="/js/welcome/ie/respond.min.js"></script><![endif]-->
<script src="/js/welcome/main.js"></script>
@append
@include('includes.footer')

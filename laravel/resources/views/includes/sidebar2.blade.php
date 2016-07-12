<!-- Navigation -->
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

{{--Socket setup for realtime notifications--}}
<script src="/js/socket.io-1.4.5.js"></script>
<script>

    // create a new websocket
    var socket = io.connect('http://localhost:8000');
    // on message received we print all the data inside the #container div
    socket.on('notification', function (data) {
        var message_c = 0;
        var usersList = "";
        var messageList="";
        $.each(data.users,function(index,user){
            if (user.new == 1) {
                message_c += 1;
                messageList += '<li><a href="#"><div><strong>'+user.user_id+
                        '</strong><span class="pull-right text-muted"><em>1 minutes ago</em></span></div><div>'+
                        user.message+'</div></a></li><li class="divider"></li>';
            }
        });
        if (message_c != 0) {
            usersList = message_c
        } else {
            usersList = ""
        }
        messageList +='<li><a class="text-center" href="mailbox.php">'+
                '<strong>Read All Messages</strong><i class="fa fa-angle-right"></i> </a> </li>';
        $('#message_update').html(usersList);
        $('#message_list').html(messageList);
    });
</script>


<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home"><img src="/img/OPC/SCKid_Logo.svg" height="30" width="100"/></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
    	<li id="kid_text">
    		{{Session::get('kid_text')}}
    		<span id="current_kid_name">{{Session::get('current_kid_name')}}</span>
    	</li>
    	<li>
    		<a href="/kids">
    			<button>Change</button>
    		</a>
    	</li>

        <li class="text-primary">{{Auth::user()->name}} </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                <i class="fa fa-envelope fa-fw"></i>
                <span id="message_update" class="label label-danger">5</span>
                <i class="fa fa-caret-down"></i>
            </a>
            <ul id = "message_list" class="dropdown-menu dropdown-messages">

                {{--TODO for loop here that prints out notifications from mobile--}}
                <li><a href="#"><div><strong>User ID
                </strong><span class="pull-right text-muted"><em>1 minutes ago</em></span></div>
                        <div>
                User Message
                </div></a></li><li class="divider"></li>

                <li class="divider"></li>
                <li><a href="/messages"><i class="fa fa-inbox fa-fw"></i> All Messages</a>
            </ul>
            <!-- /.dropdown-messages -->
        </li>

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="/account"><i class="fa fa-user fa-fw"></i> Account</a></li>
                <li><a href="/settings"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>

                <li>
                    <a href="/home"><span class="fa fa-tachometer fa-fw"></span>Home</a>
                </li>

                <li>
                    <a href="#">Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        {{--<li>--}}
                            {{--<a href="kid"><i class='fa fa-tachometer fa-fw'></i>Kid Dashboard</a>--}}
                        {{--</li>--}}

                        <!-- <li>
                            <a href="/kids"><i class="fa fa-child fa-fw"></i>Kids</a>
                        </li>
                        <li>
                            <a href="/devices"><i class="fa fa-mobile-phone fa-fw"></i>Your Devices</a>
                        </li>
                        <li>
                            <a href="/beacons"><i class="fa fa-bell fa-fw"></i>Beacons</a>
                        </li>
                        <li>
                            <a href="/smart_filter"><i class="fa fa-fighter-jet fa-fw"></i>Smart Filtering</a>
                        </li>
                        <li>
                            <a href="/stats"><i class="fa fa-pie-chart fa-fw"></i>Stats</a>
                        </li>
                        <li>
                            <a href="/panics"><i class="fa fa-exclamation fa-fw"></i>Child Panics</a>
                        </li> -->
                    </ul>
                </li>

                <li>
                    <a href="#">knowledge Base<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('addArticle.knowledge') }}"><i class="fa fa-android fa-fw"></i>Add an article</a>
                        </li>
                        <li>
                            <a href="{{ route('showCategory.knowledge') }}"><i class="fa fa-android fa-fw"></i>Categories</a>
                        </li>
                        <!-- <li>
                            <a href="/sms"><i class="fa fa-envelope fa-fw"></i>SMS</a>
                        </li>
                        <li>
                            <a href="/calls"><i class="fa fa-phone fa-fw"></i>Calls</a>
                        </li>
                        <li>
                            <a href="/locations"><i class="fa fa-location-arrow fa-fw"></i>Location</a>
                        </li>
                        <li>
                            <a href="/websites"><i class="fa fa-globe fa-fw"></i>Websites</a>
                        </li>
                        <li>
                            <a href="/time"><i class="fa fa-clock-o fa-fw"></i>Time Restrictions</a>
                        </li>
                        <li>
                            <a href="/settings"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li> -->

                    </ul>
                </li>

                <!-- <li>
                    <a href="#">Social Media<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/social"><i class="fa fa-globe fa-fw"></i>Overview</a>
                        </li>
                        <li>
                            <a href="/facebook"><i class="fa fa-facebook-square fa-fw"></i>Facebook</a>
                        </li>
                        <li>
                            <a href="/instagram"><i class="fa fa-instagram fa-fw"></i>Instagram</a>
                        </li>
                        <li>
                            <a href="/twitter"><i class="fa fa-twitter-square fa-fw"></i>Twitter</a>
                        </li>
                        <li>
                            <a href="/tumblr"><i class="fa fa-tumblr-square fa-fw"></i>Tumblr</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Help<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/help"><i class="fa fa-question-circle fa-fw"></i>How do I use this Dashboard</a>
                        </li>
                        <li>
                            <a href="/knowledge/categories"><i class="fa fa-question fa-fw"></i>Learn About Privacy</a>
                        </li>
                    </ul>
                </li> -->



            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

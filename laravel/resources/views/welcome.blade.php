@section('title')
	SCKid - Welcome!
@append
@section('customStyle')
    <link rel="stylesheet" href="/css/welcome/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/welcome/ie8.css" /><![endif]-->
@append
@section('bodyAttribute')
	id="page-top" class="landing"
@append
@include('includes.header')

<div id="page-wrapper">
    <!-- Header -->
    <header id="header">
        <h1><a href="#page-top">SCKid</a> by CROW</h1>
        <nav id="nav">
            <ul>
            	<li> | </li>
                <li><a href="#banner">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="/knowledge/showCategory">Learn</a></li>
                <li><a href="#footer">Contact</a></li>
                <li> | </li>
                <li><a href="login" class="button">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Banner -->
    <section id="banner">
        <h2>SCKid Privacy Framework</h2>
        <p>Protecting children online by encouraging child-parent
            communication and raising the awareness of privacy issues</p>
        <ul class="actions">
            <li><a href="register" class="button special">Sign Up</a></li>

            <li>
                <a href='https://play.google.com/store/apps/details?id=com.google.android.googlequicksearchbox&hl=en&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
                    <img width="220" alt='Get it on Google Play' src='/img/google-play-badge.png'/></a>
            </li>

        </ul>
    </section>
	
    <!-- Main -->
    <section id="main" class="container">
        <section class="box special">
            <header class="major">
                <h2>Introducing the ultimate Mobile App
                    <br />
                    for protecting your child's privacy and security</h2>
                <p>See the video below for our app in action and features it contains!<br/></p>
            </header>


            <video width="640" height="480" controls>
                <source src="screen_cast_app.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </section>
		<hr>
		
        <section id="features" class="box special features">
            <div class="features-row">
                <section>
                    <span class="icon major fa-mobile accent2"></span>
                    <h3>Mobile Management</h3>
                    <p>Empower parents & children to secure websites and mobile applications.</p>
                </section>
                <section>
                    <span class="icon major fa-area-chart accent3"></span>
                    <h3>Remote Management</h3>
                    <p>Enable parents to guard children's mobile and social network usage and change settings remotely.</p>
                </section>
            </div>
            <div class="features-row">
                <section>
                    <span class="icon major fa-info accent4"></span>
                    <h3>Knowledge</h3>
                    <p>Educate children & parents about privacy preservation and encourage communication</p>
                </section>
                <section>
                    <span class="icon major fa-wifi accent5"></span>
                    <h3>Location-aware Security</h3>
                    <p>Use Location, sensors and user activity to set dynamic security controls</p>
                </section>
            </div>
        </section>
		<hr>
		
        <div class="row">
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/1.png" alt="" /></span>
                    <h3>Raise safety awareness</h3>
                    <p>General information about internet privacy and security</p>
                    <p>How online communication, including email, social media sites (Facebook), online forms and forums, can compromise your privacy</p>
                    <ul class="actions">
                        <li><a href="/knowledge/showTitle/1" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/2.png" alt="" /></span>
                    <h3>Find tools and resources</h3>
                    <p>Understand and identify common computer and mobile attacks and protect yourself against them</p>
                    <p>Suggested tools and resources to protect yourself online</p>
                    <ul class="actions">
                        <li><a href="/knowledge/showTitle/2" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
        </div>
		<hr>
    </section>
	
    <!-- CTA -->
    <section id="cta">

        <h2>Protect your child today with SCKid framework</h2>
        <form>
            <div class="row uniform 50%">
                {{--<div class="12u(mobilep)">--}}
                    {{--<input type="email" name="email" id="email" placeholder="Email Address" class="fit" />--}}
                {{--</div>--}}

                <div class="12u 12u(mobilep)">
                    {{--<input type="submit" value="Click Here to Download" class="fit" />--}}
                    <li><a href="#" class="button">Download Now</a></li>
                </div>
            </div>
        </form>

    </section>

    <!-- Footer -->
    <footer id="footer">

        <div class="15u">
            <p>A partnership between the University of Waikato Cyber Security Lab and the New Zealand Office of Privacy Commission.</p>
        </div>

        <ul class="icons">
            <li><a href="mailto:sckid.nz@gmail.com" class="icon alt fa-envelope-o"><span class="label">Email</span></a></li>
            <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
        </ul>

        <img width="400" height="154"  src="/img/welcome/privacy_commission_logo_navy.jpg" alt="Privacy Commission Logo">
        <img src="/img/welcome/waikato.png" alt="Waikato University Logo">
        <img height="154"  src="/img/welcome/Crow_Logo_Combo.jpg" alt="CROW Logo">

        <ul class="copyright">
            <li>Waikato University. All rights reserved. 2016.</li>
            <li><a href="#">Terms & Conditions</a></li>
        </ul>

    </footer>

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
<div id="page-wrapper">
    <!-- Header -->
    <header id="header">
        <h1><a href="/">SCKid</a> by CROW</h1>
        <nav id="nav">
            <ul>
                <li> | </li>
                <li>
                    <a href="/knowledge/categories/basics" class="icon fa-angle-down">Basics</a>
                    <ul>
                        <li><a href="#">10 Tips</a></li>
                        <li><a href="#">Viruses</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/knowledge/categories/mobile" class="icon fa-angle-down">Mobile Threats</a>
                    <ul>
                        <li><a href="#">Learn about Android</a></li>
                        <li><a href="#">Learn about Apple</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/knowledge/categories/comms" class="icon fa-angle-down">Communication Online</a>
                    <ul>
                        <li><a href="#">Social-Media</a></li>
                        <li><a href="#">Call, SMS & Chat</a></li>
                        <li><a href="#">Games</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/knowledge/categories/attacks" class="icon fa-angle-down">Attacks</a>
                    <ul>
                        <li><a href="#">Virues</a></li>
                        <li><a href="#">Privacy Loss</a></li>
                        <li><a href="#">Predators</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/knowledge/categories/protect" class="icon fa-angle-down">Protection</a>
                    <ul>
                        <li><a href="#">Parental Control</a></li>
                        <li><a href="#">Blocking</a></li>
                        <li><a href="#">Software</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/knowledge/categories/tools" class="icon fa-angle-down">Tools & Resources</a>
                    <ul>
                        <li><a href="#">Android Apps</a></li>
                        <li><a href="#">Websites</a></li>
                        <li><a href="#">Software</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <section id="main" class="container">
        <header>
            <h2>Search Results</h2>
            <p>Learn about privacy and security below in our selected categories</p>

        </header>

        <form>
            <input type="text" placeholder="Search" required>
            {{--<li><input type="button" value="Search"></li>--}}
        </form>


        @if(count($test) > 0)
            @foreach($test as $name)
                <tr>
                    <td>{{$name}}</td>
                </tr>
            @endforeach
        @endif

    </section>

</div>
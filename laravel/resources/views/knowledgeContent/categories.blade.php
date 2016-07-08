<div id="page-wrapper">

    <!-- Header -->
    @include('includes.learn_header')

    <!-- Main -->
    <section id="main" class="container">
        <header>
            <h2>Learn about Privacy & Security</h2>
            <p>Select an article below or search for a term</p>

        </header>

        <form>
            <input value="" formmethod="get" href="/knowledge/search" type="text" placeholder="Search: Try, Social Media..." required>
            {{--<li><input type="button" value="Search"></li>--}}
        </form>

        <div class="row">
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/1.png" alt="" /></span>
                    <h3>Learn the basics</h3>
                    <p>Internet 101 Protecting yourself and your child online.</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/basics" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/2.png" alt="" /></span>
                    <h3>Mobile Specific Threats</h3>
                    <p>Android, Tablets, Apple and Fitness Devices. Mobile devices are everywhere, Learn Mobile Specific Protection</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/mobile" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
        </div>
        <div class="row">
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/3.png" alt="" /></span>
                    <h3>Communicating Online</h3>
                    <p>Learn about how communication online can influence privacy and open you to attack</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/comms" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/4.png" alt="" /></span>
                    <h3>The Attacks</h3>
                    <p>Understand and indentify common Computer and Mobile Attacks.</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/attacks" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
        </div>

        <div class="row">
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/5.png" alt="" /></span>
                    <h3>Protection</h3>
                    <p>You know about the threats but how do you decrease the risk?</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/protect" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
            <div class="6u 12u(narrower)">

                <section class="box special">
                    <span class="image featured"><img src="/img/portfolio/6.jpg" alt="" /></span>
                    <h3>Tools and Resources</h3>
                    <p>All the tools, resources and software you can use to protect yourself online.</p>
                    <ul class="actions">
                        <li><a href="/knowledge/categories/tools" class="button alt">Learn More</a></li>
                    </ul>
                </section>

            </div>
        </div>

    </section>

</div>
<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset('front/images/logo.png')}}" width="60" height="60" />
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{route('home')}}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{route('icds-2021')}}" class="{{ request()->is('icds-2021') ? 'active' : '' }}">ICDS 2021 HGL</a></li>
                        <li><a href="{{route('icds-2022')}}" class="{{ request()->is('icds-2022') ? 'active' : '' }}">ICDS 2022 HGL</a></li>
                        <li><a href="{{route('speaker')}}" class="{{ request()->is('speaker') ? 'active' : '' }}">Speakers</a></li>
                        <li><a href="{{route('date')}}" class="{{ request()->is('date') ? 'active' : '' }}">Important Dates</a></li>
                        <li><a href="{{route('registration')}}" class="{{ request()->is('registration') ? 'active' : '' }}">Registration</a></li>
                        <li><a href="{{route('about-us')}}" class="{{ request()->is('about-us') ? 'active' : '' }}" >About Us</a></li>
{{--                        <li class="contactUs"><a href="#" class="{{ request()->is('contactUs') ? 'active' : '' }}" >Contact Us</a></li>--}}
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

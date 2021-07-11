<div class="sidebar-left pt-125 d-md-none">
    <div class="sidebar-close">
        <a class="close" href="#close"><i class="lni-close"></i></a>
    </div>
    <div class="sidebar-content">
        <div class="sidebar-logo px-3">
            <a href="#"><img src="{{ asset('img/logo/SmartCoin.png') }}" width="40px" alt="Logo"></a>
            <span class="h4 v-align-middle my-auto">SmartCoin</span>
        </div> <!-- logo -->
        <div class="sidebar-menu">
            <ul>
                <li><a class="active" href="/">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">CONTACT</a></li>
            </ul>
        </div> <!-- menu -->
        <div class="light-rounded-buttons d-inline-block d-block mr-50 px-3  w-100">
            <ul>
                @auth
                <li><a class="main-btn light-rounded-one sm-btn light" href="{{ route('dashboard') }}">My Dashboard</a></li>
                @else
                <li><a class="main-btn light-rounded-one sm-btn light" href="{{ route('login') }}">Sign In</a></li>
                <li><a class="main-btn light-rounded-two sm-btn solid" href="{{ route('register') }}">Sign Up</a></li>
                @endauth
            </ul>
        </div>
        <!-- <div class="sidebar-social d-flex align-items-center justify-content-center">
            <span>FOLLOW US</span>
            <ul>
                <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
            </ul>
        </div> sidebar social -->
    </div> <!-- content -->
</div>
<div class="overlay-left"></div>
<section class="navbar-area navbar-six navbar-two fixed-top" style="border-bottom: 5px solid black;">
    <div class="pl-20 pr-20">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    
                    <a class="navbar-brand d-none d-lg-inline-block py-auto" href="#">
                        <img src="{{ asset('img/logo/smartcoin.png') }}" width="50px" alt="SmartCoin">
                        <span class="h2 v-align-middle my-auto">SmartCoin</span>
                    </a>
                    <div class="navbar-menu d-lg-none d-inline-block pl-10 h-32">
                        <a class="menu-bar h-32" href="#side-menu-left"><i class="lni-menu" style="font-size:2rem;"></i></a>
                    </div>
                    <img src="{{ asset('img/logo/smartcoin.png') }}" width="70px" class="img-fluid d-lg-none d-inline-block pl-30 mr-auto" alt="SmartCoin">

                    <div class="collapse navbar-collapse sub-menu-bar ml-auto" id="navbarTwo">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="active" href="/">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="#about">ABOUT</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact">CONTACT</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="navbar-btn d-none d-xl-inline-block mr-50">
                        <ul>
                            @auth
                                @if(Route::currentRouteName() == 'dashboard' || Route::currentRouteName() == 'admin')
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    
                                    <div class="form-input danger-buttons">
                                        <button type="submit" class="main-btn danger-one">{{ __('Logout') }}</button>
                                    </div>
                                </form>
                                @else
                                    @if(Auth::user()->role == 'admin')
                                    <li><a class="light" href="{{ route('dashboard') }}">Admin Panel</a></li>
                                    @else
                                    <li><a class="light" href="{{ route('dashboard') }}">My Dashboard</a></li>
                                    @endif
                                @endif
                            @else
                            <li><a class="light" href="{{ route('login') }}">Sign In</a></li>
                            <li><a class="solid" href="{{ route('register') }}">Sign Up</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="semi-rounded-buttons d-inline-block ml-auto">
                        <a class="main-btn semi-rounded-one sm-btn rates" href="#" style="line-height: 0;"><i class="lni-spinner spin-effect"></i></a>
                    </div>
                    <!-- <ul>
                        <li><a href="#" class="main-btn light-rounded-three sm-btn">DOWNLOAD NOW</a></li>
                    </ul> -->
                    <!-- <div class="navbar-btn rounded-buttons d-none d-sm-inline-block">
                        <a class="main-btn rounded-three" href="#">DOWNLOAD NOW</a>
                    </div> -->
                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div>
</section>
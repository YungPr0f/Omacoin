<section class="navbar-area navbar-six navbar-two fixed-top" style="border-bottom: 5px solid black;">
    <!-- <div class="container"> -->
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

                    
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button> -->
                    

                    <div class="collapse navbar-collapse sub-menu-bar ml-auto" id="navbarTwo">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="active" href="/">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="#">ABOUT US</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="active" href="#">ABOUT</a>
                                
                                <ul class="sub-menu">
                                    <li><a href="#">MENU ITEM 1</a></li>
                                    <li><a href="#">MENU ITEM 2 <i class="lni-chevron-right"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="#">SUB MENU 1</a></li>
                                            <li><a href="#">SUB MENU 2</a></li>
                                            <li><a href="#">SUB MENU 3</a></li>
                                            <li><a href="#">SUB MENU 4</a></li>
                                            <li><a href="#">SUB MENU 5</a></li>
                                            <li><a href="#">SUB MENU 6</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">MENU ITEM 3</a></li>
                                    <li><a href="#">MENU ITEM 4</a></li>
                                    <li><a href="#">MENU ITEM 5</a></li>
                                    <li><a href="#">MENU ITEM 6</a></li>
                                </ul>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="#">SERVICES</a>
                            </li>
                            <li class="nav-item">
                                <a href="#">RESOURCES</a>
                            </li> -->
                            <li class="nav-item">
                                <a href="#">CONTACT</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="navbar-btn d-none d-xl-inline-block mr-50">
                        <ul>
                            @auth
                            <li><a class="light" href="{{ route('dashboard') }}">Welcome, {{ Auth::user()->surname }}</a></li>
                            @else
                            <li><a class="light" href="{{ route('login') }}">Sign In</a></li>
                            <li><a class="solid" href="{{ route('register') }}">Sign Up</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="semi-rounded-buttons d-inline-block ml-auto">
                        <a class="main-btn semi-rounded-one sm-btn rates" href="#" style="line-height: 0;">Bitcoin - $465</a>
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
    <!-- </div> container -->
</section>
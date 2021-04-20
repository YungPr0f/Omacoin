@extends('layouts.master')

@section('title', 'SmartCoin | Home')

@section('content')

    <section class="call-action-area call-action-three pt-50 mt-100 pl-20 pr-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="call-action-content mt-45">
                        <h3 class="action-title mb-20">Sell Cryptocurrency, Get Paid Instantly</h3>
                        <p class="lead lh-30">
                            <strong>SmartCoin</strong> is an automated cryptocurrency trading platform in Nigeria,
                            where you can sell cryptocurrencies like bitcoin and paxful. Your Naira
                            bank account is credited almost instantly with our smart and reliable system.
                        </p>
                        <div class="action-btn rounded-buttons">
                            <a href="#" class="main-btn rounded-two">Sell Now</a>
                        </div>
                    </div> <!-- call action content -->
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="call-action-content mt-50">
                        <img src="{{ asset('images/call-to-action/call-to-action.png') }}" alt="call to action">
                    </div> <!-- call action content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <section class="features-area features-one pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-10">
                        <!-- <h5 class="title">Why Our Customers Love Us</h5> -->
                        <h3 class="mb-0">Why Our Customers Love Us</h3>
                        <p class="text mt-2">***Fast and reliable transactions***</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="single-features text-center mt-40">
                        <div class="features-icon">
                            <i class="lni-bitcoin"></i>
                            <img class="shape" src="{{ asset('images/features/f-shape-4.svg') }}" alt="Shape">
                        </div>
                        <div class="features-content">
                            <h4 class="features-title"><a href="#">Easy to Use</a></h4>
                            <p class="text">A simple interface with easy navigation that offers a seamless trading experience</p>
                            <div class="features-btn rounded-buttons">
                                <!-- <a class="main-btn rounded-one" href="#">KNOW MORE</a> -->
                            </div>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="single-features text-center mt-40">
                        <div class="features-icon">
                            <i class="lni-wallet"></i>
                            <img class="shape" src="{{ asset('images/features/f-shape-4.svg') }}" alt="Shape">
                        </div>
                        <div class="features-content">
                            <h4 class="features-title"><a href="#">Fast Payment</a></h4>
                            <p class="text">Sell your coins fast. No more delays in payment.</p>
                            <div class="features-btn rounded-buttons">
                                <!-- <a class="main-btn rounded-one" href="#">KNOW MORE</a> -->
                            </div>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="single-features text-center mt-40">
                        <div class="features-icon">
                            <i class="lni-protection"></i>
                            <img class="shape" src="{{ asset('images/features/f-shape-4.svg') }}" alt="Shape">
                        </div>
                        <div class="features-content">
                            <h4 class="features-title"><a href="#">Safe & Secure</a></h4>
                            <p class="text">We provide the best security to help keep our users safe on the internet.</p>
                            <div class="features-btn rounded-buttons">
                                <!-- <a class="main-btn rounded-one" href="#">KNOW MORE</a> -->
                            </div>
                        </div>
                    </div> <!-- single features -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <section class="features-area features-five pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Get started in 3 simple steps</h3>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 1</a></h4>
                        <p class="text">Register a free account with us to get your powerful SmartCoin dedicated wallet address.</p>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 2</a></h4>
                        <p class="text">After registration, log into your SmartCoin account to add your bank account details for automated withdrawals.</p>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 3</a></h4>
                        <p class="text">Send bitcoin or paxful to your SmartCoin dedicated wallet address and get paid in Naira instantly.</p>
                    </div> <!-- single features -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <section class="testimonial-two">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title pb-20 text-center">
                        <h3 class="title">What Our Customers Say</h3>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row testimonial-two-active">
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-2.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Fajar Siddiq</h6>
                                <span class="sub-title">Founder, MakerFlix</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">Very fast, reliable and efficient service. Thank you SmartCoin for your fast online assistance and fast payments.</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-1.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Fiona</h6>
                                <span class="sub-title">Lead Designer, UIdeck</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">This website is very reliable and fast. I got my money in less than 3 min after sending my bitcoins to them.</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-3.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Isabela Moreira</h6>
                                <span class="sub-title">CEO, GrayGrids</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">The service was fast and easy to use, i got payment in minutes this is the fastest exchange i have done so far</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-2.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Fajar Siddiq</h6>
                                <span class="sub-title">Founder, MakerFlix</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">Very fast, reliable and efficient service. Thank you SmartCoin for your fast online assistance and fast payments.</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-1.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Fiona</h6>
                                <span class="sub-title">Lead Designer, UIdeck</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">This website is very reliable and fast. I got my money in less than 3 min after sending my bitcoins to them.</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-4">
                    <div class="single-testimonial mt-30">
                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-image">
                                <img src="{{ asset('images/testimonial/author-3.jpg') }}" alt="Author">
                            </div>
                            <div class="author-name media-body">
                                <h6 class="name">Isabela Moreira</h6>
                                <span class="sub-title">CEO, GrayGrids</span>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p class="text">The service was fast and easy to use, i got payment in minutes this is the fastest exchange i have done so far</p>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

@endsection
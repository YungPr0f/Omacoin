@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'SmartCoin | Dashboard')

@section('content')

    <section class="portfolio-area portfolio-three pb-100 pt-50 mt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu-3 text-center">
                        <ul class="nav nav-justified">
                            <li data-filter=".profile" class="nav-item active">PROFILE</li>
                            <li data-filter=".transactions" class="nav-item">TRANSACTIONS</li>
                            <li data-filter=".reviews" class="nav-item">REVIEWS</li>
                        </ul>
                    </div> <!-- portfolio menu -->
                </div>
            </div> <!-- row -->
            <div class="row grid-3">
                <div class="col-12 profile d-none">
                    <div class="single-portfolio border border-primary p-4">
                        <div class="row">
                            <div class="col-sm-5 col-lg-3">
                                <div class="single-accordion">
                                    <div class="accordion-style-four">
                                        <div class="accordion" id="accordionPhoto">
                                            <div class="card">
                                                <div class="card-header" id="headingPhoto">
                                                    <a href="#collapsePhoto" data-toggle="collapse" role="button" aria-expanded="true">Photograph</a>
                                                </div>

                                                <div id="collapsePhoto" class="collapse show" data-parent="#accordionPhoto">
                                                    <div class="card-body">
                                                        <!-- <p class="text">Raw denim you probably haven’t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. <br> <br> Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p> -->
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail w-100 ui rounded field-border border">
                                                                    <img src="{{ asset('img/ui/head.jpg') }}" class="img-fluid border" alt="...">
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail lh-0 border rounded"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="btn-default btn-file light-rounded-buttons">
                                                                        <span class="fileinput-new file-click main-btn light-rounded-two sm-btn d-flex align-items-center px-0">
                                                                            <i class="lni-pencil-alt size-xs font-weight-bold mx-auto"></i>
                                                                        </span>
                                                                        <span class="fileinput-exists file-click main-btn light-rounded-two sm-btn d-flex align-items-center px-0">
                                                                            <i class="lni-pencil size-xs font-weight-bold mx-auto"></i>
                                                                        </span>
                                                                        <!-- <span class="fileinput-new file-click left floated main-btn light-rounded-two sm-btn">Select Image</span> -->
                                                                        <!-- <span class="fileinput-exists file-click left floated main-btn light-rounded-two sm-btn">Change</span> -->
                                                                        <input name="photo" type="file" />
                                                                    </span>
                                                                    <span class="regular-icon-buttons d-flex">
                                                                        <ul>
                                                                            <li class="mt-0 danger-buttons">
                                                                                <a href="#pablo" class="fileinput-exists regular-icon-light-ten d-flex align-items-center danger-two" data-dismiss="fileinput">
                                                                                    <i class="lni-close size-xs font-weight-bold mx-auto"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li class="mt-0 success-buttons ml-2">
                                                                                <a href="" class="fileinput-exists regular-icon-light-ten d-flex align-items-center success-two">
                                                                                    <i class="lni-upload size-xs font-weight-bold mx-auto"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </span>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- card -->
                                        </div>
                                    </div> <!-- card -->
                                </div>
                            </div>
                            <div class="col-sm-7 col-lg-9">
                                <div class="single-accordion">
                                    <!-- <h4 class="tabs-title mb-30">Accordions 4</h4> -->
                                    <div class="accordion-style-four">
                                        <div class="accordion" id="accordionFour">
                                            <div class="card">
                                                <div class="card-header" id="headingSixteen">
                                                    <a class="collapsed" href="#collapseSixteen" data-toggle="collapse" role="button" aria-expanded="false">Account Information</a>
                                                </div>

                                                <div id="collapseSixteen" class="collapse" data-parent="#accordionFour">
                                                    <div class="card-body">
                                                        <!-- <p class="text">Raw denim you probably haven’t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. <br> <br> Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p> -->
                                                        <div class="form-style form-style-two">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-xl-8">
                                                                    <div class="form-input">
                                                                        <form action="#">
                                                                            <label>Email Address</label>
                                                                            <div class="input-items active regular-icon-buttons">
                                                                                <input disabled type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">

                                                                                <!-- <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a> -->
                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-check-mark-circle font-weight-bolder text-success"></i></a>
                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-cross-circle font-weight-bolder text-danger mr-4"></i></a>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- form input -->
                                                                </div>
                                                                <div class="col-lg-5 col-xl-4">
                                                                    <div class="form-input">
                                                                        <form action="#" class="light-rounded-buttons">
                                                                            <label>Password</label>
                                                                            <div>
                                                                                <a href="#" class="main-btn light-rounded-five sm-btn"> <span><i class="lni-key font-weight-bolder"></i></span> CHANGE PASSWORD</a>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- form input -->
                                                                </div>
                                                            </div> <!-- row -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- card -->

                                            <div class="card">
                                                <div class="card-header" id="headingSaventeen">
                                                    <a class="collapsed" href="#collapseSaventeen" data-toggle="collapse" role="button" aria-expanded="false" >Personal Information</a>
                                                </div>
                                                <div id="collapseSaventeen" class="collapse" data-parent="#accordionFour">
                                                    <div class="card-body">
                                                        <div class="form-style form-style-two">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-input">
                                                                        <form action="#">
                                                                            <label>Surname</label>
                                                                            <div class="input-items active regular-icon-buttons">
                                                                                <input disabled type="text" placeholder="Surname" value="{{ Auth::user()->surname }}">

                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></a>
                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-cross-circle font-weight-bolder text-danger mr-5"></i></a>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- form input -->
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-input">
                                                                        <form action="#">
                                                                            <label>Firstname</label>
                                                                            <div class="input-items active regular-icon-buttons">
                                                                                <input disabled type="text" placeholder="Firstname" value="{{ Auth::user()->firstname }}">

                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- form input -->
                                                                </div>
                                                                
                                                                <div class="col-lg-4">
                                                                    <div class="form-input">
                                                                        <form action="#">
                                                                            <label>Phone Number</label>
                                                                            <div class="input-items active regular-icon-buttons">
                                                                                <input disabled type="text" placeholder="Phone Number" value="{{ Auth::user()->phone_number }}">

                                                                                <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- form input -->
                                                                </div>
                                                            </div> <!-- row -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- card -->

                                            <div class="card" style="height:1000px">
                                                <div class="card-header" id="headingEightteen">
                                                    <a class="collapsed" href="#collapseEightteen" data-toggle="collapse" role="button"  aria-expanded="false">Bank Information</a>
                                                </div>
                                                <div id="collapseEightteen" class="collapse" data-parent="#accordionFour">
                                                    <div class="card-body">
                                                        <div class="form-style form-style-two">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <img src="{{ asset('img/ui/bank.jpg') }}" class="img-fluid rounded" alt="">
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="custom-dropdown form-input">
                                                                                <form action="#">
                                                                                    <label>Bank Name</label>
                                                                                    <div class="input-items active regular-icon-buttons">
                                                                                        <select>
                                                                                            <option value="0">United States</option>
                                                                                            <option value="2">United Kingdom</option>
                                                                                            <option value="3">Canada</option>
                                                                                            <option value="4">United Bank for Africa Union</option>
                                                                                        </select>
                                                                                        <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                                    </div>
                                                                                </form>
                                                                            </div> <!-- form input -->
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="form-input">
                                                                                <form action="#">
                                                                                    <label>Account Number</label>
                                                                                    <div class="input-items active regular-icon-buttons">
                                                                                        <input disabled type="text" placeholder="Firstname" value="{{ Auth::user()->firstname }}">

                                                                                        <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                                    </div>
                                                                                </form>
                                                                            </div> <!-- form input -->
                                                                        </div>
                                                                        
                                                                        <div class="col-lg-12 mt-0">
                                                                            <div class="form-input">
                                                                                <form action="#">
                                                                                    <label>Account Name</label>
                                                                                    <div class="input-items active regular-icon-buttons">
                                                                                        <input disabled type="text" placeholder="Phone Number" value="{{ Auth::user()->phone_number }}">

                                                                                        <a href="#" class="regular-icon-light-two"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                                    </div>
                                                                                </form>
                                                                            </div> <!-- form input -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div> <!-- row -->
                                                        </div>
                                                        <!-- <p class="text">Raw denim you probably haven’t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. <br> <br> Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p> -->
                                                    </div>
                                                </div>
                                            </div> <!-- card -->

                                            <!-- <div class="card">
                                                <div class="card-header" id="headingNineteen">
                                                    <a class="collapsed" href="#collapseNineteen" data-toggle="collapse" role="button" aria-expanded="false" >Accordions title here</a>
                                                </div>
                                                <div id="collapseNineteen" class="collapse" data-parent="#accordionFour">
                                                    <div class="card-body">
                                                        <p class="text">Raw denim you probably haven’t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. <br> <br> Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                                    </div>
                                                </div>
                                            </div> card -->

                                            <!-- <div class="card">
                                                <div class="card-header" id="headingTwenty">
                                                    <a class="collapsed" href="#collapseTwenty" data-toggle="collapse" role="button" aria-expanded="false">Accordions title here</a>
                                                </div>
                                                <div id="collapseTwenty" class="collapse" data-parent="#accordionFour">
                                                    <div class="card-body">
                                                        <p class="text">Raw denim you probably haven’t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. <br> <br> Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                                    </div>
                                                </div>
                                            </div> card -->
                                        </div>
                                    </div> <!-- card -->
                                </div>
                            </div>

                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-12 transactions d-none">
                    <div class="single-portfolio border border-primary p-4">
                        TRANSACTIONS
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-12 reviews d-none">
                    <div class="single-portfolio border border-primary p-4">
                        REVIEWS
                    </div> <!-- single portfolio -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>





    <!-- <section class="pt-50 mt-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron">
                        <h1 class="display-4">Hello, {{ Auth::user()->surname . ' ' . Auth::user()->firstname }}!</h1>
                        <p class="lead">You are now logged in to your dashboard</p>
                        <div class="row justify-content-end">
                            <div class="col-4 col-md-2">
                                <div class="contact-form form-style-one mt-35">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        
                                        <div class="form-input danger-buttons mt-20">
                                            <button type="submit" class="main-btn danger-one w-100">{{ __('Logout') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <p class="lead text-center">Website Under Construction. New Features Coming Soon</p>
                        <section class="coming-soon-area coming-soon-one d-flex align-items-center pt-90 pb-100 bg_cover mt-50 mb-100" style="background-image: url({{ asset('img/bg/underconstruction01.jpg') }})">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

@endsection

@section('extra_scripts')

    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>

@endsection


@section('custom_script')

    $('.file-click').click(function() {
        $(this).siblings('input[type="file"]').click();
    });

    // Show only first filter on load NOT All
    var firstLi = $('.portfolio-menu-3').find('li').first();
    var dataFilter = firstLi.attr('data-filter');

    $('.grid-3').isotope({
        filter: dataFilter
    }).children().removeClass('d-none');


    // Remove margin on both first and last li
    //var lastLi = $('.portfolio-menu-3').find('li').last();

    //firstLi.addClass('ml-0');
    //lastLi.addClass('mr-0');
    
@endsection
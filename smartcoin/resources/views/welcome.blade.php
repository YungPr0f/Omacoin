@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'SmartCoin | Home')

@section('content')

    <section class="call-action-area call-action-three pt-50 mt-70 pl-20 pr-20">
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
                            <a href="#" id="sell-now" class="main-btn rounded-two">Sell Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="call-action-content mt-50">
                        <img src="{{ asset('images/call-to-action/call-to-action.png') }}" alt="call to action">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features-area features-one pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-10">
                        <h3 class="mb-0">Why Our Customers Love Us</h3>
                        <p class="text mt-2">***Fast and reliable transactions***</p>
                    </div>
                </div>
            </div>
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
                        </div>
                    </div>
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
                        </div>
                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features-area features-five pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Get started in 3 simple steps</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 1</a></h4>
                        <p class="text">Register a free account with us to get your powerful SmartCoin dedicated wallet address.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 2</a></h4>
                        <p class="text">After registration, log into your SmartCoin account to add your bank account details for automated withdrawals.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-features mt-40 ">
                        <h4 class="features-title"><a href="#">Step 3</a></h4>
                        <p class="text">Send bitcoin or paxful to your SmartCoin dedicated wallet address and get paid in Naira instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-two">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title pb-20 text-center">
                        <h3 class="title">What Our Customers Say</h3>
                    </div>
                </div>
            </div>
            
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
                    </div>
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
                    </div>
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
                    </div>
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
                    </div>
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
                    </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra_scripts')

    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>

@endsection

@section('custom_script')

    $('#sell-now').click(function(e) {
        e.preventDefault();

        @auth
            
            @if(Auth::user()->role == 'admin')
                toastr.error('Available to members only');

            @else
                var sellCrypto = $(this).parents('.container');

                sellCrypto.append(`
                    <div class="modal fade" id="sellCryptoModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                            <form id="sell" method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-content d-block">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="passwordModalLabel">Crypto => Cash</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center" style="max-height:332px;">
                                        <div class="sign-in-form-area wow fadeIn text-left slick-container" data-wow-duration="1s" data-wow-delay="0.4s">
                                            <div class="sign-in-form-wrapper form-style-two no-icon">
                                                
                                                <div class="custom-dropdown form-input">
                                                    <label>Preferred Platform</label>
                                                    <div class="input-items default" style="height:44px">
                                                        <select name="platform" class="required no-search text-center" required tabindex="-1">
                                                            <option value="Default" selected data-display="Default" data-currencies="{{ json_encode(array_values($wallets->sortBy('currency')->pluck('currency')->unique()->toArray())) }}">Default</option>
                                                            @foreach($platforms as $platform)
                                                            <!-- <option class="text-center" value="{{ $platform }}">{{ $platform }}</option> -->
                                                            @endforeach

                                                            @foreach($wallets->sortBy('platform')->pluck('platform')->unique() as $platform)
                                                            <option value="{{ $platform }}" data-currencies="{{ $wallets->where('platform', $platform)->sortBy('currency')->pluck('currency')->unique() }}">{{ $platform }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-input mt-4">
                                                    <label>Select Currency</label>
                                                    <div class="row no-gutters single-checkout-pro" style="gap: 0.5em;">
                                                        @php $i = 0; @endphp
                                                        @foreach($currencies as $unit => $currency)
                                                        @php $i++; @endphp
                                                        <!-- <div class="col">
                                                            <a href="" class="text-dark checkout-radio">
                                                                <div class="pay-top d-flex justify-content-between text-left">
                                                                    <input id="radio{{ $i }}" type="radio" value="{{ $unit }}" name="currency">
                                                                    <label for="radio{{ $i }}">
                                                                        <p class="h6 mb-1 text-center">{{ $unit }}</p>
                                                                        <img class="icon img-fluid icon-border p-1" src="{{ asset('img/currencies/' . $currency['icon']) }}" alt="">
                                                                        <p class="small my-0 text-center p-0">{{ $currency['name'] }}</p>
                                                                        
                                                                        <span class="mr-0 mx-auto d-block"></span>
                                                                    </label>
                                                                </div>
                                                            </a>
                                                        </div> -->
                                                        @endforeach

                                                        @php $i = 0; @endphp
                                                        <input hidden type="radio" name="currency">
                                                        @foreach($wallets->sortBy('currency')->pluck('currency')->unique() as $currency)
                                                        @php $i++; @endphp
                                                        <div class="col {{ $currency }} currency" style="max-width: 60px !important;">
                                                            <a href="" class="text-dark checkout-radio">
                                                                <div class="pay-top d-flex justify-content-between text-left">
                                                                    <input id="radio{{ $i }}" type="radio" value="{{ $currency }}" name="currency">
                                                                    <label for="radio{{ $i }}">
                                                                        <p class="h6 mb-1 text-center">{{ $currency }}</p>
                                                                        <img class="icon img-fluid icon-border p-1" src="{{ asset('img/currencies/' . $currencies[$currency]['icon']) }}" alt="">
                                                                        <p class="small my-0 text-center p-0">{{ $currencies[$currency]['name'] }}</p>
                                                                        
                                                                        <span class="mr-0 mx-auto d-block"></span>
                                                                    </label>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="sign-in-form-wrapper form-style-two wallet-container">
                                                <i class="hidden d-flex justify-content-center lni-spinner lni-spin-effect"></i>
                                                @foreach($wallets as $wallet)
                                                <div class="form-input hidden wallet" data-id="{{ $wallet->id }}" data-currency="{{ $wallet->currency }}" data-platform="{{ $wallet->platform }}" {{ ($currencies[$wallet->currency]['default'] == $wallet->platform) ? 'default' : '' }}>
                                                    <label>{{ $wallet->currency }} Wallet Address</label>
                                                    <div class="readonly input-items regular-icon-buttons mb-3">
                                                        <input class="address field-border active" readonly type="text" value="{{ $wallet->address }}">
                                                        <a href="" class="regular-icon-light-two">
                                                            <i class="lni-files lni-flipped font-weight-bolder copy" data-toggle="tooltip" title="Copy"></i>
                                                        </a>
                                                    </div>
                                                    <label class="d-flex justify-content-between">
                                                        <p class="d-flex align-items-end">
                                                            <span class="h4 mb-0 lh-1">{{ $wallet->rate }}</span>&nbsp;&nbsp;₦ / $
                                                        </p>
                                                        <div class="light-rounded-buttons qr-visibility" data-status="hidden">
                                                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                                <i class="lni-frame-expand d-inline-block mr-2"></i>
                                                                <span>Show QR Code</span>
                                                            </a>
                                                        </div>
                                                    </label>
                                                    <div class="input-items default qr-preview hidden" data-value="">
                                                        <img src="{{ asset('img/wallets/' . $wallet->qrcode) }}" alt="" class="img-fluid field-border active">
                                                    </div>

                                                    @if(!empty($wallet->note))
                                                    <div class="alert single-alerts-message-small alerts-warning-bg fade show mt-3 p-1 br-5" role="alert">
                                                        <div class="alerts-message-small-icon d-flex align-items-center ml-n2 mt-n2">
                                                            <i class="lni-warning size-xs text-dark"></i>
                                                        </div>
                                                        <div class="alerts-message-small-content pl-4 lh-1">
                                                            <small class="note text-white">{!! $wallet->note !!}</small>
                                                        </div>
                                                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <i class="lni-close"></i>
                                                        </button> -->
                                                    </div>
                                                    @endif

                                                    <div class="alert single-alerts-message-small alerts-info-bg fade show mt-3 p-1 br-5" role="alert">
                                                        <div class="alerts-message-small-icon d-flex align-items-center ml-n2 mt-n2">
                                                            <i class="lni-information size-xs"></i>
                                                        </div>
                                                        <div class="alerts-message-small-content pl-4 lh-1">
                                                            <small class="text-white">Send {{ $wallet->currency }} to this wallet address</small>
                                                        </div>
                                                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <i class="lni-close"></i>
                                                        </button> -->
                                                    </div>
                                                    
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="sign-in-form-wrapper form-style-two receipt-container">
                                                <div class="form-input hidden">
                                                    <label>Amount Sent ($)</label>
                                                    <div class="input-items default">
                                                        <input type="text" name="amount" placeholder="0.00">
                                                    </div>
                                                </div>

                                                <div class="form-input hidden mt-4">
                                                    <label>Upload Receipt</label>
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail w-100 field-border">
                                                                <img src="{{ asset('img/ui/receipt.png') }}" class="img-fluid" alt="...">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail lh-0 field-border active"></div>
                                                            <div class="d-flex justify-content-between light-rounded-buttons danger-buttons">
                                                                <span class="btn-default btn-file light-rounded-buttons">
                                                                    <!-- <span class="fileinput-new file-click main-btn light-rounded-two sm-btn d-flex align-items-center px-0 select">
                                                                        <i class="lni-pencil-alt size-xs font-weight-bold mx-auto"></i>
                                                                    </span> -->
                                                                    <!-- <span class="fileinput-exists file-click main-btn light-rounded-two hoverable sm-btn d-flex align-items-center px-0 change">
                                                                        <i class="lni-pencil size-xs font-weight-bold mx-auto"></i>
                                                                    </span> -->
                                                                    <span class="fileinput-new file-click left floated main-btn light-rounded-two xs-btn text-none font-weight-normal">Select Image</span>
                                                                    <span class="fileinput-exists file-click left floated main-btn light-rounded-two hoverable xs-btn text-none font-weight-normal">Change</span>
                                                                    <input name="receipt" type="file" accept="image/*" />
                                                                </span>
                                                                <!-- <span class="regular-icon-buttons d-flex">
                                                                    <ul class="save">
                                                                        <li class="mt-0 success-buttons">
                                                                            <button type="button" class="fileinput-exists regular-icon-light-ten d-flex align-items-center success-two hoverable">
                                                                                <i class="lni-upload size-xs font-weight-bold mx-auto"></i>
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="cancel">
                                                                        <li class="mt-0 danger-buttons ml-2">
                                                                            <a href="#pablo" class="fileinput-exists regular-icon-light-ten d-flex align-items-center danger-two hoverable" data-dismiss="fileinput">
                                                                                <i class="lni-close size-xs font-weight-bold mx-auto"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </span> -->
                                                                <span class="fileinput-exists main-btn danger-two hoverable xs-btn text-none font-weight-normal" data-dismiss="fileinput">Remove</span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="sign-in-form-wrapper form-style-two bank-container">
                                                
                                                <div class="checkout-payment hidden py-0 border-0">
                                                    <!-- <div class="checkout-title">
                                                        <h5 class="title">Select Bank Info</h5>
                                                    </div>  -->
                                                    
                                                    <div class="single-checkout-pro form-style-two no-icon">
                                                        <div class="checkout-radio">
                                                            <div class="pay-top sin-payment">
                                                                <div class="d-flex">
                                                                    <input id="radio_existing" type="radio" checked="checked" value="existing" name="bank_info">
                                                                    <label for="radio_existing" class="flex-fill d-flex align-items-center"> <span></span>Use Existing</label>
                                                                    <!--  -->
                                                                    <input id="radio_new" type="radio" value="new" name="bank_info">
                                                                    <label for="radio_new" class="flex-fill d-flex align-items-center"> <span></span>Enter New</label>
                                                                </div>
                                                                
                                                                <div class="payment-box payment_method_bacs pb-0" data-id="radio_existing">
                                                                    <div class="row">
                                                                        @if((empty(Auth::user()->bank_id) || (Auth::user()->bank_id == 1)) && empty(Auth::user()->account_number) && empty(Auth::user()->account_name))
                                                                            <div class="col-12 text-center">
                                                                                <div class="small alert alert-danger mb-0 mt-15">No existing bank information</div>
                                                                            </div>
                                                                        @elseif(empty(Auth::user()->bank_id) || empty(Auth::user()->account_number) || empty(Auth::user()->account_name))
                                                                            <div class="col-12 text-center">
                                                                                <div class="small alert alert-danger mb-0 mt-15">Incomplete bank information</div>
                                                                            </div>
                                                                        @else
                                                                        <div class="col-4">
                                                                            <div class="form-input mt-15">
                                                                                <label>Bank Icon</label>
                                                                                <div class="input-items">
                                                                                    <img src="{{ asset('img/banks/' . $banks->find(Auth::user()->bank_id)->icon) }}" class="w-100 img-fluid rounded bank-logo border p-1" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input mt-15">
                                                                                <label>Bank Name</label>
                                                                                <div class="input-items active">
                                                                                    <input readonly type="text" value="{{ $banks->find(Auth::user()->bank_id)->name }}" placeholder="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input mt-15">
                                                                                <label>Account Number</label>
                                                                                <div class="input-items active">
                                                                                    <input readonly type="text" value="{{ Auth::user()->account_number }}" placeholder="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input mt-15">
                                                                                <label>Account Name</label>
                                                                                <div class="input-items active">
                                                                                    <input readonly type="text" value="{{ Auth::user()->account_name }}" placeholder="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <!--  -->
                                                                <div class="payment-box payment_method_bacs pb-0" data-id="radio_new">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <div class="form-input mt-15">
                                                                                <label>Bank Icon</label>
                                                                                <div class="input-items">
                                                                                    <img src="{{ asset('img/banks/bank.jpg') }}" class="w-100 img-fluid rounded bank-logo border p-1" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="custom-dropdown form-input mt-15">
                                                                                <label>Bank Name</label>
                                                                                <div class="input-items default" style="height:44px">
                                                                                    <select name="bank_id" class="required text-center" required tabindex="-1">
                                                                                        @foreach($banks as $bank)
                                                                                            @if($bank->id == 1)
                                                                                                <option selected value="{{ $bank->id . '|' . asset('img/banks/' . $bank->icon) }}">{{ $bank->name }}</option>
                                                                                            @else
                                                                                                <option value="{{ $bank->id . '|' . asset('img/banks/' . $bank->icon) }}">{{ $bank->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input mt-15">
                                                                                <label>Account Number</label>
                                                                                <div class="input-items default">
                                                                                    <input type="text" value="" placeholder="Account Number">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input mt-15">
                                                                                <label>Account Name</label>
                                                                                <div class="input-items default">
                                                                                    <input type="text" value="" placeholder="Account Name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- checkout payment -->
                                                
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between regular-icon-buttons">
                                        <ul><li class="mt-0 slick-left hidden"><a href="#" class="regular-icon-light-ten d-flex align-items-center justify-content-center"><i class="lni-arrow-left font-weight-bolder"></i></a></li></ul>
                                        <button type="submit" class="btn btn-success slick-submit hidden">Submit</button>
                                        <span>Please select a currency</span>
                                        <ul><li class="mt-0 slick-right hidden"><a href="#" class="regular-icon-light-ten d-flex align-items-center justify-content-center"><i class="lni-arrow-right font-weight-bolder"></i></a></li></ul>
                                        <!-- <button type="button" class="fileinput-exists regular-icon-light-ten d-flex align-items-center success-two hoverable">
                                            <i class="lni-upload size-xs font-weight-bold mx-auto"></i>
                                        </button> -->
                                        
                                        <!-- <button type="button" class="btn btn-primary back" data-dismiss="modal">Back</button>
                                        <button type="submit" class="btn btn-success create">Sent</button>
                                        <button type="button" class="btn btn-primary next" data-dismiss="modal">Next</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                `);


                sellCrypto.find('.modal').on('show.bs.modal', function() {
                    addCustomScroll(sellCrypto.find('.modal-body'));

                    sellCrypto.find('select').niceSelect();
                    sellCrypto.find('.nice-select.no-search .nice-select-search-box').remove();
                    sellCrypto.find('.nice-select.no-search ul.list').addClass('pt-0');

                    // Change selected currency to colored icon
                    sellCrypto.find('input:radio[name="currency"]').not('[hidden]').change(function() {
                        var icon = $(this).siblings('label').find('img');
                        var iconUrl = icon.attr('src');
                        icon.addClass('active').attr('src', iconUrl.replace('currencies/', 'currencies/x-'));

                        sellCrypto.find('input:radio[name="currency"]').not('[hidden]').not($(this)).each(function() {
                            var xIcon = $(this).siblings('label').find('img');
                            var xIconUrl = xIcon.attr('src');
                            xIcon.removeClass('active').attr('src', xIconUrl.replace('currencies/x-', 'currencies/'))

                        });

                        sellCrypto.find('.slick-right').removeClass('hidden');
                        sellCrypto.find('.modal-footer>span').addClass('hidden');
                            
                    });

                    // Bank Info Checkboxes
                    var checked = sellCrypto.find('.sin-payment input:checked');
                    if (checked) {
                        var id = $(checked).attr('id');
                        $(checked).parents('.sin-payment').find('.payment-box[data-id="'+ id +'"]').fadeIn(900);
                    }
                    sellCrypto.find('.sin-payment input:radio').on('change', function() {
                        sellCrypto.find('.payment-box').fadeOut(100);
                        var id = $(this).attr('id');
                        $(this).parents('.sin-payment').find('.payment-box[data-id="'+ id +'"]').fadeToggle(300);
                    });

                    // Update Logo for Bank Dropdown
                    sellCrypto.find('.sin-payment').find('.nice-select ul li').click(function() {
                        var dataValue = $(this).attr('data-value');
                        var splitDataValue = dataValue.split('|');
                        var url = splitDataValue[1];
                        $(this).parents('.payment-box').find('img.bank-logo').attr('src', url);

                    });
                    

                }).on('shown.bs.modal', function() {

                    sellCrypto.find('.slick-container').slick({
                        infinite: false,
                        adaptiveHeight: true,
                        prevArrow: sellCrypto.find('.slick-left'),
                        nextArrow: sellCrypto.find('.slick-right'),
                        draggable: false,
                        swipe: false,
                        touchMove: false,
                    });

                    // Disable Next Button on Last Slide, Prev Button on First Slide
                    // sellCrypto.find('.slick-container').on('afterChange', function(event, slick, currentSlide, nextSlide){
                    //     $('.slick-arrow').each(function() {
                    //         if($(this).hasClass('slick-disabled')) {
                    //             $(this).addClass('disabled');
                    //         } else {
                    //             $(this).removeClass('disabled');
                    //         }
                    //     });
                    // });

                    // Show Submit Button + Hide Next Button on Last Slide
                    $(this).find('.slick-container').on('afterChange', function(event, slick, currentSlide) {
                        if (slick.$slides.length-1 == currentSlide) {
                            $('.slick-submit').removeClass('hidden');
                            $('.slick-right').parent().addClass('hidden');
                        } else {
                            $('.slick-submit').addClass('hidden');
                            $('.slick-right').parent().removeClass('hidden');
                        }
                    });

                    // Show Left Button from Second Slide
                    $(this).find('.slick-container').on('afterChange', function(event, slick, currentSlide) {
                        if (currentSlide > 0) {
                            $('.slick-left').removeClass('hidden');
                        } else {
                            $('.slick-left').addClass('hidden');
                        }

                        // Remove all hidden items after first change
                        sellCrypto.find('.receipt-container, .bank-container').children().removeClass('hidden');

                        // Scroll to the top after every Change
                        sellCrypto.find('.modal-body .os-viewport').animate({
                            scrollTop: 0,
                        });
                        
                    });
                    
                    
                    // Filter Currency Options by Platform
                    sellCrypto.find('.nice-select li').click(function() {
                        var platform = $(this).attr('data-value');

                        var currencies = JSON.parse(sellCrypto.find('select[name="platform"]').find('option[value='+ platform +']').attr('data-currencies'));

                        sellCrypto.find('.col.currency').addClass('hidden');
                        
                        currencies.forEach(function(currency) {
                            sellCrypto.find('.col.currency.' + currency).removeClass('hidden');
                        });

                        sellCrypto.find('.slick-right').addClass('hidden');
                        sellCrypto.find('.modal-footer>span').removeClass('hidden');

                        sellCrypto.find('input:radio[name="currency"][hidden]').prop('checked', true);

                        sellCrypto.find('input:radio[name="currency"]').not('[hidden]').each(function() {
                            var xIcon = $(this).siblings('label').find('img');
                            var xIconUrl = xIcon.attr('src');
                            xIcon.removeClass('active').attr('src', xIconUrl.replace('currencies/x-', 'currencies/'));

                        });
                    });


                    // Show Wallet from Selected Parameters
                    sellCrypto.find('.slick-container').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                        if (currentSlide == 0 && nextSlide == 1) {
                            var platform = sellCrypto.find('select[name="platform"]').val();
                            var currency = sellCrypto.find('input:radio[name="currency"]:checked').val();

                            if(platform == 'Default') {
                                var wallet = sellCrypto.find('.wallet[default][data-currency="'+ currency +'"]');
                                
                            } else {
                                var wallet = sellCrypto.find('.wallet[data-platform="'+ platform +'"][data-currency="'+ currency +'"]');

                            }

                            if(wallet.length > 0) {

                                if(wallet.hasClass('hidden')) {
                                    
                                    // Unhide wallet, hide others
                                    wallet.removeClass('hidden').siblings().addClass('hidden');
                                    wallet.find('label:first').text(platform + ' ' + currency + ' Wallet Address');

                                    if(wallet.hasClass('event-added')) { // If wallet has been shown before, do nothing

                                    } else { // Add event listeners

                                        // Tooltip
                                        wallet.find('.copy').attr({
                                            'data-toggle': 'tooltip',
                                            'title': 'Copy'
                                        }).tooltip();

                                        // Copy Wallet Address
                                        $('.copy').click(function(e) {
                                            e.preventDefault();

                                            var copyIcon = $(this);
                                            var copyField = copyIcon.parents('.input-items').find('input');

                                            copyField.select();
                                            document.execCommand("copy");

                                            // To remove highlight after copy
                                            var copyAddress = copyField.val();
                                            copyField.val('').val(copyAddress);

                                            copyIcon.removeClass('lni-files lni-flipped').addClass('lni-clipboard');
                                            copyIcon.attr('data-original-title', 'Copied!').tooltip('show');
                                            
                                            copyIcon.on('mouseleave touchend', function() {
                                                $(this).attr('data-original-title', 'Copy').tooltip('hide');
                                                $(this).removeClass('lni-clipboard').addClass('lni-files lni-flipped');
                                            });

                                            setTimeout(function() {
                                                copyIcon.attr('data-original-title', 'Copy').tooltip('hide');
                                                copyIcon.removeClass('lni-clipboard').addClass('lni-files lni-flipped');
                                            },1000);

                                            $(document).on('touchmove', function() {
                                                copyIcon.attr('data-original-title', 'Copy').tooltip('hide');
                                                copyIcon.removeClass('lni-clipboard').addClass('lni-files lni-flipped');
                                            });

                                        });

                                        // Show or Hide Wallet QR Code
                                        wallet.find('.qr-visibility').click(function() {
                                            // var btn = $(this);
                                            var preview = $(this).parents('.wallet').find('.qr-preview');

                                            if($(this).attr('data-status') == 'hidden') {
                                                preview.removeClass('hidden');
                                                $(this).parents('.slick-list').attr('style', 'height: auto');

                                                var btnPos = $(this).position().top;
                                                var previewPos = preview.find('img').position().top

                                                preview.parents('.modal-body .os-viewport').animate({
                                                    scrollTop: btnPos,
                                                });

                                                $(this).attr('data-status', 'visible').find('span').text('Hide QR Code');

                                            } else if($(this).attr('data-status') == 'visible') {
                                                var slickHeight = $(this).parents('.slick-list').height() - preview.height();
                                                preview.addClass('hidden');
                                                $(this).parents('.slick-list').attr('style', 'height: ' + slickHeight + 'px');
                                                $(this).attr('data-status', 'hidden').find('span').text('Show QR Code');

                                            } else {
                                                alert('whats up');
                                            }

                                        });

                                        // Tag wallets that have been shown at least once
                                        wallet.addClass('event-added');
                                    }

                                }

                            } else {
                                sellCrypto.find('.wallet-container > i').removeClass('hidden').siblings().addClass('hidden');

                            }
                            
                            
                            

                        } else if(currentSlide == 1 && nextSlide == 2) {

                            // Adjust Height on Select / Change Receipt
                            $('input:file').change(function() {
                                var initialHeight = $(this).parents('.slick-slide').height();

                                // The node to be monitored
                                var target = $('.fileinput-preview')[0];

                                // Create an observer instance
                                var observer = new MutationObserver(function( mutations, observer ) {
                                    mutations.forEach(function( mutation ) {
                                        var boxHeight = $('.fileinput-preview').parents('.slick-slide').height();
                                        $('.fileinput-preview').parents('.slick-list').attr('style', 'height: '+ boxHeight + 'px');

                                        var btnPos = $('[data-dismiss="fileinput"]').position().top;

                                        $('.fileinput-preview').parents('.modal-body .os-viewport').animate({
                                           scrollTop: btnPos,
                                        });

                                        // Later, you can stop observing
                                        observer.disconnect();

                                        $('[data-dismiss="fileinput"]').click(function() {
                                            $(this).parents('.slick-list').attr('style', 'height: '+ initialHeight + 'px');
                                        });

                                    });

                                    
                                });

                                // Configuration of the observer:
                                var config = { 
                                    childList: true, 
                                };
                                
                                // Pass in the target node, as well as the observer options
                                observer.observe(target, config);

                            });
                            
                            // Adjust Height on Select / Change Bank Info
                            $('input:radio').change(function() {
                                var id = $(this).attr('id');

                                var boxHeight = $('.payment-box[data-id="'+ id +'"]').height();

                                if(boxHeight < 300) {
                                    $(this).parents('.slick-list').attr('style', 'height: '+ (boxHeight + 21) +'px');

                                } else {
                                    $(this).parents('.slick-list').attr('style', 'height: '+ (boxHeight - 5) +'px');
                                }
                            });

                        }


                    });


                    
                    // Jasny File Upload
                    $('.file-click').click(function() {
                        $(this).siblings('input[type="file"]').click();
                    });


                    // On click Submit Button
                    // $('.slick-submit').click(function() {
                    //});

                    $('form#sell').submit(function(e) {
                        e.preventDefault();

                        if(!($(this).find('input[name="amount"]').val())) {
                            toastr.error('Please enter the amount sent');
                            sellCrypto.find('.slick-container').slick('slickGoTo', 2);

                        } else if($(this).find('input:file')[0].files.length == 0) {
                            toastr.error('Please select an image');
                            sellCrypto.find('.slick-container').slick('slickGoTo', 2);

                        } else if($(this).find('input:radio[name="bank_info"]:checked').length < 1) {
                            toastr.error('Please select bank info');

                        } else if($(this).find('input[name="bank_info"]:checked').length > 0) { 
                            toastr.success('Something is checked');

                            alert($('input:radio[name="bank_info"]:checked').val());
                            
                        } else {
                            $(this).find('.slick-left').addClass('hidden');
                            $(this).find('button.slick-submit').attr('disabled', true).prepend(`<i class="lni-spinner lni-spin-effect"></i> `);
                            
                            var formData = new FormData(this);
                            formData.append('wallet_id', sellCrypto.find('.form-input.wallet').not('.hidden').attr('data-id'));

                            // for (var pair of formData.entries()) {
                            //     console.log(pair[0]+ ', ' + pair[1]); 
                            // }

                            $.ajax({
                                url: "{{ route('transaction.store') }}",
                                method: "POST",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success:function(result) { // On Ajax Success

                                    if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                                        // Success Alert Message
                                        toastr.success(result.success);

                                        // Remove modal footer
                                        sellCrypto.find('.modal-footer').remove();

                                        // Repace modal body
                                        sellCrypto.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');
                                        
                                    } else { // If error container not empty [i.e error] 
                                        
                                        // Errors List
                                        var errors = result.error;
                                        var errorList = [];
                                        errors.forEach(function(item) {
                                            errorList.push('<li>'+ item + '</li>');
                                        });

                                        // Error Alert Message
                                        toastr.error('<ul>' + errorList.join('') + '</ul>', 'Please check your input');

                                        // Remove loading animation
                                        sellCrypto.find('button.slick-submit').removeAttr('disabled').children('i.lni-spinner').remove();
                                        sellCrypto.find('.slick-left').removeClass('hidden');
                                    }
                                },
                                error: function(xhr, status, error){ // On Ajax Error

                                    // Error Alert Message
                                    toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                    // Remove loading animation
                                    sellCrypto.find('button.slick-submit').removeAttr('disabled').children('i.lni-spinner').remove();
                                    sellCrypto.find('.slick-left').removeClass('hidden');
                                    
                                }

                            }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                            // $(this).unbind('submit');

                        }



                    });

                }).on('hidden.bs.modal', function() {

                    sellCrypto.find('.slick-container').slick('unslick'); // Destroy Slide. Will be initialized on Modal Show
                    sellCrypto.find('.slick-left').addClass('disabled'); // Disable Prev Button
                    sellCrypto.find('.slick-right').removeClass('disabled'); // Enable Next Button

                    sellCrypto.find('.modal').remove();

                        
                }).modal('show');
            @endif
            
        @else
            toastr.info('Please login to continue');

        @endauth

    });



    

@endsection
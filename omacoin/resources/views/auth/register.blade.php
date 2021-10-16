@extends('layouts.master')

@section('title', 'OmaCoin | Register')

@section('content')

    <section class="call-action-area call-action-three pt-50 mt-20 pl-20 pr-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <section class="signin-area signin-area-five mb-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="sign-in-form-area mt-45 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                                        <h4 class="sign-in-title"><i class="lni-user"></i> {{ __(' Register') }}</h4>
                                        
                                        @if(count($errors) > 0)
                                        <div class="alert single-alerts-message-small border border-danger fade show mt-30" role="alert">
                                            <div class="alerts-message-small-content pl-0">
                                                <p class="text mt-0 text-danger fs-20">Please check your input</p>
                                                <div class="list-style mt-1">
                                                    <div class="list-style-six">
                                                        <ul>
                                                            @foreach($errors->all() as $input_error)
                                                            <li class="mt-0"><i class="lni-cross-circle"></i>  {{ $input_error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="lni-close text-danger font-weight-bolder"></i>
                                            </button>
                                        </div>
                                        @endif

                                        <!-- <p class="text">Morbi et sagittis dui, sed fermentum ante. Pellentesque molestie sit amet dolor vel euismod. </p> -->
                                        
                                        <div class="sign-in-form-wrapper form-style-two">
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-input mt-25">
                                                            <!-- <label>Surname</label> -->
                                                            <div class="input-items default">
                                                                <input type="text" id="surname" name="surname" placeholder="Surname" value="{{ old('surname') }}" required autofocus>
                                                                <i class="lni-user"></i>
                                                            </div>
                                                        </div> <!-- form input -->
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-input mt-25">
                                                            <!-- <label>First Name</label> -->
                                                            <div class="input-items default">
                                                                <input type="text" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required autofocus>
                                                                <i class="lni-user"></i>
                                                            </div>
                                                        </div> <!-- form input -->
                                                    </div>
                                                </div>
                                                
                
                                                <div class="form-input mt-25">
                                                    <!-- <label>Email</label> -->
                                                    <div class="input-items default">
                                                        <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                        <i class="lni-envelope"></i>
                                                    </div>
                                                </div> <!-- form input -->

                                                <div class="form-input mt-25">
                                                    <!-- <label>Phone Number</label> -->
                                                    <div class="input-items default">
                                                        <input id="phone_number" type="text" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                                                        <i class="lni-phone-handset"></i>
                                                    </div>
                                                </div> <!-- form input -->
                
                                                <div class="form-input mt-25">
                                                    <!-- <label>Password</label> -->
                                                    <div class="input-items default">
                                                        <input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password">
                                                        <i class="lni-key"></i>
                                                    </div>
                                                </div> <!-- form input -->

                                                <div class="form-input mt-25">
                                                    <!-- <label>Password</label> -->
                                                    <div class="input-items default">
                                                        <input id="password_confirmation" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                                        <i class="lni-key"></i>
                                                    </div>
                                                </div> <!-- form input -->
                                                
                                                <div class="single-form standard-buttons mt-20">
                                                    <button type="submit" class="main-btn standard-two">{{ __('Register Now') }}</button>
                                                </div> <!-- single-form -->
                                            </form>
                                            <div class="new-user text-center">
                                                <p class="text d-inline">{{ __('Already have an account?') }} </p><a href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </div>
                                        </div> <!-- sign in form wrapper -->
                                    </div>  <!-- sign in form areasign-in-form-area -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- container -->
                    </section>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

@endsection
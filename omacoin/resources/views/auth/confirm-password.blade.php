@extends('layouts.master')

@section('title', 'OmaCoin | Login')

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
                                        <h4 class="sign-in-title"><i class="lni-user"></i>{{ __(' Confirm Password') }}</h4>
                                        
                                        @if(count($errors) > 0)
                                        <div class="alert single-alerts-message-small border border-danger fade show mt-30" role="alert">
                                            <div class="alerts-message-small-content pl-0">
                                                <p class="text mt-0 text-danger fs-20">Please check your input</p>
                                                <div class="list-style mt-1">
                                                    <div class="list-style-six">
                                                        <ul>
                                                            <li class="mt-0"><i class="lni-cross-circle"></i>{{ $errors->first('email') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="lni-close text-danger font-weight-bolder"></i>
                                            </button>
                                        </div>
                                        @endif

                                        <p class="text">{{ __('This is a secure area of the application. Please confirm your password to continue') }}</p>
                                        
                                        <div class="sign-in-form-wrapper form-style-two">
                                            <form method="POST" action="{{ route('password.confirm') }}">
                                                @csrf

                                                <div class="form-input mt-25">
                                                    <!-- <label>Password</label> -->
                                                    <div class="input-items default">
                                                        <input type="password" placeholder="Password" name="password" required autocomplete="current-password">
                                                        <i class="lni-key"></i>
                                                    </div>
                                                </div> <!-- form input -->

                                                <div class="single-form standard-buttons mt-20">
                                                    <button type="submit" class="main-btn standard-two">{{ __('Confirm') }}</button>
                                                </div> <!-- single-form -->
                                            </form>
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
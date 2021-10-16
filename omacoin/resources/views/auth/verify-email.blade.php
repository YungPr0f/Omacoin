@extends('layouts.master')

@section('title', 'OmaCoin | Verify Email')

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
                                        <h4 class="sign-in-title"><i class="lni-user"></i>{{ __(' Verify Email') }}</h4>
                                        
                                        @if(session('status') == 'verification-link-sent')
                                        <div class="alert single-alerts-message-small border border-success fade show mt-30" role="alert">
                                            <div class="alerts-message-small-content pl-0">
                                                <div class="list-style mt-0">
                                                    <div class="list-style-five">
                                                        <ul>
                                                            <li class="mt-0"><i class="lni-check-mark-circle"></i>{{ __('A new verification link has been sent to your email address.') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="lni-close text-success font-weight-bolder"></i>
                                            </button>
                                        </div>
                                        @endif

                                        <p class="text">{{ __('Please verify your email address by clicking on the link we just emailed to you. If you didn\'t receive the email, we will gladly send you another.') }}</p>
                                        
                                        <div class="sign-in-form-wrapper form-style-two">
                                            <form method="POST" action="{{ route('verification.send') }}">
                                                @csrf

                                                <div class="single-form standard-buttons mt-20">
                                                    <button type="submit" class="main-btn standard-two">{{ __('Resend Verification Email') }}</button>
                                                </div> <!-- single-form -->
                                            </form>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <button type="submit" class="d-block mx-auto border border-0 gray-bg mt-3">
                                                    <a class="text-primary">Logout</a>
                                                </button>
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
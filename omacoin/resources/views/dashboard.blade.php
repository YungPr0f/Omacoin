@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
@endsection

@section('title', 'Omacoin | ' . (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ? 'Admin Panel' : 'My Dashboard') )

@section('content')

    @if(Auth::user()->role)
    <section class="portfolio-area portfolio-three pb-100 pt-50 mt-100" style="height:1000px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu-3 text-center">
                        <ul class="nav nav-justified">
                            <li data-filter=".profile" class="nav-item">PROFILE</li>
                            <li data-filter=".transactions" class="nav-item">TRANSACTIONS</li>
                            @if(Auth::user()->role == 'superadmin')
                            <li data-filter=".wallets" class="nav-item">WALLETS</li>
                            <li data-filter=".users" class="nav-item">USERS</li>
                            @endif
                            <!-- <li data-filter=".reviews" class="nav-item">REVIEWS</li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row grid-3">
                <div class="col-12 profile d-none">
                    @include('partials.dashboard._profile')
                </div>
                <div class="col-12 transactions d-none">
                    @include('partials.dashboard._transactions')
                </div>
                @if(Auth::user()->role == 'superadmin')
                <div class="col-12 wallets d-none">
                    @include('partials.dashboard._wallets')
                </div>
                <div class="col-12 users d-none">
                    @include('partials.dashboard._users')
                </div>
                @endif
                <!-- <div class="col-12 reviews d-none">
                    <div class="single-portfolio border border-primary p-4">
                        REVIEWS
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    @else
    <section class="portfolio-area portfolio-three pb-50 pt-50 mt-85" style="height:auto">
        <div class="container text-center">
            <span class="lead text-danger">Your account is disabled! Please contact support.</span>
        </div>
    </section>
    @endif

@endsection

@section('extra_scripts')
    
    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/wallet-address-validator.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('tinymce/jquery.tinymce.min.js')}}" type="text/javascript"></script>

@endsection


@section('custom_script')

    // Display previously active tab or first tab
    function tabHistory() {

        // Save currently active Tab
        $('li[data-filter]').click(function() {
            localStorage.setItem('activeTab', $(this).attr('data-filter'));
        });

        var activeTab = localStorage.getItem('activeTab');

        var firstTab = $('.portfolio-menu-3').find('li').first().attr('data-filter');

        // Display previously active tab if saved
        if($('[data-filter="'+ activeTab +'"]').length && activeTab) {
            var dataFilter = activeTab;

        } else { // Else display first tab
            var dataFilter = firstTab;

        }

        $('.grid-3').isotope({
            filter: dataFilter
        }).children().removeClass('d-none');

        $('.grid-3 [data-toggle="collapse"]').click(function () {
            var id = $(this).attr('href');

            $(id).on('shown.bs.collapse hidden.bs.collapse', function() {
                $('.grid-3').isotope('layout');
                
            });
        });

        $('[data-filter="'+ dataFilter +'"]').addClass('active').siblings().removeClass('active');

    }
    tabHistory();
    
    // Get currently active tab
    $('.grid-3').on('arrangeComplete', function (event, filteredItems) {
        var filteredItem = $(filteredItems[0]['element']).attr('class').replace('col-12 ', '');

        if(filteredItem == 'wallets') {
            firstShowNote();

        } else {
            

        }

        // If responsive table exists in active tab
        if($(filteredItems[0]['element']).find('.table-responsive').length > 0) {
            $('.grid-3').isotope('layout');
        }

    });

    // Remove Portfolio Area Fixed Height
    $('.grid-3').isotope('on', 'layoutComplete', function() {
        $('.portfolio-area').removeAttr('style');
    });
    
    // Adjust Accordion to fit Bank Name Dropdown
    $(document).on('click.nice-select', '.nice-select.bank', function() {

        //Adjust Accordion Height
        function adjustHeight() {

            var list = $('.nice-select.bank');
            var container = list.parents('.collapse');
            var card = container.children('.card-body');

            var listBottom = list.offset().top + list.height();
            var containerBottom = container.offset().top + container.height();
            var cardBottom = card.offset().top + card.height();

            if(list.hasClass('open')) {

                var diff = containerBottom - cardBottom;
                
                if(diff > 30) {
                    container.animate({
                        height: container.height() - (diff - 32)

                    }, 100, function() {
                        $('.grid-3').isotope('layout');

                    });
                }

            } else {

                var diff = containerBottom - listBottom;

                if(diff < 240) {
                    container.animate({
                        height: container.height() + (240 - diff)

                    }, 100, function() {
                        $('.grid-3').isotope('layout');

                    });
                    
                }
            } 
        }

        adjustHeight();
        

    });



    /////////////////// PROFILE - START ///////////////////

    @include('partials.dashboard.scripts._profile')

    /////////////////// PROFILE - END ///////////////////


    @if(Auth::user()->role == 'superadmin')
    /////////////////// WALLETS - START ///////////////////

    @include('partials.dashboard.scripts._wallets')

    /////////////////// WALLETS - END ///////////////////
    @endif


    /////////////////// TRANSACTIONS - START ///////////////////

    @include('partials.dashboard.scripts._transactions')

    /////////////////// TRANSACTIONS - END ///////////////////


    @if(Auth::user()->role == 'superadmin')
    /////////////////// USERS - START ///////////////////

    @include('partials.dashboard.scripts._users')

    /////////////////// USERS - END ///////////////////
    @endif


@endsection
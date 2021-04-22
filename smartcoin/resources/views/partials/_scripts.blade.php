<!--====== jquery js ======-->
<script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>

<!--====== Bootstrap js ======-->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>

<!--====== Slick js ======-->
<script src="{{ asset('js/slick.min.js') }}"></script>

<!--====== Isotope js ======-->
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>

<!--====== Images Loaded js ======-->
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>

<!--====== Magnific Popup js ======-->
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>

<!--====== Appear js ======-->
<script src="{{ asset('js/jquery.appear.min.js') }}"></script>

<!--====== Counter Up js ======-->
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>

<!--====== Validator js ======-->
<script src="{{ asset('js/validator.min.js') }}"></script>

<!--====== Nice Select js ======-->
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>

<!--====== CountDown js ======-->
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>

<!--====== Main js ======-->
<script src="{{ asset('js/main.js') }}"></script>

<!-- <script src="{{ asset('js/custom.js') }}"></script> -->

<script src="{{ asset('js/toastr.min.js') }}"></script>

@yield('extra_scripts')

<script>

    $('[href="#side-menu-left"], [href="#close"]').click(function() {
        // alert('james');
        $('.navbar-area').toggleClass('fixed-top');
    });

        //===== Back to top

    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if($(this).scrollTop() > 900){
            $('.back-to-top').fadeIn(200)
        } else{
            $('.back-to-top').fadeOut(200)
        }
    });
    
    
    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });
    
    
    //===== 

    var countx = 1;

    function priceFlash() {

        if(countx == 1) {
            $('.rates').html('ESDT - $450');
            countx = 2;

        } else if(countx == 2) {
            $('.rates').html('&nbsp; BTC - $465');
            countx = 1;

        }

    }
    setInterval(priceFlash, 1500);

    $('.toast').toast();

    $('form[method="POST"]').submit(function() {
        // e.preventDefault();
        // alert('james');
        $(this).find('button[type="submit"]').prepend(`<i class="lni-spinner lni-spin-effect"></i> `).attr('disabled', true);
    });

    @yield('custom_script')

</script>
<!--====== jquery js ======-->
<script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
<!-- <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script> -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<!--====== Bootstrap js ======-->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>

<!--====== Slick js ======-->
<script src="{{ asset('js/slick.min.js') }}"></script>

<!--====== Isotope js ======-->
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>

<!--====== Images Loaded js ======-->
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>

<!--====== Scrolling Nav js ======-->
<script src="{{ asset('js/jquery.easing.min.js') }}"></script>
<!-- <script src="{{ asset('js/scrolling-nav.js') }}"></script> -->

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

<!--====== Custom Scrollbar js ======-->
<script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>

<!--====== Loading Overlay js ======-->
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>

<!--====== Main js ======-->
<script src="{{ asset('js/main.js') }}"></script>

<!-- <script src="{{ asset('js/custom.js') }}"></script> -->


<script src="{{ asset('js/toastr.min.js') }}"></script>


<!-- I don't understand why I need this here for tooltips / popper to work -->
<!-- <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script> -->
<!--  -->

@yield('extra_scripts')

<script>

    // Preloader
    $(window).on('load', function() {
        // Wallets tab
        if(localStorage.getItem('activeTab') == '.wallets') {
            $('.wallets-container').find('.preloader').delay(1000).fadeOut(500);
        }
        
    });

    //===== Sidebar
    $('[href="#side-menu-left"], [href="#close"], .overlay-left').click(function() {
        $('.navbar-area').toggleClass('fixed-top');
        $('.call-action-area').toggleClass('mt-70');
    });

    
    //===== Back to top
    // Show or hide the sticky footer button // Added to overlay scrollbar callback
    // $(window).on('scroll', function(event) {
    //     if($(this).scrollTop() > 900){
    //         $('.back-to-top').fadeIn(200)
    //     } else{
    //         $('.back-to-top').fadeOut(200)
    //     }
    // });
    
    
    //Animate the scroll to top // Added to overlay scrollbar callback
    // $('.back-to-top').on('click', function(event) {
    //     event.preventDefault();
        
    //     $('html, body').animate({
    //         scrollTop: 0,
    //     }, 1500);
    // });
    
    
    //===== 

    var countx = 1;

    function priceFlash() {

        if(countx == 1) {
            $('.rates').html('USDT');
            countx = 2;

        } else if(countx == 2) {
            $('.rates').html('BTC');
            countx = 3;

        } else if(countx == 3) {
            $('.rates').html('ETH');
            countx = 4;

        } else if(countx == 4) {
            $('.rates').html('DOGE');
            countx = 1;

        }

    }
    setInterval(priceFlash, 1500);

    // $('.toast').toast();

    // Jasny File Upload
    $('.file-click').click(function() {
        $(this).siblings('input[type="file"]').click();
    });


    // Loading Icon on Submit
    $('form[method="POST"]').submit(function() {
        $(this).find('button[type="submit"]').prepend(`<i class="lni-spinner lni-spin-effect"></i> `).attr('disabled', true);
    });


    // Ajax CSRF Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Extract CSRF Token
        }
    });


    // Toastr JS for Alerts
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }


    // WhatsApp Chat
    $('.whatsapp-chat').click(function(e) {
        e.preventDefault();
        var countryCode = '234';
        var phoneNumber = '8081273542';
        var text = '%2AOmacoin%2A+Website%0D%0A%0D%0AName%3A+%0D%0A%0D%0AMessage%3A+';
        window.open('https://wa.me/' + countryCode + phoneNumber + '?' + 'text=' + text, '_blank');
    });


    // Alert Messages
    @if(Session::has('error'))
        toastr.error(`{{ Session::get('error') }}`);
    @endif

    @if(Session::has('success'))
        toastr.success(`{{ Session::get('success') }}`);
    @endif

    @if(Session::has('info'))
        toastr.info(`{{ Session::get('info') }}`);
    @endif


    // Countdown Timer
    function countdownTimer(counter, time) {

        // Set the date we're counting down to
        var countDownDate = new Date(new Date().getTime() + time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for minutes and seconds
            // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            if(hours < 10) {
                hours = '0' + hours;
            }

            if(minutes < 10) {
                minutes = '0' + minutes;
            }
            
            if(seconds < 10) {
                seconds = '0' + seconds;
            }
                
            // Output the result in counter
            if(hours > 0) {
                counter.html(hours + ":" + minutes + ":" + seconds);
            } else {
                counter.html(minutes + ":" + seconds);
            }
            
            
                
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);

                counter.parents('.light-rounded-buttons').addClass('hidden').siblings().removeClass('hidden');
                
                counter.html("EXPIRED");
            }

        }, 1000);

    }


    $('span.countdown-timer').each(function() {
        var counter = $(this);
        // var hh = counter.attr('data-hh'); // time in hours
        // hh = hh || 0; // Cast undefined to zero

        var mm = counter.attr('data-mm'); // time in minutes
        mm = mm || 0; // Cast undefined to zero

        var ss = counter.attr('data-ss'); // time in seconds
        ss = ss || 0; //Cast undefined to zero

        // var time = hh * 1440000 + mm * 60000 + ss * 1000;
        var time = mm * 60000 + ss * 1000;

        countdownTimer(counter, time);

    });


    // $("body, textarea").overlayScrollbars({
    //     // className : "os-theme-dark",
    //     // resize : "both",
    //     // sizeAutoCapable : true,
    //     // paddingAbsolute : true,
    //     // scrollbars : {
    //         // clickScrolling : true
    //     // },
    //     textarea : {
    //         // dynWidth       : false,
    //         dynHeight      : true,
    //         inheritedAttrs : ["style", "class"]
    //     }
    // });

    // For Nav page scroll
    var scrollLink = $('.page-scroll');

    function addCustomScroll(selector) {
        $(selector).overlayScrollbars({
            // resize: "none",
            // sizeAutoCapable: false,
            autoUpdate: true,
            updateOnLoad: ["p"],
            paddingAbsolute : true,
            scrollbars : {
                clickScrolling : true,
                visibility : "auto",
                autoHide : "move",
                autoHideDelay : 400,
            },
            callbacks : {
                onInitialized : function() {
                    
                    if($(this.getElements('target')).prop('tagName') == 'BODY') {
                        var bodyInstance = this;
                        
                        // Back to top
                        $('.back-to-top').on('click', function(event) {
                            event.preventDefault();
                            bodyInstance.scroll({ y : "0%" }, 1000);
                        });



                        $(function() {

                            $('a.page-scroll[href*="#"]:not([href="#"])').on('click', function () {
                                
                                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                                    var target = $(this.hash);
                                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                                    if (target.length) {
                                        // $('html, body').animate({
                                        //     scrollTop: (target.offset().top -70)
                                        // }, 1200, "easeInOutExpo");
                                        bodyInstance.scroll({ y : target.offset().top -70 }, 1200, "easeInOutExpo");
                                        return false;
                                    }
                                }
                            });

                        });

                        

                    };


                    
                },
                onScroll : function() {
                    
                    if($(this.getElements('target')).prop('tagName') == 'BODY') {

                        // Back to top
                        if(this.scroll().position.y > 900){
                            $('.back-to-top').fadeIn(200)
                        } else{
                            $('.back-to-top').fadeOut(200)
                        }


                        // Nav page scroll
                        // var scrollbarLocation = $(this).scrollTop();
                        var scrollbarLocation = this.scroll().position.y;

                        scrollLink.each(function() {

                            var sectionOffset = $(this.hash).offset().top + 73;

                            if ( sectionOffset <= scrollbarLocation ) {
                                $(this).addClass('active');
                                $(this).parent().siblings().children().removeClass('active');

                                // $(this).parent().addClass('active');
                                // $(this).parent().siblings().removeClass('active');
                            }
                        });

                    }
                    


                    

                    
                }
            }
        });
    }

    addCustomScroll('body, .table-responsive, .display-text');
    
    
    // Fix Tinymce Link Dialog Not Working
    $(document).on('focusin', function(e) {
        var target = $(e.target);
        if (target.closest(".mce-window").length || target.closest(".tox-dialog").length) {
            e.stopImmediatePropagation();
            target = null;
        }
    });


    // Capitalize First Letter
    function capitalise(item) {
        var result = item.charAt(0).toUpperCase() + item.slice(1);
        return result;

    }

    
    
    // Js equivalent of double curly braces
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }


    // Generate random password
    function generatePassword() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        
        return retVal;
    }


    // Scrolling Nav
    //===== Section Menu Active

    // var scrollLink = $('.page-scroll');
    
    // // Active link switching
    // $(window).scroll(function() {
    //     alert('scroll');
        
    //     var scrollbarLocation = $(this).scrollTop();

    //     scrollLink.each(function() {

    //         var sectionOffset = $(this.hash).offset().top - 73;

    //         if ( sectionOffset <= scrollbarLocation ) {
    //             $(this).addClass('active');
    //             $(this).parent().siblings().children().removeClass('active');

    //             // $(this).parent().addClass('active');
    //             // $(this).parent().siblings().removeClass('active');
    //         }
    //     });
    // });

    @yield('custom_script')


    // $(document).ready(function() {
    //     // Initialize Bootstrap Tooltips
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
</script>
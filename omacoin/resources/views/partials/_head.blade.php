    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <!--====== Bootstrap css ======-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!--====== Line Icons css ======-->
        <link rel="stylesheet" href="{{ asset('css/LineIcons.css') }}">

        <!--====== Magnific Popup css ======-->
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

        <!--====== Slick css ======-->
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">

        <!--====== Nice Select css ======-->
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">

        <!--====== Custom Scrollbar css ======-->
        <link type="text/css" href="{{ asset('css/OverlayScrollbars.min.css') }}" rel="stylesheet"/>

        <!--====== Default css ======-->
        <link rel="stylesheet" href="{{ asset('css/default.css') }}">

        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">


        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">


        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="{{ asset('img/logo/OmaCoin.png') }}" type="image/png">

        <!-- Preloaded Images -->
        @foreach(currencies() as $currency)
        <link rel="preload" as="image" href="{{ asset('img/currencies/' . $currency['icon']) }}">
        <link rel="preload" as="image" href="{{ asset('img/currencies/x-' . $currency['icon']) }}">
        @endforeach


        @yield('extra_links')

        <title>@yield('title')</title>

    </head>
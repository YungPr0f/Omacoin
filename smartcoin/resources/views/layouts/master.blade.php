<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials._head')

<body>
    
    @include('partials._navbar')

    @include('partials._sidebar')

    @yield('content')

    @include('partials._footer')

    @include('partials._scripts')

</body>
</html>
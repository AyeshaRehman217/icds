<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl-carousel.css')}}">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front/images/favicon.ico')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
    <link href="{{asset('front/toastr/toastr.min.css')}}" rel="stylesheet">
    @stack('head-scripts')
</head>
<body>
@include('front.layouts.header')
@yield('content')
@include('front.layouts.subscribe')
@include('front.layouts.footer')

<!-- jQuery -->
<script src="{{asset('front/js/jquery-2.1.0.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('front/js/popper.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('front/js/scrollreveal.min.js')}}"></script>
<script src="{{asset('front/js/waypoints.min.js')}}"></script>
<script src="{{asset('front/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('front/js/imgfix.min.js')}}"></script>
<script src="{{asset('front/js/mixitup.js')}}"></script>
<script src="{{asset('front/js/accordions.js')}}"></script>
<script src="{{asset('front/js/owl-carousel.js')}}"></script>

<!-- Global Init -->
<script src="{{asset('front/js/custom.js')}}"></script>
<script src="{{asset('front/js/custom-d.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
<script src="{{asset('front/toastr/toastr.min.js')}}"></script>
<script src="{{asset('front/js/scripts.js')}}"></script>


@stack('footer-scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>{{ $title ?? '' }} {{ env('APP_NAME') }}</title>

    <link
        href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.bxslider.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.fancybox.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/flexslider.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/swiper.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/media.css">

</head>

<body>
    <!-- Header - start -->
    <header class="header">

        @include('home.partials.topbar')

    </header>
    <!-- Header - end -->


    <!-- Main Content - start -->
    <main>
        @yield('content')
    </main>
    <!-- Main Content - end -->


    @include('home.partials.footer')


    <!-- jQuery plugins/scripts - start -->
    <script src="{{ asset('assets') }}/js/jquery-1.11.2.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.bxslider.min.js"></script>
    <script src="{{ asset('assets') }}/js/fancybox/fancybox.js"></script>
    <script src="{{ asset('assets') }}/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.flexslider-min.js"></script>
    <script src="{{ asset('assets') }}/js/swiper.jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets') }}/js/progressbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('assets') }}/js/chosen.jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/jQuery.Brazzers-Carousel.js"></script>
    <script src="{{ asset('assets') }}/js/plugins.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
    <script src="{{ asset('assets') }}/js/gmap.js"></script>
    <!-- jQuery plugins/scripts - end -->
    @stack('script')
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title id="theTitle">Job24</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="{{ asset('js/bootstrap.js') }}"></script>


    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- video js  -->
    <!-- <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/Advanced-Pricing-Cards.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/beautiful-info-alert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/Card-Deck.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/Effective-Pricing-Cards.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/Model-Card-Style-1.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('all_assets/home_assets/css/untitled.css') }}">


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script> -->
    
</head>
<!-- <body> -->
<body id="page-top">
    
    <div id="wrapper">
    
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            
                <div id="app" style="font-size:12px;">
                    @yield('content')
                </div>
                    
                
            </div>
            <div id="hideForLongPages" style="height:600px;"></div>
            <footer class="bg-dark sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span style="color:white;">Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div>
    
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>  
    
    <script src="{{ URL::asset('all_assets/home_assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('all_assets/home_assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('all_assets/home_assets/js/Advanced-Pricing-Cards.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ URL::asset('all_assets/home_assets/js/theme.js') }}"></script>

    <script>
        // $('.container-fluid .nav-item .btn.active').removeClass('active');
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({
                placement : 'top',
                html: true
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script> -->
</body>
</html>


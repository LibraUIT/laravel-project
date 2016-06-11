<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$heading_title}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset($site_favicon)}}" sizes="16x16">

        <meta name="description" content="{{$description}}">
        <meta name="keywords" content="{{$tagline}}">
        <meta name="author" content="Quan Nguyen">

        <!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Karla:700,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>

        <!-- fontawesome -->
		<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- bootstrap -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" />

        <!-- uikit -->
        <link rel="stylesheet" href="{{ asset('css/uikit.min.css')}}" />

        <!-- animate -->
        <link rel="stylesheet" href="{{ asset('css/animate.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/datepicker.css')}}" />
        <!-- Owl carousel 2 css -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}">
        <!-- rev slider -->
        <link rel="stylesheet" href="{{ asset('css/settings.css')}}" />
        <!-- lightslider -->
        <link rel="stylesheet" href="{{ asset('css/lightslider.css')}}">
        <!-- Theme -->
        <link rel="stylesheet" href="{{ asset('css/reset.css')}}">

        <!-- custom css -->
		<link rel="stylesheet" href="{{ asset('css/style.css')}}" />
        <!-- responsive -->
		<link rel="stylesheet" href="{{ asset('css/responsive.css')}}" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- This Template Is Fully Coded By Aftab Zaman from swiftconcept.com -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jquery library -->
        <script src="{{ asset('js/jquery-1.11.2.min.js')}}"></script>

    </head>
    <body id="home_one">

        {!! app('App\Http\Controllers\ModulesController')->loader() !!}

        {!! $header !!}
        @yield('main_content')

        {!! $footer !!}

        <!-- bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
		<!-- rev slider -->
        <script src="{{ asset('js/jquery.themepunch.plugins.min.js')}}"></script>
        <script src="{{ asset('js/jquery.themepunch.revolution.js')}}"></script>
        <script src="{{ asset('js/rs.home.js')}}"></script>
        <!-- uikit -->
        <script src="{{ asset('js/uikit.min.js')}}"></script>
        <!-- easing -->
		<script src="{{ asset('js/jquery.easing.1.3.min.js')}}"></script>
        <script src="{{ asset('js/datepicker.js')}}"></script>
        <!-- scroll up -->
        <script src="{{ asset('js/jquery.scrollUp.min.js')}}"></script>
        <!-- owlcarousel -->
        <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
        <!-- lightslider -->
        <script src="{{ asset('js/lightslider.js')}}"></script>

        <!-- wow Animation -->
        <script src="{{ asset('js/wow.min.js')}}"></script>
        <!--Activating WOW Animation only for modern browser-->
        <!--[if !IE]><!-->
        <script type="text/javascript">new WOW().init();</script>
        <!--<![endif]-->

        <!--Oh Yes, IE 9+ Supports animation, lets activate for IE 9+-->
        <!--[if gte IE 9]>
            <script type="text/javascript">new WOW().init();</script>
        <![endif]-->

        <!--Opacity & Other IE fix for older browser-->
        <!--[if lte IE 8]>
            <script type="text/javascript" src="js/ie-opacity-polyfill.js"></script>
        <![endif]-->
        <!-- React js -->
        <script src="{{ asset('reactjs/react.js')}}"></script>
        <script src="{{ asset('reactjs/react-dom.js')}}"></script>
        <!-- my js -->
        <script src="{{ asset('js/main.js')}}"></script>
        <script src="{{ asset('js/pinterest.js')}}"></script>
        <!-- chat -->
        <script src="{{ asset('js/chat.js')}}"></script>


    </body>
</html>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
       ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto:300,400,500,700|Rubik:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/dark.css')}}" type="text/css" />

    <!-- Real Estate Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{asset('theme/demos/real-estate/real-estate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/demos/real-estate/css/font-icons.css')}}" type="text/css" />
    <!-- / -->

    <link rel="stylesheet" href="{{asset('theme/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/magnific-popup.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('theme/demos/real-estate/fonts.css')}}" type="text/css" />

    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/components/bs-select.css')}}" type="text/css" />

    <!-- Bootstrap Switch CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/components/bs-switches.css')}}" type="text/css" />

    <!-- Range Slider CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/components/ion.rangeslider.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{asset('theme/css/custom.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{asset('theme/css/colors.php?color=2C3E50')}}" type="text/css" />
    <!-- Document Title
    ============================================= -->
    <title>{{config('app.name')}}</title>
    @yield('css')
</head>

<body class="stretched side-push-panel">
@include('sweetalert::alert')
<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Top Bar
    ============================================= -->
    <div id="top-bar" class="transparent-topbar border-bottom-0">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-12 col-md-auto"></div>
            </div>

        </div>
    </div><!-- #top-bar end -->

    <!-- Header
    ============================================= -->
    <header id="header" class="transparent-header dark header-size-md" data-sticky-shrink="false">
        <div id="header-wrap">
            <div class="container">
                <div class="header-row">

                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="{{route('website')}}" data-dark-logo="{{asset('theme/demos/real-estate/images/logo.png')}}" class="standard-logo"><img src="{{asset('theme/demos/real-estate/images/logo.png')}}" alt="Canvas Logo"></a>
                        <a href="{{route('website')}}" data-dark-logo="{{asset('theme/demos/real-estate/images/logo@2x.png')}}" class="retina-logo"><img src="{{asset('theme/demos/real-estate/images/logo@2x.png')}}" alt="Canvas Logo"></a>
                    </div><!-- #logo end -->

                    <div id="primary-menu-trigger">
                        <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav class="primary-menu with-arrows">
                        <ul class="menu-container">
                            <li class="menu-item current"><a class="menu-link" href="{{route('website')}}"><div>Home</div></a></li>
                            <li class="menu-item"><a class="menu-link" href="#"><div>Category</div></a>
                                <ul class="sub-menu-container">
                                    @foreach(category() as $category)
                                        <li class="menu-item"><a class="menu-link" href="{{route('category.search',$category)}}"><div>{{ucfirst($category)}}</div></a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item"><a class="menu-link" href="#"><div>Properties</div></a>
                                <ul class="sub-menu-container">
                                    @foreach(realState() as $itemName => $itemValue)
                                        <li class="menu-item"><a class="menu-link" href="{{route('type.search',$itemValue)}}"><div>{{$itemName}}</div></a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item"><a class="menu-link" href="{{route('realestate')}}"><div>Listing</div></a></li>
                            <li class="menu-item"><a class="menu-link" href="{{route('about')}}"><div>About Us</div></a></li>
                            <li class="menu-item"><a class="menu-link" href="{{route('contact')}}"><div>Contact</div></a></li>
                            <li class="menu-item"><a class="menu-link" href="#"><div>Account</div></a>
                                <ul class="sub-menu-container">
                                    @auth
                                        <li class="menu-item"><a class="menu-link" href="{{route('account')}}"><div>Profile</div></a></li>
                                    @unless(auth()->user()->role == CUSTOMER)
                                        <li class="menu-item"><a class="menu-link" href="{{route('dashboard')}}"><div>Dashboard</div></a></li>
                                    @endunless
                                        <li class="menu-item"><a class="menu-link" href="javascript:void(0)" onclick="document.getElementById('__logout').submit()"><div>Logout</div></a></li>
                                    @endauth
                                    @guest
                                        <li class="menu-item"><a class="menu-link" href="{{route('login')}}"><div>Login</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="{{route('register')}}"><div>Register</div></a></li>
                                    @endguest
                                </ul>
                            </li>
                        </ul>
                        @auth
                            <form style="display: none" action="{{route('logout')}}" method="post" id="__logout"> @csrf </form>
                        @endauth
                    </nav><!-- #primary-menu end -->

                </div>
            </div>
        </div>
        <div class="header-wrap-clone"></div>
    </header><!-- #header end -->

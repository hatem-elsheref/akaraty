<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Hatem Mohamed Elsheref" />

    <!-- Stylesheets
    ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Istok+Web:400,700&display=swap" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/magnific-popup.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/custom.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('theme/css/colors.php?color=2C3E50')}}" type="text/css" />
    <!-- Hosting Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{asset('theme/demos/real-estate/fonts.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>{{config('general.application_name')}}</title>

</head>

<body class="stretched">
@include('sweetalert::alert')
<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <section id="content">
        <div class="content-wrap" style="padding-top: 15px">
            <div class="container clearfix">

                <div class="tabs mx-auto mb-0 clearfix" id="tab-login-register" style="max-width: 500px;margin-top: 150px">
                    <div class="tab-container">

                        <div class="tab-content" id="tab-login">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <form id="login-form" name="login-form" class="mb-0" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h3>Login to your Account</h3>

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label for="login-form-username">Email:</label>
                                                <input type="email" id="login-form-username" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus />
                                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="login-form-password">Password:</label>
                                                <input type="password" id="login-form-password" name="password"  class="form-control  @error('password') is-invalid @enderror"  required autocomplete="current-password" />
                                                @error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                            </div>

                                            <div class="col-12 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group">
                                                <button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>

                                                @if (Route::has('password.request'))
                                                    <a class="float-right" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                                <a class="float-right" href="{{ route('register') }}">Register </a>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </section><!-- #content end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script src="{{asset('theme/js/plugins.min.js')}}"></script>
<!-- Footer Scripts
============================================= -->
<script src="{{asset('theme/js/functions.js')}}"></script>
</body>
</html>

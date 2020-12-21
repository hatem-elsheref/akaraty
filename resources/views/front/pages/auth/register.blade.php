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
                                    <h3>Register for an Account</h3>
                                    @foreach($errors->all() as $error)
                                        <p>                                        {{$error}}
                                        </p>
                                    @endforeach
                                    <form id="register-form" name="register-form" class="row mb-0" action="{{route('register')}}" method="post">
                                        @csrf
                                        <div class="col-12 form-group">
                                            <label for="register-form-name">Name:</label>
                                            <input type="text" id="register-form-name" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"   />
                                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-email">Email Address:</label>
                                            <input type="text" id="register-form-email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"  />
                                            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="register-form-phone">Phone Number:</label>
                                            <input type="text" id="register-form-phone" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror"  />
                                            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>


                                        <div class="col-12 form-group">
                                            <label for="register-form-password">Choose Password:</label>
                                            <input type="password" id="register-form-password" name="password" value="" class="form-control  @error('password') is-invalid @enderror"  autocomplete="new-password" />
                                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-repassword">Re-enter Password:</label>
                                            <input type="password" id="register-form-repassword" name="password_confirmation"  autocomplete="new-password" class="form-control" />
                                        </div>
                                        <div class="col-12 form-group">
                                            <button class="button button-3d button-black m-0" id="register-form-submit" name="register-form-submit" value="register">Save</button>
                                            <a class="float-right" href="{{ route('login') }}">Login </a>

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

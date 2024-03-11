{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">--}}
{{--    <title>Login | Accent Astrology</title>--}}
{{--    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>--}}
{{--    <!-- BEGIN GLOBAL MANDATORY STYLES -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">--}}
{{--    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('backend/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <!-- END GLOBAL MANDATORY STYLES -->--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">--}}
{{--</head>--}}
{{--<body class="form">--}}


{{--<div class="form-container outer">--}}
{{--    <div class="form-form">--}}
{{--        <div class="form-form-wrap">--}}
{{--            <div class="form-container">--}}
{{--                <div class="form-content">--}}

{{--                    <h1 class="">Sign In</h1>--}}
{{--                    <p class="">Log in to your account to continue.</p>--}}
{{--                    <form method="POST" class="text-left" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form">--}}

{{--                            <div id="username-field" class="field-wrapper input">--}}
{{--                                <label for="username">USERNAME</label>--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
{{--                                <input id="email" name="email" type="text" class="form-control" placeholder="Email">--}}
{{--                                @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div id="password-field" class="field-wrapper input mb-2">--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <label for="password">PASSWORD</label>--}}
{{--                                    @if (Route::has('password.request'))--}}
{{--                                        <a class="forgot-pass-link" href="{{ route('password.request') }}">--}}
{{--                                            {{ __('Forgot Your Password?') }}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>--}}
{{--                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>--}}
{{--                                @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="d-sm-flex justify-content-between">--}}
{{--                                <div class="field-wrapper">--}}
{{--                                    <button type="submit" class="btn btn-primary" value="">Log In</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                        </div>--}}
{{--                    </form>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->--}}
{{--<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>--}}

{{--<!-- END GLOBAL MANDATORY SCRIPTS -->--}}
{{--<script src="{{asset('backend/assets/js/authentication/form-2.js')}}"></script>--}}

{{--</body>--}}

{{--</html>--}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Proxima Astrology | Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
</head>
<body class="form">


<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Log In to <a href="https://proximaastrology.com/"><span class="brand-name">Proxima</span></a></h1>
{{--                    <p class="signup-link">New Here? <a href="auth_register.html">Create an account</a></p>--}}
                    <form method="POST" class="text-left" action="{{ route('login') }}">@csrf


                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="email" name="email" type="text"  class="form-control @error('email') is-invalid @enderror"" placeholder="Username">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password"  class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="field-wrapper text-center">

                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Log In</button>
                                </div>

                            </div>

                            <div class="field-wrapper text-center mt-3">
                                <div class="row">
                                    <div class="col-md-12"> <a class="btn btn-lg btn-google btn-block text-uppercase btn-outline" href="{{ url('auth/google') }}"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google</a> </div>
                                </div>

                            </div>

                            <div class="field-wrapper text-center keep-logged-in">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span>Keep me logged in
                                    </label>
                                </div>
                            </div>
                            <div class="field-wrapper ">
                                <a href="{{route('password.request',['token' => @csrf_token()])}}" class="forgot-pass-link">Forgot Password?</a>
                                {{--                                <a href="{{route('password.request',['token' => @csrf_token()])}}" class="forgot-pass-link">Forgot Password?</a>--}}
                            </div>

                            <div class="field-wrapper">
                                <a href="{{route('register')}}" class="forgot-pass-link">Sign Up</a>
{{--                                <a href="{{route('password.request',['token' => @csrf_token()])}}" class="forgot-pass-link">Forgot Password?</a>--}}
                            </div>

                        </div>
                    </form>
{{--                    <p class="terms-conditions">Developed By Nerdware Innovation</p>--}}

                </div>
            </div>
        </div>
    </div>
    <div class="form-image" >
        <div class="l-image" style="background-image: url({{asset('welcome_bg.jpg')}});background-repeat: no-repeat;
                background-size: 100% 100%;" >
            <img class="align-content-center center" style="margin-left: 15%;margin-top: 10%;"  src="{{asset('black_logo.png')}}" height="500px" width="500px">
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('backend/assets/js/authentication/form-1.js')}}"></script>

</body>

</html>


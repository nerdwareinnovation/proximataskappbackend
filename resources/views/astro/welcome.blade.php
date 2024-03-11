<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body background="{{asset('backend/assets/img/bg.jpeg')}}">
        <div class="flex-center position-ref full-height">

            <div class="content">
                <img src="{{asset('backend/assets/img/main.png')}}" class="img img-responsive" style="height: 500px; width: 500px;">
                <br>
                @auth
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ url('admin/dashboard') }}">
                    @elseif(auth()->user()->role_id == 3)
                        <a href="{{ url('astrologer/dashboard') }}">
                            @elseif(auth()->user()->role_id == 4)
                                <a href="{{ url('moderator/dashboard') }}">
                                    @endif
                        <button class="btn btn-lg" style="background: #f79c4d; width: 25%;">Home</button>
                    </a>

                @else

                    <a href="{{ route('login') }}"><button class="btn btn-lg" style="background: #f79c4d; width: 25%;">Login</button></a>

                @endauth

            </div>
        </div>
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                font-size: 72px;
            }

            @-webkit-keyframes fadeUp { from { transform: translateY(200%); opacity: 0; } to { transform: none; opacity: 1; } }
            @-moz-keyframes fadeUp { from { transform: translateY(200%); opacity: 0; } to { transform: none; opacity: 1; } }
            @keyframes fadeUp { from { transform: translateY(200%); opacity: 0; } to { transform: none; opacity: 1; } }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                
                opacity: 0;
                display: inline-block;
                transform: translateY(200%);
                -webkit-animation: fadeUp ease-out 1; 
                -moz-animation: fadeUp ease-out 1;
                animation: fadeUp ease-out 1;

                -webkit-animation-fill-mode: forwards; 
                -moz-animation-fill-mode: forwards;
                animation-fill-mode: forwards;

                -webkit-animation-duration: 0.5s;
                -moz-animation-duration: 0.5s;
                animation-duration: 0.5s;
            }


            .m-b-md {
                margin-bottom: 30px;
                transform: translateY(200%);
                -webkit-animation: fadeUp ease-out 1; 
                -moz-animation: fadeUp ease-out 1;
                animation: fadeUp ease-out 1;

                -webkit-animation-fill-mode: forwards; 
                -moz-animation-fill-mode: forwards;
                animation-fill-mode: forwards;

                -webkit-animation-duration: 1s;
                -moz-animation-duration: 1s;
                animation-duration: 1s;
            }

            .links a:nth-child(odd){
                -webkit-animation-delay: 1.2s;
                -moz-animation-delay: 1.2s;
                animation-delay: 1.2s;
            }
            .links a:nth-child(even){
                -webkit-animation-delay: 1.4s;
                -moz-animation-delay: 1.4s;
                animation-delay: 1.4s;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>

                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>

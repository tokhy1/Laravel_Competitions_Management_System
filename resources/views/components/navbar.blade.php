<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>

    <style>
        .nav-link {
            color: #9095A0;
        }

        .dropdown-menu {
            background-color: #EBFDFF;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #EBFDFF;
            color: #379AE6;
        }
    </style>
</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg p-2" style="background-color: #EBFDFF">
        <div class="container-fluid">
            <div class="navbar-brand">
                <img src="{{ asset('images/home/logo.png') }}" alt="Brand logo" width="100px"
                    class="d-inline-block align-text-top">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Competitions
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($competitions as $competition)
                                <li>
                                    <a class="dropdown-item" href="/competition-details/{{ $competition->id }}">
                                        {{ $competition->competition_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#your-competitions">Your Competitions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#contact">Contact Us</a>
                    </li>
                </ul>

                @auth
                    <a class="btn" href="/logout" style="background-color: #379AE6;color:white">Logout</a>
                @else
                    <a class="btn" href="/showlogin" style="margin-right: 10px;color:#379AE6">Sign In</a>
                    <a class="btn" href="/showregister" style="background-color: #379AE6;color:white">Sign Up</a>
                @endauth

            </div>
        </div>
    </nav>

    @yield('content')

    <div class="footer text-center p-2" style="background-color: #379AE6;">
        <p style="font-size: 20px;color:white;">All copyrights reserved at universityname@2024.com</p>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>

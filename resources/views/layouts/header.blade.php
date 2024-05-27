<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ url('assest/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/hamburgers.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <script src="{{ url('assets/js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <!-- End CSS -->
    @stack('title')
    @stack('script')
    @stack('styles')
</head>

<body>
    @stack('loader')

    <header>
        <div class="d-flex align-items-center justify-content-between flex-wrap px-5" id="main-menu">
            <ul class="d-flex align-items-center justify-content-between py-4">
                <li class="d-flex align-items-center">
                    <figure class="menus">
                        <img id="user-avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->avatar }}" width="45px"
                            style="margin-top: 0.5rem !important;">
                    </figure>
                    <h3 class="menu-item" id="user-name" style="padding: 5px 30px;">
                        {{ Auth::user()->name }}
                    </h3>
                </li>
            </ul>
            <ul class="d-flex align-items-center justify-content-between py-4">
                <li class="d-flex align-items-center">
                    <figure class="menus" id="avatar">
                        <img src="{{ url('assets/img/coins.svg') }}" alt="image" width="50px">
                    </figure>
                    <h5 class="menu-item d-flex" id="my-coins">
                        {{ $formattedWalletAmount }}
                        <div class="addCoins">
                            <a href="{{ route('add.coins') }}">
                                <i class="fa fa-plus" style="font-size: 16px;"></i>
                            </a>
                        </div>
                    </h5>
                </li>
                <li class="d-flex align-items-center">
                    <figure class="menus">
                        <i style="font-size: 30px;" class="fa fa-users"></i>
                    </figure>
                    <h5 class="menu-item">
                        Online: {{ $users }}
                    </h5>
                </li>
            </ul>
            <ul class="d-flex align-items-center justify-content-between py-4">
                <li class="d-flex align-items-center position-relative">
                    <a href="{{ route('home') }}">
                        <figure class="logo">
                            <img src="{{ url('assets/img/logo.gif') }}" alt="logo" width="200px">
                        </figure>
                    </a>
                    <button class="hamburger hamburger--spin" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <div class="header-drop">
                        <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                            <figure class="menus my-3 mx-2" style="margin-top: 50px !important;">
                                <img src="{{ url('assets/img/avatar.svg') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('tickets') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/optTicket.svg') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('powers') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/powers/power.png') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('logout') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/logout.svg') }}" alt="avatar" width="25px">
                            </figure>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div id="mobile-menu">
            <ul class="d-flex align-items-center justify-content-between px-3 mt-4">
                <li class="d-flex align-items-center position-relative">
                    <button class="hamburger hamburger--spin" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <div class="header-drop">
                        <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                            <figure class="menus my-3 mx-2" style="margin-top: 50px !important;">
                                <img src="{{ url('assets/img/avatar.svg') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('tickets') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/optTicket.svg') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('powers') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/powers/power.png') }}" alt="avatar" width="30px">
                            </figure>
                        </a>
                        <a href="{{ route('logout') }}">
                            <figure class="menus my-3 mx-2">
                                <img src="{{ url('assets/img/logout.svg') }}" alt="avatar" width="25px">
                            </figure>
                        </a>
                    </div>
                </li>
                <li>
                    <figure class="menus" id="coins">
                        <img src="{{ url('assets/img/coins.svg') }}" alt="image" width="50px">
                    </figure>
                    <h5 class="menu-item d-flex" id="my-coins">
                        {{ $formattedWalletAmount }}
                        <div class="addCoins">
                            <a href="{{ route('add.coins') }}">
                                <i class="fa fa-plus" style="font-size: 16px;"></i>
                            </a>
                        </div>
                    </h5>
                </li>
                <li>
                    <a href="{{ route('home') }}">
                        <figure class="logo">
                            <img src="{{ url('assets/img/logo.gif') }}" alt="logo" width="150px">
                        </figure>
                    </a>
                </li>
            </ul>
        </div>
    </header>

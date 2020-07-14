<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Unmochon') }}</title>
    <!-- Scripts -->
    <!-- Stylesheet -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> -->
            <div class="container-fluid">
                <a class="navbar-brand">
                    {{ config('app.name', 'Unmochon') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->



                        @guest

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                             @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            @if(Route::current()->getName() == 'home')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('profile.show', Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form class="form-inline my-2 my-lg-0"
                                          method = "POST"
                                          action = "{{ route('home.search') }}">
                                        <input
                                            name="search"
                                            class="form-control mr-sm-2"
                                            type="search"
                                            placeholder="Search"
                                            aria-label="Search">
                                        <button
                                            class="btn btn-outline-success my-2 my-sm-0"
                                            type="submit">Search</button>
                                        @csrf
                                    </form>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('paper.req') }}">
                                        {{ __('New Paper Request to admin') }}
                                    </a>
                                </li>
                            @elseif(Route::current()->getName() == 'profile.show')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle"
                                       id="navbarDropdown"
                                       role="button"
                                       data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        Profile Settings
                                    </a>
                                    <div class="dropdown-menu"
                                         aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                           href="{{ route('profile.edit', Auth::user()->id) }}">
                                            Edit Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('password.request') }}">
                                            Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">anything else</a>
                                    </div>
                                </li>
                            @elseif(Route::current()->getName() == 'profile.edit')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('profile.show', $user) }}">
                                        {{ __('Back to Profile') }}
                                    </a>
                                </li>
                            @elseif(Route::current()->getName() == 'posts.reviews')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('profile.show', Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">
                                        {{ __('Settings') }}
                                    </a>
                                </li>
                            @elseif(Route::current()->getName() == 'posts.create')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('profile.show', Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                            @elseif(Route::current()->getName() == 'reviews.show')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('posts.reviews', $review->posts_id) }}">
                                        {{ __('Post') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('profile.show', Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                    <span class="caret">
                                    </span>
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireStyles
</body>
<footer>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://sites.google.com/view/dip-chakraborty"> Unmochon</a>
    </div>
</footer>
</html>

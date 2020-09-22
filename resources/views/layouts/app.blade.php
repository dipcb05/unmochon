<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ExplorerHub') }}</title>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Stylesheet -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo & icon/default_favicon.ico') }}" />
    @livewireStyles
</head>
<body>
<div id="app">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo & icon/Ex n b.png') }}"
                     alt="logo"
                     style="width:300px;height:100px;">
            </a>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
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
                            @if((\Illuminate\Support\Facades\Auth::user()->role) == 2)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('admin') }}">
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                </li>
                            @endif
                                    <li class="nav-item active">
                                        <a class="nav-link"
                                           href="{{ route('home') }}">
                                            Home
                                            <span class="sr-only">
                        (current)
                    </span></a>
                                    </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('discussion') }}">
                                        {{ __('Discussion') }}
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
                        @elseif(Route::current()->getName() == 'message.person')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'discussion')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('User Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin.profile') }}">
                                    {{ __('Admin Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'check_paper_req')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'check_edit_req')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin.stat')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
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
        </nav>
    </div>
    <main class="py-4">
        @yield('content')
        @yield('script')
    </main>
</div>
@livewireStyles
</body>
<footer>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="#"> ExplorerTech</a>
    </div>
</footer>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #d1e8ff, #f8f9fa); /* Light blue gradient fading into white */
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .navbar-brand {
            color: #007bff;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #0056b3;
        }

        .nav-link {
            color: #6c757d;
        }

        .nav-link:hover {
            color: #0056b3; /* Hover effect */
        }

        .dropdown-menu {
            background-color: #fff;
        }

        .dropdown-item {
            color: #6c757d;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff; /* Hover effect for dropdown items */
        }

        main {
            flex: 1; /* Ensures the main content takes available space */
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Research Grant Management System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            &copy; {{ date('Y') }} Research Grant Management System. All Rights Reserved.
        </footer>
    </div>
</body>
</html>

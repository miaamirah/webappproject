<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!-- Styles -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #e3f2fd, #90caf9);
            color: #333;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #0056b3;
        }
        img {
            max-width: 30%;
            height: auto;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-register {
            background-color: #28a745;
        }
        .btn-register:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title -->
        <div class="title">Research Grant Management System</div>

        <!-- Image -->
        <img src="/static/uniten_logo.svg" alt="Universiti Tenaga Nasional">

        <!-- Buttons -->
        <div class="button-group">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>

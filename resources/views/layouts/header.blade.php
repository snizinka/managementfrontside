<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Management</title>
</head>
<body>
<div class="container">
    <nav>
        <ul>
            @guest()
                <li><a href="{{route('login')}}">Log in</a></li>
                <li><a href="{{route('register')}}">Register</a></li>
                @if(session('role') == 'admin')
                    <li><a href="{{route('register')}}">Add Restaurant</a></li>
                    <li><a href="{{route('register')}}">Orders</a></li>
                @endif
            @endguest
        </ul>
    </nav>

    @yield('content')
</div>
</body>
</html>

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
            @if(session('token') == null)
                <li><a href="{{route('login')}}">Log in</a></li>
                <li><a href="{{route('register')}}">Register</a></li>
            @else
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('cart')}}">Cart</a></li>
                <li><a href="{{route('logout')}}">Log out</a></li>
            @endif
                @if(session('role') == 'admin')
                    <li><a href="{{route('restaurant.index')}}">Restaurants</a></li>
                    <li><a href="{{route('order.index')}}">Orders</a></li>
                    <li><a href="{{route('dish.index')}}">Dishes</a></li>
                @endif
        </ul>
    </nav>

    @yield('content')
</div>
</body>
</html>

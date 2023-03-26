@extends('layouts.header')

@section('content')
    <div>
        <h1 style="margin-bottom: 60px;">CART</h1>
        @if($unavailable > 0)
            <div>
                <h3 style="color: orangered">Dishes unavailable: {{$unavailable}}</h3>
            </div>
        @endif
        @foreach($errors->all() as $error)
            <h1 style="font-weight: bold">{{$error}}</h1>
        @endforeach
        <div class="cart">
            <div class="dish-list">
                @if(count($dishes) == 0)
                    <div class="empty-array">
                        <h2>The cart is empty currently. But you can change it :]</h2>
                    </div>
                @endif
                @foreach($dishes as $order)
                    @foreach($order['relationships']['items'] as $dish)
                                <a href="{{route('dishes', $dish['dish']['id'])}}">
                                    <div class="dish">
                                        <div>
                                            <p>"{{$dish['dish']['name']}}"</p>
                                            <p>Price: {{$dish['dish']['price']}}</p>
                                            <p>Ingredients: {{$dish['dish']['ingredients']}}</p>
                                            <p>Restaurant: <strong>{{$dish['restaurant']['name']}}</strong></p>
                                            <p>Amount: <strong>{{$dish['count']}}</strong></p>
                                            <p>Availability: <strong>{{$dish['availability']}}</strong></p>
                                        </div>
                                        <div>
                                            <form action="{{route('dishesAdd', $dish['dish']['id'])}}" method="POST">
                                                @csrf
                                                <input type="submit" value="+">
                                            </form>

                                            <a href="{{route('cartRemove', $dish['id'])}}" style="padding: 3px; background: palevioletred;">-</a>
                                        </div>
                                    </div>
                                </a>
                    @endforeach
                @endforeach
            </div>
        </div>
        <h2>
    @isset($total)
                Total: {{$total}}$

</h2>

        <a href="{{route('order')}}">Order</a>
        @endisset
    </div>
@endsection

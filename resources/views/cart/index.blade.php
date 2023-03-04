@extends('layouts.header')

@section('content')
    <div>
        <h1 style="margin-bottom: 60px;">CART</h1>

        <div class="cart">

            <div class="dish-list">
                @foreach($dishes as $dish)
                    <a href="{{route('dishes', $dish['relationships']['dish']['id'])}}">
                        <div class="dish">
                           <div>
                               <p>"{{$dish['relationships']['dish']['name']}}"</p>
                               <p>Price: {{$dish['relationships']['dish']['price']}}</p>
                               <p>Ingredients: {{$dish['relationships']['dish']['ingredients']}}</p>
                               <p>Restaurant: <strong>{{$dish['relationships']['restaurant']['name']}}</strong></p>
                               <p>Amount: <strong>{{$dish['attributes']['count']}}</strong></p>
                           </div>
                            <div>
                                <form action="{{route('dishesAdd', $dish['relationships']['dish']['id'])}}" method="POST">
                                    @csrf
                                    <input type="submit" value="+">
                                </form>
                                <form action="{{route('cartRemove', $dish['id'])}}">
                                    @csrf
                                    <input type="submit" value="-">
                                </form>
                            </div>
                        </div>
                    </a>
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

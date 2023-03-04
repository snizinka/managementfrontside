@extends('layouts.header')

@section('content')
    <div>
        <h1>Restaurants</h1>

        <div>
            <div class="dish-list">
                @foreach($restaurants as $restaurant)
                    <a href="{{route('restaurants', $restaurant['id'])}}">
                        <div class="dish">
                            <p>Order status:<strong>{{$restaurant['attributes']['name']}}</strong></p>
                            <p>Address:<strong>{{$restaurant['attributes']['address']}}</strong></p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
@endsection

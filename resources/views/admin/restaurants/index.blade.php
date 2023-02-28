@extends('layouts.header')

@section('content')
    <div>
        <h1>Restaurants</h1>

        <div>
            <a href="{{route('restaurant.create')}}">Add a new restaurant</a>
            <div class="dish-list">
                @if(count($restaurants) == 0)
                    <div class="empty-array">
                        <h2>There is nothing to show :)</h2>
                    </div>
                @endif
                @foreach($restaurants as $restaurant)
                    <a href="{{route('restaurant.show', $restaurant['id'])}}">
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

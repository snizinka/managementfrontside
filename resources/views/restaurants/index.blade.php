@extends('layouts.header')

@section('content')
    <div>
        <h1>Restaurants</h1>

        <div>
            <div class="dish-list">
                @if(count($restaurants) == 0)
                    <div class="empty-array">
                        <h2>There is nothing to show :)</h2>
                    </div>
                @endif
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

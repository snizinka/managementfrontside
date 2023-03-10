@extends('layouts.header')

@section('content')
    <div>
        <h1 style="margin-bottom: 60px;">HOME>Restaurants</h1>

        <div>
            <div class="dish-list">
                @if(count($restaurants) == 0)
                    <div class="empty-array">
                        <h2>There is nothing to show :)</h2>
                    </div>
                @endif
                @foreach($restaurants as $restaurant)
                    <a href=@if(session('role') == 'admin')
                                "{{route('restaurant.show', $restaurant['id'])}}"
                    @else
                            "{{route('restaurants', $restaurant['id'])}}"
                    @endif>
                        <div class="dish">
                            <p>Restaurant:<strong>{{$restaurant['attributes']['name']}}</strong></p>
                            <p>Address:<strong>{{$restaurant['attributes']['address']}}</strong></p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

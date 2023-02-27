@extends('layouts.header')

@section('content')
    <div>
        <h1>DISHES</h1>

        <div>

            <div class="dish-list">
        @foreach($dishes as $dish)
                    <a href="{{route('dish.show', $dish['id'])}}">
                 <div class="dish">
                <p><strong>{{$dish['attributes']['name']}}</strong></p>
                <p>Price: {{$dish['attributes']['price']}}</p>
                <p>Restaurant: <strong>{{$dish['relationships']['restaurant']['name']}}</strong></p>
            </div>
                </a>
        @endforeach
        </div>
        </div>

    </div>
@endsection

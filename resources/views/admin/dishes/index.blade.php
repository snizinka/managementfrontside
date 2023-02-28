@extends('layouts.header')

@section('content')
    <div>
        <h1>DISHES</h1>

        <div>
            <a href="{{route('dish.create')}}">Add a new dish</a>

            <div class="dish-list">
                @if(count($dishes) == 0)
                    <div class="empty-array">
                        <h2>There is nothing to show :)</h2>
                    </div>
                @endif
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

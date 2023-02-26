@extends('layouts.header')

@section('content')
    <div>
        <h1>DISHES</h1>

        <div>
            <a href="{{route('dish.create')}}">Add a new dish</a>

            <div>
        @foreach($dishes as $dish)
            <div>
                <a href="{{route('dish.show', $dish['id'])}}">{{$dish['id']}}</a>
                <p>{{$dish['attributes']['name']}}</p>
                <p>{{$dish['attributes']['price']}}</p>
            </div>
        @endforeach
        </div>
        </div>

    </div>
@endsection

@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$dish['attributes']['name']}}</h1>

        <form action="{{route('dishesAdd', $dish['id'])}}" method="POST">
                <p>ID: {{$dish['id']}}</p>
                <p>Name: {{$dish['attributes']['name']}}</p>
                <p>Price: {{$dish['attributes']['price']}}</p>
                <p>Ingredients: {{$dish['attributes']['ingredients']}}</p>
                <p>Category: {{$dish['relationships']['category']['name']}}</p>
                <p>Restaurant: {{$dish['relationships']['restaurant']['name']}}</p>
            @csrf
            <input type="submit" value="Add to cart">
        </form>

    </div>
@endsection

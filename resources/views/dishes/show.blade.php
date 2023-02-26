@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$dish['attributes']['name']}}</h1>

        <form action="{{route('dish.destroy', $dish['id'])}}" method="POST">
                <p>ID: {{$dish['id']}}</p>
                <p>Name: {{$dish['attributes']['name']}}</p>
                <p>Price: {{$dish['attributes']['price']}}</p>
                <p>Ingredients: {{$dish['attributes']['ingredients']}}</p>
                <p>Category: {{$dish['relationships']['category']['name']}}</p>
                <p>Restaurant: {{$dish['relationships']['restaurant']['name']}}</p>
                <a href="{{route('dish.edit', $dish['id'])}}">Edit</a>

            @csrf
            @method('DELETE')
            <input type="submit" value="Remove">
        </form>

    </div>
@endsection

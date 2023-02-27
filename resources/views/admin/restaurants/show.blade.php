@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$restaurants['attributes']['address']}}</h1>

        <form action="{{route('restaurant.destroy', $restaurants['id'])}}" method="POST">
            <p>Status: {{$restaurants['attributes']['name']}}</p>
            <p>Address: {{$restaurants['attributes']['address']}}</p>
            <p>Address: {{$restaurants['attributes']['contacts']}}</p>
            <a href="{{route('restaurant.edit', $restaurants['id'])}}">Edit</a>

            @csrf
            @method('DELETE')
            <input type="submit" value="Remove">
        </form>

    </div>
@endsection

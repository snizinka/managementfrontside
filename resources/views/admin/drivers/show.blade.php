@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$driver['attributes']['lastname']}}</h1>

        <form action="{{route('removeDriver', $driver['id'])}}" method="POST">
            <p>ID: {{$driver['id']}}</p>
            <p>Lastname: {{$driver['attributes']['lastname']}}</p>
            <p>Name: {{$driver['attributes']['name']}}</p>
            <a href="{{route('updateFormDriver', $driver['id'])}}">Edit</a>

            @csrf
            @method('DELETE')
            <input type="submit" value="Remove">
        </form>

    </div>
@endsection

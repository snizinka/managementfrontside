@extends('layouts.header')

@section('content')
    <div>
        <h1>Drivers</h1>

        <div>
            <a href="{{route('addDriver')}}" class="add-new">Add a new driver</a>

            <div class="dish-list">
                @if(count($drivers) == 0)
                    <div class="empty-array">
                        <h2>There is nothing to show :)</h2>
                    </div>
                @endif
                @foreach($drivers as $driver)
                    <a href="{{route('showDriver', $driver['id'])}}">
                        <div class="dish">
                            <p>Lastname: <strong>{{$driver['attributes']['lastname']}}</strong></p>
                            <p>Name: {{$driver['attributes']['name']}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
@endsection

@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$restaurants['attributes']['address']}}</h1>

        <div>
            <p>Status: {{$restaurants['attributes']['name']}}</p>
            <p>Address: {{$restaurants['attributes']['address']}}</p>
            <p>Address: {{$restaurants['attributes']['contacts']}}</p>

            <h2>Menu</h2>
                <div class="dish-list">
                    @foreach($dishes as $dish)
                        <a href="#">
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
    </div>
@endsection

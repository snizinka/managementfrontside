@extends('layouts.header')

@section('content')
    <div>
        <h1>{{$orders['attributes']['address']}}</h1>

        <form action="{{route('order.destroy', $orders['id'])}}" method="POST">
            <p>ID: {{$orders['id']}}</p>
            <p>Status: {{$orders['attributes']['status']}}</p>
            <p>Address: {{$orders['attributes']['address']}}</p>
            <p>Phone number: {{$orders['attributes']['phone']}}</p>
            <p>Username: {{$orders['attributes']['username']}}</p>
            <p>Delivery status: {{$orders['attributes']['delivery-status']}}</p>
            <p>Account id: {{$orders['relationships']['user']['id']}}</p>
            <a href="{{route('order.edit', $orders['id'])}}">Assign a driver</a>

            @csrf
            @method('DELETE')
            <input type="submit" value="Remove">
        </form>

    </div>
@endsection

@extends('layouts.header')

@section('content')

    <h1>Assign a driver</h1>

    <form enctype="multipart/form-data"
          action="{{route('order.update', $orders['id'])}}"
          method="POST">
        @csrf
        @method('PUT')
        <p>ID: {{$orders['id']}}</p>
        <p>Status: {{$orders['attributes']['status']}}</p>
        <p>Address: {{$orders['attributes']['address']}}</p>
        <p>Phone number: {{$orders['attributes']['phone']}}</p>
        <p>Username: {{$orders['attributes']['username']}}</p>
        <p>Delivery status: {{$orders['attributes']['delivery-status']}}</p>
        <p>Account id: {{$orders['relationships']['user']['id']}}</p>

        <p>Order driver</p>
        <select name="orderdriver">
            @foreach($drivers as $driver)
                <option value="{{$driver['id']}}">{{$driver['attributes']['name']}}</option>
            @endforeach
        </select>

        <button type="submit">Assign</button>
    </form>
@endsection

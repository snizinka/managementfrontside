@extends('layouts.header')

@section('content')
    <div>
        <h1>Orders</h1>

        <div>

            <div class="dish-list">
                @foreach($orders as $order)
                    <a href="{{route('order.show', $order['id'])}}">
                        <div class="dish">
                            <p>Order status:<strong>{{$order['attributes']['status']}}</strong></p>
                            <p>Address:<strong>{{$order['attributes']['address']}}</strong></p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
@endsection

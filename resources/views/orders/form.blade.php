@extends('layouts.header')

@section('content')

    <h1 style="margin-bottom: 60px;">Make an order</h1>

    <form enctype="multipart/form-data"
          action="{{route('orderMake')}}"
          method="POST">
        @csrf

        <p>User's name</p>
        <input type="text" name="username">

        <p>Order address</p>
        <input type="text" name="address">

        <p>Phone number</p>
        <input type="text" name="phone">

        <button type="submit">Order</button>
    </form>
@endsection

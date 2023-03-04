@extends('layouts.header')

@section('content')

    <h1 style="margin-bottom: 60px;">Make an order</h1>

    <form enctype="multipart/form-data"
          action="{{route('orderMake')}}"
          method="POST">
        @csrf

        <p>User's name</p>
        <input type="text" name="username">
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('username'))
                        <p>{{$errors->first('username')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <p>Order address</p>
        <input type="text" name="address">
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('address'))
                        <p>{{$errors->first('address')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <p>Phone number</p>
        <input type="text" name="phone">
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('phone'))
                        <p>{{$errors->first('phone')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <button type="submit">Order</button>
    </form>
@endsection

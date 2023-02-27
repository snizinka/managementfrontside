@extends('layouts.header')

@section('content')

    @isset($restaurants)
        <h1>Edit Restaurant</h1>
    @else
        <h1>Add Restaurant</h1>
    @endisset
    <form enctype="multipart/form-data"
          @isset($restaurants)
              action="{{route('restaurant.update', $restaurants['id'])}}"
          @else
              action="{{route('restaurant.store')}}"
          @endisset
          method="POST">
        @csrf

        @isset($restaurants)
            @method('PUT')
        @endisset

        <p>Restaurant name</p>
        <input type="text" name="restaurantname"
               @isset($restaurants)
                   value="{{$restaurants['attributes']['name']}}"
            @endisset
        >
        <p>Restaurant address</p>
        <input type="text" name="restaurantaddress"
               @isset($restaurants)
                   value="{{$restaurants['attributes']['address']}}"
            @endisset
        >
        <p>Restaurant contacts</p>
        <input type="text" name="restaurantcontacts"
               @isset($restaurants)
                   value="{{$restaurants['attributes']['contacts']}}"
            @endisset
        >

        <button type="submit">@if(isset($restaurants))Edit @else Add @endif</button>
    </form>

    @isset($dish)
        <a href="{{route('restaurant.destroy', $restaurants['id'])}}">Remove</a>
    @endisset
@endsection

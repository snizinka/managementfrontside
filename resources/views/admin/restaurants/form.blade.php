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
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('name'))
                        <p>{{$errors->first('name')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <p>Restaurant address</p>
        <input type="text" name="restaurantaddress"
               @isset($restaurants)
                   value="{{$restaurants['attributes']['address']}}"
            @endisset
        >
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('address'))
                        <p>{{$errors->first('address')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <p>Restaurant contacts</p>
        <input type="text" name="restaurantcontacts"
               @isset($restaurants)
                   value="{{$restaurants['attributes']['contacts']}}"
            @endisset
        >
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('contacts'))
                        <p>{{$errors->first('contacts')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <button type="submit">@if(isset($restaurants))Edit @else Add @endif</button>
    </form>

    @isset($dish)
        <a href="{{route('restaurant.destroy', $restaurants['id'])}}">Remove</a>
    @endisset
@endsection

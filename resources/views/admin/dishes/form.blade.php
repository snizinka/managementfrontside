@extends('layouts.header')

@section('content')

    @isset($dish)
        <h1>Edit Dish</h1>
    @else
        <h1>Add Dish</h1>
    @endisset
    <form enctype="multipart/form-data"
          @isset($dish)
              action="{{route('dish.update', $dish['id'])}}"
          @else
              action="{{route('dish.store')}}"
          @endisset
          method="POST">
        @csrf

        @isset($dish)
            @method('PUT')
        @endisset
        <p>Dish image</p>
        <input type="file" name="dishimage" accept="image/png, image/jpeg">
        <p>Dish name</p>
        <input type="text" name="dishname"
               @isset($dish)
                   value="{{$dish['attributes']['name']}}"
            @endisset
        >
        <p>Dish price</p>
        <input type="text" name="dishprice"
               @isset($dish)
                   value="{{$dish['attributes']['price']}}"
            @endisset
        >
        <p>Dish products</p>
        <input type="text" name="dishproducts"
               @isset($dish)
                   value="{{$dish['attributes']['ingredients']}}"
            @endisset
        >

        <p>Dish category</p>
        <select name="dishcategory">
            @foreach($categories as $category)
                <option value="{{$category['id']}}"
                        @isset($dish)
                            @if($dish['relationships']['category']['id'] == $category['id'])
                                selected
                    @endif
                    @endisset
                >{{$category['attributes']['name']}}</option>
            @endforeach
        </select>

        <p>Belongs to restaurant</p>
        <select name="dishrestaurant">
            @foreach($restaurants as $restaurant)
                <option value="{{$restaurant['id']}}"
                        @isset($dish)
                            @if($dish['relationships']['restaurant']['id'] == $restaurant['id'])
                                selected
                    @endif
                    @endisset
                >{{$restaurant['attributes']['name']}}</option>
            @endforeach
        </select>

        <button type="submit">@if(isset($dish))Edit @else Add @endif</button>
    </form>

    @isset($dish)
        <a href="{{route('dish.destroy', $dish['id'])}}">Remove</a>
    @endisset
@endsection

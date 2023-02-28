@extends('layouts.header')

@section('content')

    @isset($driver)
        <h1>Edit Driver</h1>
    @else
        <h1>Add Driver</h1>
    @endisset
    <form enctype="multipart/form-data"
          @isset($driver)
              action="{{route('updateDriver', $driver['id'])}}"
          @else
              action="{{route('insertDriver')}}"
          @endisset
          method="POST">
        @csrf

        @isset($driver)
            @method('PUT')
        @endisset
        <p>Driver's lastname</p>
        <input type="text" name="lastname"
               @isset($driver)
                   value="{{$driver['attributes']['lastname']}}"
            @endisset
        >
        @isset($errors)
            <span class="invalid-feedback" role="alert">
                <strong>
                    @if($errors->has('lastname'))
                        <p>{{$errors->first('lastname')}}</p>
                    @endif
                </strong>
            </span>
        @endisset

        <p>Driver's name</p>
        <input type="text" name="name"
               @isset($driver)
                   value="{{$driver['attributes']['name']}}"
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

        <button type="submit">@if(isset($driver))Edit @else Add @endif</button>
    </form>

    @isset($driver)
        <a href="{{route('removeDriver', $driver['id'])}}">Remove</a>
    @endisset
@endsection

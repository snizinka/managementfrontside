
@extends('layouts.header')

@section('content')

<form action="{{route('confirmReset')}}" method="POST">
    @csrf
    @method('PUT')
    <p>New password</p>
    <input type="password" name="password">
    <p>Confirm new password</p>
    <input type="password" name="confirm">

    @isset($errors)
        <span class="invalid-feedback" role="alert">
            <strong>
                @if($errors->has('password'))
                    <p>{{$errors->first('password')}}</p>
                @endif
            </strong>
        </span>
    @endisset

    <input type="submit" value="Change">
</form>

@endsection

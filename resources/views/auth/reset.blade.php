<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset</title>
</head>
<body>

@if(!isset($sent))
<form action="{{route('reset')}}" method="POST">
    @csrf
    <p>Email</p>
    <input type="email" name="email">
    <input type="submit" value="Reset">

    @isset($errors)
        <span class="invalid-feedback" role="alert">
            <strong>
                @if($errors->has('email'))
                    <p>{{$errors->first('email')}}</p>
                @endif
            </strong>
        </span>
    @endisset
</form>

@else
    <h2>Check your mail box</h2>
@endif
</body>
</html>

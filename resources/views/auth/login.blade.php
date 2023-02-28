<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    @isset($unauthorized)
                        <h1>{{$unauthorized['unauthorized'][0]}}</h1>
                    @endisset

                    <div class="card-body">
                        <form method="POST" action="{{ route('login-store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @isset($error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                @isset($error['email'])
                                                    @foreach($error['email'] as $erro)
                                                        <p>{{$erro}}</p>
                                                    @endforeach
                                                @endisset
                                            </strong>
                                        </span>
                                    @endisset
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                                    @isset($error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                @isset($error['password'])
                                                    @foreach($error['password'] as $erro)
                                                        <p>{{$erro}}</p>
                                                    @endforeach
                                                @endisset
                                            </strong>
                                        </span>
                                    @endisset
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>

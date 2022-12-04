@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <br>
                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">
                                    {{ __('Username o Email') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="login" type="text"
                                           class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="login" value="{{ old('username') ?: old('email') }}" required
                                           autofocus>

                                    @if ($errors->has('username') || $errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordati') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Password dimenticata') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="col-md-8 offset-md-4">
                            <br><br>
                            <p> O effettua il login con: </p>
                        </div>
                        <div class="justify-content-center d-flex">
                            <a class="btn btn-outline-dark" href="/login/google" role="button"
                               style="text-transform:none; width: 200px">
                                <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in"
                                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png"/>
                                Google
                            </a>
                            <br><br>
                            <a class="btn btn-outline-dark ml-2" href="/login/github" role="button"
                               style="text-transform:none; width: 200px">
                                <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Github sign-in"
                                     src="{{asset('/images/app/github.png')}}">
                                Github
                            </a>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

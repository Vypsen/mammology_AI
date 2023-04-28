@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Вход</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf

                            <div class="row mb-3">
                                {{--                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>--}}

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="E-mail">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{--                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>--}}

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password" placeholder="Пароль">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="">
                                    <div class="col-md-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                Запомнить меня
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 d-grid ">
                                    <button type="submit" class="btn btn-primary">
                                        Войти
                                    </button>

                                    {{--                                @if (Route::has('password.request'))--}}
                                    {{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--                                        {{ __('Forgot Your Password?') }}--}}
                                    {{--                                    </a>--}}
                                    {{--                                @endif--}}
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

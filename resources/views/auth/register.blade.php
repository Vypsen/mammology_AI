@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Регистрация</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('register.post')}}">
                            @csrf
                            <div class="row mb-3">
                                {{--                            <label for="lastname" class="col-md-4 col-form-label text-md-end">Фамилия</label>--}}

                                <div class="col-md-12">
                                    <input id="lastname" type="text" placeholder="Фамилия"
                                           class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                           value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{--                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>--}}

                                <div class="col-md-12">
                                    <input id="name" placeholder="Имя" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{--    <label for="lastname" class="col-md-4 col-form-label text-md-end">Фамилия</label>--}}

                                <div class="col-md-12">
                                    <input id="patronymic" type="text" placeholder="Отчество"
                                           class="form-control @error('patronymic') is-invalid @enderror" name="patronymic"
                                           value="{{ old('patronymic') }}" required autocomplete="patronymic" autofocus>

                                    @error('patronymic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{--                            <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>--}}

                                <div class="col-md-12">
                                    <input id="bdate" placeholder="Дата рождения" type="date"
                                           class="form-control @error('bdate') is-invalid @enderror" name="bdate"
                                           value="{{ old('bdate') }}" required autocomplete="bdate">

                                    @error('dbate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{--                            <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>--}}

                                <div class="col-md-12">
                                    <input id="email" placeholder="E-mail" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{--                                <label for="password"--}}
                                {{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password"
                                           placeholder="Пароль">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-6 d-grid mx-auto">
                                    <button type="submit" class="btn btn-primary">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Задайте нова парола</p>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group mb-3">
                <input type="email"
                       name="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                </div>
                @if ($errors->has('email'))
                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="input-group mb-3">
                <input type="password"
                       name="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       placeholder="Парола">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                </div>
                @if ($errors->has('password'))
                    <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="input-group mb-3">
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Потвърди паролата">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Възстанови</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="{{ route('login') }}">Вход</a>
        </p>
    </div>
@endsection

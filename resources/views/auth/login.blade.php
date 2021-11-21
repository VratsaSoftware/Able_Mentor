@extends('layouts.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Вход</p>

        <form method="post" action="{{ url('/login') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Email"
                       class="form-control @error('email') is-invalid @enderror">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                </div>
                @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password"
                       name="password"
                       placeholder="Парола"
                       class="form-control @error('password') is-invalid @enderror">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">Остани логнат</label>
                    </div>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>

            </div>
        </form>

        <p class="mb-1">
            <a href="{{ route('password.request') }}">Забравена парола</a>
        </p>
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Регистрация</a>
        </p>
    </div>
@endsection

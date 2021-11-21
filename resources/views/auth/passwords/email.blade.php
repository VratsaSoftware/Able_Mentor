@extends('layouts.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Забравихте паролата си? Тук можете лесно да зададете нова парола.</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="post">
            @csrf

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

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Нулиране на парола</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="{{ route("login") }}">Вход</a>
        </p>
        <p class="mb-0">
            <a href="{{ route("register") }}" class="text-center">Регистрация</a>
        </p>
    </div>
@endsection

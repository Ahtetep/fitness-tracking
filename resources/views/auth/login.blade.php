@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <div class="auth-container">
        <h1>Вход в систему</h1>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-primary">Войти</button>
            </div>

            <div class="form-footer">
                <a href="{{ route('password.request') }}">Забыли пароль?</a>
            </div>
        </form>

        <div class="registration-link">
            <p>Еще нет аккаунта?</p>
            <a href="{{ route('register') }}" class="btn-secondary">Зарегистрироваться</a>
        </div>
    </div>
@endsection

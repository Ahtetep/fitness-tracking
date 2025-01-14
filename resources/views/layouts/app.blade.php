<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Главная')</title>
    @vite(['resources/css/app.css']) {{-- Подключение стилей --}}
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('exercises') }}">Упражнения</a></li>
            <li><a href="{{ route('metrics') }}">Метрики</a></li>
        </ul>
    </nav>
</header>

<main>
    @yield('content') {{-- Контент страницы --}}
</main>

<footer>
    <p>&copy; {{ date('Y') }} Мой сайт. Все права защищены.</p>
</footer>

{{-- Подключение jQuery через CDN --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

{{-- Подключение основного JS --}}
@vite(['resources/js/app.js'])

{{-- Подключение пользовательских скриптов --}}
@yield('scripts')
</body>
</html>

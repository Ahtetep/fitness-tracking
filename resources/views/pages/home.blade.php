@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <section>
        <h1>Добро пожаловать на наш сайт!</h1>
        <p>Здесь вы можете отслеживать свои упражнения, метрики и достижения.</p>
    </section>

    <section>
        <h2>Последние упражнения</h2>
        <div class="exercise-list">
            @foreach($exercises as $exercise)
                @include('components.exercise_card', ['exercise' => $exercise])
            @endforeach
        </div>
    </section>

    <section>
        <h2>Последние метрики</h2>
        <div class="metric-list">
            @foreach($metrics as $metric)
                @include('components.user_metric_card', ['metric' => $metric])
            @endforeach
        </div>
    </section>
@endsection

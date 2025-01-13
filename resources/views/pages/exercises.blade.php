@extends('layouts.app')

@section('title', 'Упражнения')

@section('content')
    <section>
        <h1>Список упражнений</h1>
        <div class="exercise-list">
            @foreach($exercises as $exercise)
                @include('components.exercise_card', ['exercise' => $exercise])
            @endforeach
        </div>
    </section>
@endsection

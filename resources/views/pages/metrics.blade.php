@extends('layouts.app')

@section('title', 'Метрики')

@section('content')
    <section>
        <h1>Список метрик</h1>
        <div class="metric-list">
            @foreach($metrics as $metric)
                @include('components.user_metric_card', ['metric' => $metric])
            @endforeach
        </div>
    </section>
@endsection

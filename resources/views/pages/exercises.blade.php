@extends('layouts.app')

@section('title', 'Упражнения')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Упражнения</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="exercise-list">
            @foreach($exercises as $exercise)
                <div class="exercise-card mb-5">
                    <h3>{{ $exercise->name }}</h3>
                    <p>{{ $exercise->description }}</p>

                    <!-- График -->
                    <div class="chart-container mt-3">
                        <canvas id="chart-{{ $exercise->id }}" height="100"></canvas>
                    </div>

                    <!-- Форма для добавления данных -->
                    <form action="{{ route('exercises.store', $exercise->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="logged_at_{{ $exercise->id }}">Дата</label>
                                <input type="date" id="logged_at_{{ $exercise->id }}" name="logged_at" class="form-control" required>
                            </div>

                            @if($exercise->type == 'repetitions')
                                <div class="col-md-6">
                                    <label for="repetitions_{{ $exercise->id }}">Количество повторений</label>
                                    <input type="number" id="repetitions_{{ $exercise->id }}" name="repetitions" class="form-control" placeholder="Количество повторений">
                                </div>
                            @elseif($exercise->type == 'time_distance_calories')
                                <div class="col-md-4">
                                    <label for="time_{{ $exercise->id }}">Время (мин.)</label>
                                    <input type="number" id="time_{{ $exercise->id }}" name="time" class="form-control" step="0.1" placeholder="Время">
                                </div>
                                <div class="col-md-4">
                                    <label for="distance_{{ $exercise->id }}">Дистанция (км)</label>
                                    <input type="number" id="distance_{{ $exercise->id }}" name="distance" class="form-control" step="0.01" placeholder="Дистанция">
                                </div>
                                <div class="col-md-4">
                                    <label for="calories_{{ $exercise->id }}">Калории (ккал)</label>
                                    <input type="number" id="calories_{{ $exercise->id }}" name="calories" class="form-control" step="0.1" placeholder="Калории">
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Добавить данные</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach($exercises as $exercise)
            (function() {
                const chartData = @json($chartData[$exercise->id] ?? []);

                if (chartData.dates && chartData.dates.length > 0) {
                    const datasets = [];
                    for (const [key, values] of Object.entries(chartData.lines)) {
                        datasets.push({
                            label: chartData.labels[key],
                            data: values,
                            borderColor: `rgba(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255}, 1)`,
                            backgroundColor: `rgba(${Math.random()*255}, ${Math.random()*255}, ${Math.random()*255}, 0.2)`,
                            borderWidth: 2,
                        });
                    }

                    new Chart(document.getElementById('chart-{{ $exercise->id }}').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: chartData.dates,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: true }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Дата' } },
                                y: { title: { display: true, text: 'Значения' } }
                            }
                        }
                    });
                }
            })();
            @endforeach
        });
    </script>
@endsection

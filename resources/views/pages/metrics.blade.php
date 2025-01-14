@extends('layouts.app')

@section('title', 'Метрики')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Список метрик</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Таблица метрик -->
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Дата записи</th>
                <th>Вес (кг)</th>
                <th>Рост (см)</th>
                <th>ИМТ</th>
                <th>Окружность груди (см)</th>
                <th>Окружность талии (см)</th>
                <th>Окружность бедер (см)</th>
                <th>Окружность по пупку (см)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($metrics as $metric)
                <tr>
                    <td>{{ $metric->id }}</td>
                    <td>{{ $metric->recorded_at }}</td>
                    <td>{{ $metric->weight }}</td>
                    <td>{{ $metric->height ?? '-' }}</td>
                    <td>{{ $metric->bmi ?? '-' }}</td>
                    <td>{{ $metric->chest_circumference ?? '-' }}</td>
                    <td>{{ $metric->waist_circumference ?? '-' }}</td>
                    <td>{{ $metric->hip_circumference ?? '-' }}</td>
                    <td>{{ $metric->navel_circumference ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center">
            {{ $metrics->links() }}
        </div>

        <!-- Форма добавления метрики -->
        <h2 class="mt-5">Добавить новую метрику</h2>
        <form action="{{ route('metrics.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recorded_at">Дата записи</label>
                        <input type="date" class="form-control" id="recorded_at" name="recorded_at" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Вес (кг)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" name="weight" required>
                    </div>
                    <div class="form-group">
                        <label for="height">Рост (см)</label>
                        <input type="number" step="0.1" class="form-control" id="height" name="height">
                    </div>
                    <div class="form-group">
                        <label for="bmi">ИМТ</label>
                        <input type="number" step="0.1" class="form-control" id="bmi" name="bmi" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="chest_circumference">Окружность груди (см)</label>
                        <input type="number" step="0.1" class="form-control" id="chest_circumference" name="chest_circumference">
                    </div>
                    <div class="form-group">
                        <label for="waist_circumference">Окружность талии (см)</label>
                        <input type="number" step="0.1" class="form-control" id="waist_circumference" name="waist_circumference">
                    </div>
                    <div class="form-group">
                        <label for="hip_circumference">Окружность бедер (см)</label>
                        <input type="number" step="0.1" class="form-control" id="hip_circumference" name="hip_circumference">
                    </div>
                    <div class="form-group">
                        <label for="navel_circumference">Окружность по пупку (см)</label>
                        <input type="number" step="0.1" class="form-control" id="navel_circumference" name="navel_circumference">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Добавить метрику</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('Пользовательский скрипт для страницы метрик работает!');

            // Ваш код
            $('#weight, #height').on('input', function () {
                let weight = parseFloat($('#weight').val());
                let height = parseFloat($('#height').val()) / 100; // Преобразуем в метры

                if (weight > 0 && height > 0) {
                    let bmi = (weight / (height * height)).toFixed(1);
                    $('#bmi').val(bmi);
                } else {
                    $('#bmi').val('');
                }
            });
        });
    </script>
@endsection


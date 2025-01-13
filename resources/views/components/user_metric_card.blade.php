<div class="metric-card">
    <h4>Дата: {{ $metric->recorded_at }}</h4>
    <ul>
        <li>Вес: {{ $metric->weight }} кг</li>
        <li>Рост: {{ $metric->height ?? 'Не указан' }} см</li>
        <li>ИМТ: {{ $metric->bmi ?? 'Не рассчитан' }}</li>
        <li>Окружность груди: {{ $metric->chest_circumference ?? 'Не указана' }}</li>
        <li>Окружность талии: {{ $metric->waist_circumference ?? 'Не указана' }}</li>
        <li>Окружность бедер: {{ $metric->hip_circumference ?? 'Не указана' }}</li>
        <li>Окружность по пупку: {{ $metric->navel_circumference ?? 'Не указана' }}</li>
    </ul>
</div>

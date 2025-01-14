<?php

namespace App\Http\Controllers;

use App\Services\UserMetricService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserMetricController extends Controller
{
    protected UserMetricService $userMetricService;

    public function __construct(UserMetricService $userMetricService)
    {
        $this->userMetricService = $userMetricService;
    }

    /**
     * Показать список метрик с пагинацией.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Получение метрик с пагинацией (10 записей на страницу)
        $metrics = $this->userMetricService->paginate(10);

        return view('pages.metrics', compact('metrics'));
    }

    /**
     * Обработчик для добавления метрики.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'recorded_at' => 'required|date',
            'weight' => 'required|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'bmi' => 'nullable|numeric|min:0',
            'chest_circumference' => 'nullable|numeric|min:0',
            'waist_circumference' => 'nullable|numeric|min:0',
            'hip_circumference' => 'nullable|numeric|min:0',
            'navel_circumference' => 'nullable|numeric|min:0',
        ]);

        // Добавляем user_id из авторизованного пользователя
        $data = $request->all();
        $data['user_id'] = Auth::id(); // Берем ID текущего пользователя

        $this->userMetricService->create($data);

        return redirect()->route('metrics')->with('success', 'Метрика успешно добавлена!');
    }
}

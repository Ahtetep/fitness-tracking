<?php

namespace App\Http\Controllers;

use App\Services\ExerciseLogService;
use App\Services\ExerciseService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExerciseController extends Controller
{
    protected ExerciseService $exerciseService;
    protected ExerciseLogService $exerciseLogService;

    public function __construct(ExerciseService $exerciseService, ExerciseLogService $exerciseLogService)
    {
        $this->exerciseService = $exerciseService;
        $this->exerciseLogService = $exerciseLogService;
    }

    /**
     * Отображение списка упражнений с графиками и формами.
     *
     * @return View
     */
    public function index(): View
    {
        $exercises = $this->exerciseService->getAll();
        $chartData = [];
        $startDate = Carbon::now()->subYear()->toDateString();
        $endDate = Carbon::now()->toDateString();
        $userId = Auth::id();

        foreach ($exercises as $exercise) {
            $logs = $this->exerciseLogService->getLogsByExercise($exercise->id, $startDate, $endDate, $userId);

            switch ($exercise->type) {
                case 'repetitions':
                    $chartData[$exercise->id] = [
                        'dates' => $logs->pluck('date'),
                        'lines' => [
                            'repetitions' => $logs->pluck('total_repetitions'),
                        ],
                        'labels' => [
                            'repetitions' => 'Количество повторений',
                        ],
                    ];
                    break;

                case 'time_distance_calories':
                    $chartData[$exercise->id] = [
                        'dates' => $logs->pluck('date'),
                        'lines' => [
                            'time' => $logs->pluck('total_time'),
                            'distance' => $logs->pluck('total_distance'),
                            'calories' => $logs->pluck('total_calories'),
                        ],
                        'labels' => [
                            'time' => 'Время (мин)',
                            'distance' => 'Дистанция (км)',
                            'calories' => 'Калории (ккал)',
                        ],
                    ];
                    break;
            }
        }

        return view('pages.exercises', compact('exercises', 'chartData'));
    }

    /**
     * Сохранение данных об упражнении.
     *
     * @param Request $request
     * @param int $exerciseId
     * @return RedirectResponse
     */
    public function storeExerciseLog(Request $request, int $exerciseId): RedirectResponse
    {
        $request->validate([
            'logged_at' => 'required|date_format:Y-m-d',
            'repetitions' => 'nullable|integer|min:0',
            'time' => 'nullable|numeric|min:0',
            'distance' => 'nullable|numeric|min:0',
            'calories' => 'nullable|numeric|min:0',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Необходимо авторизоваться для добавления данных.');
        }

        $userId = Auth::id();

        // Данные передаются в сервис для сохранения
        $this->exerciseLogService->createExerciseLog([
            'user_id' => $userId,
            'exercise_id' => $exerciseId,
            'logged_at' => $request->input('logged_at'),
            'repetitions' => $request->input('repetitions', 0),
            'time' => $request->input('time', 0),
            'distance' => $request->input('distance', 0),
            'calories' => $request->input('calories', 0),
        ]);

        return redirect()->route('exercises')->with('success', 'Данные успешно добавлены!');
    }
}

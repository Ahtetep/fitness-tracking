<?php

namespace App\Http\Controllers;

use App\Services\ExerciseService;
use Illuminate\View\View;

class ExerciseController extends Controller
{
    protected ExerciseService $exerciseService;

    public function __construct(ExerciseService $exerciseService)
    {
        $this->exerciseService = $exerciseService;
    }

    /**
     * Отображение списка упражнений.
     *
     * @return View
     */
    public function index(): View
    {
        $exercises = $this->exerciseService->getAll();

        return view('pages.exercises', compact('exercises'));
    }
}

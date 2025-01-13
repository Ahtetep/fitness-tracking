<?php

namespace App\Http\Controllers;

use App\Services\ExerciseService;
use App\Services\UserMetricService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected ExerciseService $exerciseService;
    protected UserMetricService $userMetricService;

    public function __construct(ExerciseService $exerciseService, UserMetricService $userMetricService)
    {
        $this->exerciseService = $exerciseService;
        $this->userMetricService = $userMetricService;
        $this->middleware('auth');
    }

    public function index(): View
    {
        $exercises = $this->exerciseService->getLatest();
        $metrics = $this->userMetricService->getLatest();

        return view('pages.home', compact('exercises', 'metrics'));
    }
}

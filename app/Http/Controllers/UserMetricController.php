<?php

namespace App\Http\Controllers;

use App\Services\UserMetricService;
use Illuminate\View\View;

class UserMetricController extends Controller
{
    protected UserMetricService $userMetricService;

    public function __construct(UserMetricService $userMetricService)
    {
        $this->userMetricService = $userMetricService;
    }

    /**
     * Отображение списка метрик.
     *
     * @return View
     */
    public function index(): View
    {
        $metrics = $this->userMetricService->getAll();

        return view('pages.metrics', compact('metrics'));
    }
}

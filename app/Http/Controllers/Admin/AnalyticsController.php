<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VisitorService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    protected $visitorService;

    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
    }

    public function index()
    {
        $stats = $this->visitorService->getStatistics();
        $recentVisitors = $this->visitorService->getRecentVisitors(20);

        $uniqueVisitors = [
            'today' => $this->visitorService->getUniqueVisitors('today'),
            'week' => $this->visitorService->getUniqueVisitors('week'),
            'month' => $this->visitorService->getUniqueVisitors('month'),
        ];

        return view('admin.analytic.analytics', compact('stats', 'recentVisitors', 'uniqueVisitors'));
    }
}

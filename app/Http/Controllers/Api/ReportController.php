<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReportRequest;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $service
    ) {
        //
    }

    public function index()
    {
        $reports = $this->service->index();

        return response()->json($reports);
    }

    public function store(StoreReportRequest $request)
    {
        $report = $this->service->store($request->validated());

        return response()->json($report);
    }
}

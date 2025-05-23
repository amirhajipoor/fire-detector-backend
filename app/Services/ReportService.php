<?php

namespace App\Services;

use App\Models\Report;
use App\Notifications\FireAlarm;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class ReportService
{
    public function __construct()
    {
        //
    }

    public function index(): Collection
    {
        return Report::query()
            ->latest()
            ->get();
    }

    public function store(array $validated): Report
    {
        $user = auth()->user();

        try {
            DB::beginTransaction();

            $report = Report::create([
                'user_id' => $user->id,
                'value' => $validated['value'],
                'reported_at' => now(),
                'comment' => 'اندازه‌گیری شده با ماژول MQ-2',
            ]);

            $user->notify(new FireAlarm($report));

            DB::commit();

            return $report;
        } catch (Exception $error) {
            DB::rollBack();

            Log::error('Error in ReportService store()', [
                'message' => $error->getMessage(),
            ]);

            throw new InternalErrorException(__('errors.server_error'));
        }
    }
}

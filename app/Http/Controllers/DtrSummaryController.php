<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DtrSummaryController extends Controller
{
    public function DtrSummary(Request $request)
    {
        //check if the requerst is null it was used for year and month passing in the controller
        if(is_null($request)){
            return null;
        }
        
        // Get selected month and year (default to current month/year)
        $selectedMonth = request('month', Carbon::now()->month);
        $selectedYear = request('year', Carbon::now()->year);

        // Fetch logs for the selected month and year
        // Fetch logs for the selected month and year
        $userLogs = Auth::user()->history()
            ->whereYear('datetime', $request->year)
            ->whereMonth('datetime', $request->month)
            ->orderBy('datetime', 'asc')
            ->get();

        // Group logs by both month and day
        $logsByDate = $userLogs->groupBy(function ($log) {
            return Carbon::parse($log->datetime)->format('Y-m-d'); // Group by full date (YYYY-MM-DD)
        });

        // Get the total days in the selected month
        $daysInMonth = Carbon::createFromDate($request->year, $request->month, 1)->daysInMonth;

        //this will be the array
        //the content of this array will be the time in, time out, and hours worked
        $groupedData = [];

        //set the totalhours to 0
        //settings the totalhours at default value 0 since it will be used again in the dtr summary page
        $totalHours = 0;

        // Loop through all days of the selected month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');

            if (isset($logsByDate[$dateKey])) {
                // Process logs for this day
                $logs = $logsByDate[$dateKey];
                $firstTimeIn = null;
                $lastTimeOut = null;
                $dailyHours = 0;

                foreach ($logs as $log) {
                    if ($log->description === 'time in') {
                        $firstTimeIn = Carbon::parse($log->datetime);
                    } elseif ($log->description === 'time out' && $firstTimeIn) {
                        $lastTimeOut = Carbon::parse($log->datetime);
                        $dailyHours += $firstTimeIn->diffInHours($lastTimeOut);
                        $firstTimeIn = null;
                    }
                }

                // Store processed data
                $groupedData[$dateKey] = [
                    'time_in' => $logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->format('h:i A') : '—',
                    'time_out' => $logs->last()->datetime ? Carbon::parse($logs->last()->datetime)->format('h:i A') : '—',
                    // 'hours_worked' => floor($dailyHours),
                    'hours_worked' => floor($logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->diffInHours($logs->last()->datetime) : '—'),
                ];
                $totalHours += $dailyHours;
            } else {
                // If no logs exist for this day, store empty values
                $groupedData[$dateKey] = [
                    'time_in' => '—',
                    'time_out' => '—',
                    'hours_worked' => '—',
                ];
            }
        }

        //passing the grouped data to the dtr summary page 
        //this will be use in the later process of the system
        return $groupedData;
    }
}

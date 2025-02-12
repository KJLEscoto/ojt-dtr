<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DtrSummaryController extends Controller
{
    // public function ShowUserDtrSummary(Request $request)
    // {
    //     //check if the requerst is null it was used for year and month passing in the controller
    //     if(is_null($request)){
    //         return null;
    //     }
        
    //     // Get selected month and year (default to current month/year)
    //     $selectedMonth = request('month', Carbon::now()->month);
    //     $selectedYear = request('year', Carbon::now()->year);

    //     // Fetch logs for the selected month and year
    //     // Fetch logs for the selected month and year
    //     $userLogs = Histories::where('user_id', Auth::user()->id)
    //         ->whereYear('datetime', $selectedYear)
    //         ->whereMonth('datetime', $selectedMonth)
    //         ->orderBy('datetime', 'asc')
    //         ->get();
    //     // $userLogs = Auth::user()->history()
    //     //     ->whereYear('datetime', $request->year)
    //     //     ->whereMonth('datetime', $request->month)
    //     //     ->orderBy('datetime', 'asc')
    //     //     ->get();

    //     // Group logs by both month and day
    //     $logsByDate = $userLogs->groupBy(function ($log) {
    //         return Carbon::parse($log->datetime)->format('Y-m-d'); // Group by full date (YYYY-MM-DD)
    //     });

    //     // Get the total days in the selected month
    //     $daysInMonth = Carbon::createFromDate($request->year, $request->month, 1)->daysInMonth;

    //     //this will be the array
    //     //the content of this array will be the time in, time out, and hours worked
    //     $groupedData = [];
        
    //     //set the totalhours to 0
    //     //settings the totalhours at default value 0 since it will be used again in the dtr summary page
    //     $totalHours = 0;

    //     // Loop through all days of the selected month
    //     for ($day = 1; $day <= $daysInMonth; $day++) {
    //         $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');

    //         if (isset($logsByDate[$dateKey])) {
    //             // Process logs for this day
    //             $logs = $logsByDate[$dateKey];
    //             $firstTimeIn = null;
    //             $lastTimeOut = null;
    //             $dailyHours = 0;

    //             foreach ($logs as $log) {
    //                 if ($log->description === 'time in') {
    //                     $firstTimeIn = Carbon::parse($log->datetime);
    //                 } elseif ($log->description === 'time out' && $firstTimeIn) {
    //                     $lastTimeOut = Carbon::parse($log->datetime);
    //                     $dailyHours += $firstTimeIn->diffInHours($lastTimeOut);
    //                     $firstTimeIn = null;
    //                 }
    //             }

    //             // Store processed data
    //             $groupedData[$dateKey] = [
    //                 'time_in' => $logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->format('h:i A') : '—',
    //                 'time_out' => $logs->last()->datetime ? Carbon::parse($logs->last()->datetime)->format('h:i A') : '—',
    //                 // 'hours_worked' => floor($dailyHours),
    //                 'hours_worked' => floor($logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->diffInHours($logs->last()->datetime) : '—'),
    //             ];
    //             $totalHours += $dailyHours;
    //         } else {
    //             // If no logs exist for this day, store empty values
    //             $groupedData[$dateKey] = [
    //                 'time_in' => '—',
    //                 'time_out' => '—',
    //                 'hours_worked' => '—',
    //             ];
    //         }
    //     }

    //     $totalHoursPerMonth = 0;
    //     foreach ($groupedData as $key => $value) {
    //         if($value['hours_worked'] != '—'){
    //             $totalHoursPerMonth += $value['hours_worked'];
    //         }
    //     }

    //     $totalHoursPerMonth = floor($totalHoursPerMonth);

    //     dd($totalHoursPerMonth);

    //     //passing the grouped data to the dtr summary page 
    //     //this will be use in the later process of the system
    //     return [
    //         'user' => Auth::user(),
    //         'groupedData' => $groupedData,
    //         'totalHoursPerMonth' => $TotalHoursPerMonth,
    //     ];
    // }

    
    //post function
    public function ShowUserDtrPagination(Request $request)
    {
        
        
        $currentDate = Carbon::now();
        $selectedMonth = $request->input('month', $currentDate->month);
        $selectedYear = $request->input('year', $currentDate->year);
        
        if($request->searchDate){
            $selectedDate = Carbon::parse($request->searchDate);
            $selectedMonth = $selectedDate->month;
            $selectedYear = $selectedDate->year;
        }
        
        $selectedDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
        $previousMonth = (clone $selectedDate)->subMonth();
        $nextMonth = (clone $selectedDate)->addMonth();

        // Get all logs for the month
        $userLogs = Histories::where('user_id', Auth::user()->id)
            ->whereYear('datetime', $selectedYear)
            ->whereMonth('datetime', $selectedMonth)
            ->orderBy('datetime', 'asc')
            ->get();
        
        $logsByDate = $userLogs->groupBy(function ($log) {
            return Carbon::parse($log->datetime)->format('Y-m-d');
        });
        
        $daysInMonth = Carbon::createFromDate($request->year, $request->month, 1)->daysInMonth;
        
        $groupedData = [];
        $totalHours = 0;
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');
            //echo "\nProcessing date: $dateKey\n";

            if (isset($logsByDate[$dateKey])) {
                $logs = $logsByDate[$dateKey];
                //echo "Found " . $logs->count() . " logs for this date\n";

                // Get first time in and last time out for the day
                $timeInLogs = $logs->where('description', 'time in')->sortBy('datetime');
                $timeOutLogs = $logs->where('description', 'time out')->sortByDesc('datetime');

                $firstTimeIn = $timeInLogs->first();
                $lastTimeOut = $timeOutLogs->first(); // This gets the last time out since we sorted desc

                if ($firstTimeIn && $lastTimeOut) {
                    $timeIn = Carbon::parse($firstTimeIn->datetime);
                    $timeOut = Carbon::parse($lastTimeOut->datetime);
                    
                    // Only calculate hours if time out is after time in
                    if ($timeOut->gt($timeIn)) {
                        $hoursWorked = floor($timeIn->diffInHours($timeOut));

                        $groupedData[$dateKey] = [
                            'time_in' => $timeIn->format('h:i A'),
                            'time_out' => $timeOut->format('h:i A'),
                            'hours_worked' => $hoursWorked,
                        ];

                        //echo "Valid time in/out found - First In: {$timeIn->format('h:i A')}, Last Out: {$timeOut->format('h:i A')}, Hours: $hoursWorked\n";
                    } else {
                        $groupedData[$dateKey] = [
                            'time_in' => $timeIn->format('h:i A'),
                            'time_out' => $timeOut->format('h:i A'),
                            'hours_worked' => '—',
                        ];
                        //echo "Invalid time range - Time out is before time in\n";
                    }
                } else {
                    $groupedData[$dateKey] = [
                        'time_in' => $firstTimeIn ? Carbon::parse($firstTimeIn->datetime)->format('h:i A') : '—',
                        'time_out' => $lastTimeOut ? Carbon::parse($lastTimeOut->datetime)->format('h:i A') : '—',
                        'hours_worked' => '—',
                    ];
                    //echo "Incomplete logs - Missing " . (!$firstTimeIn ? "time in" : "time out") . "\n";
                }
            } else {
                $groupedData[$dateKey] = [
                    'time_in' => '—',
                    'time_out' => '—',
                    'hours_worked' => '—',
                ];
                //echo "No logs found for this date\n";
            }
        }
        
        $totalHoursPerMonth = 0;
        foreach ($groupedData as $key => $value) {
            if ($value['hours_worked'] !== '—') {
                $totalHoursPerMonth += $value['hours_worked'];
                //echo "Adding hours for $key: {$value['hours_worked']}\n";
            }
        }

        //echo "\nFinal total hours for month: $totalHoursPerMonth\n";
        
        $records = [];
        foreach ($groupedData as $date => $data) {
            $records[] = [
                'date' => $date,
                'user' => Auth::user(),
                'time_in' => $data['time_in'],
                'time_out' => $data['time_out'],
                'hours_worked' => $data['hours_worked']
            ];
        }        

        return redirect()->route('users.dtr', [
            'month' => $selectedMonth,
            'year' => $selectedYear
        ])->with('records', [
            'user' => Auth::user(),
            'records' => $groupedData,
            'totalHoursPerMonth' => $totalHoursPerMonth,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'pagination' => [
                'currentMonth' => [
                    'name' => $selectedDate->format('F Y'),
                    'month' => $selectedMonth,
                    'year' => $selectedYear
                ],
                'previousMonth' => [
                    'name' => $previousMonth->format('F Y'),
                    'month' => $previousMonth->month,
                    'year' => $previousMonth->year,
                    'url' => route('users.dtr', ['month' => $previousMonth->month, 'year' => $previousMonth->year])
                ],
                'nextMonth' => [
                    'name' => $nextMonth->format('F Y'),
                    'month' => $nextMonth->month,
                    'year' => $nextMonth->year,
                    'url' => route('users.dtr', ['month' => $nextMonth->month, 'year' => $nextMonth->year])
                ]
            ]
        ]);
    }

    //get function
    public function showUserDtr(Request $request)
    {

        $currentDate = Carbon::now();
        $selectedMonth = $request->input('month', $currentDate->month);
        $selectedYear = $request->input('year', $currentDate->year);
        
        $selectedDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
        $previousMonth = (clone $selectedDate)->subMonth();
        $nextMonth = (clone $selectedDate)->addMonth();

        // Get all logs for the month
        $userLogs = Histories::where('user_id', Auth::user()->id)
            ->whereYear('datetime', $selectedYear)
            ->whereMonth('datetime', $selectedMonth)
            ->orderBy('datetime', 'asc')
            ->get();

        $logsByDate = $userLogs->groupBy(function ($log) {
            return Carbon::parse($log->datetime)->format('Y-m-d');
        });
        
        $daysInMonth = Carbon::createFromDate($request->year, $request->month, 1)->daysInMonth;

        $groupedData = [];
        $totalHours = 0;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');
            //echo "\nProcessing date: $dateKey\n";

            if (isset($logsByDate[$dateKey])) {
                $logs = $logsByDate[$dateKey];
                //echo "Found " . $logs->count() . " logs for this date\n";

                // Get first time in and last time out for the day
                $timeInLogs = $logs->where('description', 'time in')->sortBy('datetime');
                $timeOutLogs = $logs->where('description', 'time out')->sortByDesc('datetime');

                $firstTimeIn = $timeInLogs->first();
                $lastTimeOut = $timeOutLogs->first(); // This gets the last time out since we sorted desc

                if ($firstTimeIn && $lastTimeOut) {
                    $timeIn = Carbon::parse($firstTimeIn->datetime);
                    $timeOut = Carbon::parse($lastTimeOut->datetime);
                    
                    // Only calculate hours if time out is after time in
                    if ($timeOut->gt($timeIn)) {
                        $hoursWorked = floor($timeIn->diffInHours($timeOut));

                        $groupedData[$dateKey] = [
                            'time_in' => $timeIn->format('h:i A'),
                            'time_out' => $timeOut->format('h:i A'),
                            'hours_worked' => $hoursWorked,
                        ];

                        //echo "Valid time in/out found - First In: {$timeIn->format('h:i A')}, Last Out: {$timeOut->format('h:i A')}, Hours: $hoursWorked\n";
                    } else {
                        $groupedData[$dateKey] = [
                            'time_in' => $timeIn->format('h:i A'),
                            'time_out' => $timeOut->format('h:i A'),
                            'hours_worked' => '—',
                        ];
                        //echo "Invalid time range - Time out is before time in\n";
                    }
                } else {
                    $groupedData[$dateKey] = [
                        'time_in' => $firstTimeIn ? Carbon::parse($firstTimeIn->datetime)->format('h:i A') : '—',
                        'time_out' => $lastTimeOut ? Carbon::parse($lastTimeOut->datetime)->format('h:i A') : '—',
                        'hours_worked' => '—',
                    ];
                    //echo "Incomplete logs - Missing " . (!$firstTimeIn ? "time in" : "time out") . "\n";
                }
            } else {
                $groupedData[$dateKey] = [
                    'time_in' => '—',
                    'time_out' => '—',
                    'hours_worked' => '—',
                ];
                //echo "No logs found for this date\n";
            }
        }

        $totalHoursPerMonth = 0;
        foreach ($groupedData as $key => $value) {
            if ($value['hours_worked'] !== '—') {
                $totalHoursPerMonth += $value['hours_worked'];
                //echo "Adding hours for $key: {$value['hours_worked']}\n";
            }
        }

        //echo "\nFinal total hours for month: $totalHoursPerMonth\n";
        
        $records = [];
        foreach ($groupedData as $date => $data) {
            $records[] = [
                'date' => $date,
                'user' => Auth::user(),
                'time_in' => $data['time_in'],
                'time_out' => $data['time_out'],
                'hours_worked' => $data['hours_worked']
            ];
        }
        
        return view('users.dtr', [
            'user' => Auth::user(),
            'records' => $records,
            'totalHoursPerMonth' => $totalHoursPerMonth,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'pagination' => [
                'currentMonth' => [
                    'name' => $selectedDate->format('F Y'),
                    'month' => $selectedMonth,
                    'year' => $selectedYear
                ],
                'previousMonth' => [
                    'name' => $previousMonth->format('F Y'),
                    'month' => $previousMonth->month,
                    'year' => $previousMonth->year,
                    'url' => route('users.dtr', ['month' => $previousMonth->month, 'year' => $previousMonth->year])
                ],
                'nextMonth' => [
                    'name' => $nextMonth->format('F Y'),
                    'month' => $nextMonth->month,
                    'year' => $nextMonth->year,
                    'url' => route('users.dtr', ['month' => $nextMonth->month, 'year' => $nextMonth->year])
                ]
            ]
        ]);
    }

    // public function ShowUserDtrSummary(Request $request)
    // {
    //     @dd($request->all());
    //     if(is_null($request)){
    //         return null;
    //     }

    //     $currentDate = Carbon::now();
    //     $selectedMonth = $request->input('month', $currentDate->month);
    //     $selectedYear = $request->input('year', $currentDate->year);
        
    //     $selectedDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
    //     $previousMonth = (clone $selectedDate)->subMonth();
    //     $nextMonth = (clone $selectedDate)->addMonth();

    //     // Get all logs for the month
    //     $userLogs = Histories::where('user_id', Auth::user()->id)
    //         ->whereYear('datetime', $selectedYear)
    //         ->whereMonth('datetime', $selectedMonth)
    //         ->orderBy('datetime', 'asc')
    //         ->get();

    //     // If no logs exist for the month, return empty data
    //     if ($userLogs->isEmpty()) {
    //         return view('users.dtr', [
    //             'user' => Auth::user(),
    //             'records' => [
    //                 $selectedDate->format('Y-m-d') => [
    //                     'time_in' => '—',
    //                     'time_out' => '—',
    //                     'hours_worked' => '—',
    //                 ]
    //             ],
    //             'totalHoursPerMonth' => 0,
    //             'selectedMonth' => $selectedMonth,
    //             'selectedYear' => $selectedYear,
    //             'pagination' => [
    //                 'currentMonth' => [
    //                     'name' => $selectedDate->format('F Y'),
    //                     'month' => $selectedMonth,
    //                     'year' => $selectedYear
    //                 ],
    //                 'previousMonth' => [
    //                     'name' => $previousMonth->format('F Y'),
    //                     'month' => $previousMonth->month,
    //                     'year' => $previousMonth->year,
    //                     'url' => route('users.dtr', ['month' => $previousMonth->month, 'year' => $previousMonth->year])
    //                 ],
    //                 'nextMonth' => [
    //                     'name' => $nextMonth->format('F Y'),
    //                     'month' => $nextMonth->month,
    //                     'year' => $nextMonth->year,
    //                     'url' => route('users.dtr', ['month' => $nextMonth->month, 'year' => $nextMonth->year])
    //                 ]
    //             ]
    //         ]);
    //     }

    //     $logsByDate = $userLogs->groupBy(function ($log) {
    //         return Carbon::parse($log->datetime)->format('Y-m-d');
    //     });
        
    //     $daysInMonth = Carbon::createFromDate($request->year, $request->month, 1)->daysInMonth;

    //     $groupedData = [];
    //     $totalHours = 0;

    //     for ($day = 1; $day <= $daysInMonth; $day++) {
    //         $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');
    //         echo "\nProcessing date: $dateKey\n";

    //         if (isset($logsByDate[$dateKey])) {
    //             $logs = $logsByDate[$dateKey];
    //             echo "Found " . $logs->count() . " logs for this date\n";

    //             // Get first time in and last time out for the day
    //             $timeInLogs = $logs->where('description', 'time in')->sortBy('datetime');
    //             $timeOutLogs = $logs->where('description', 'time out')->sortByDesc('datetime');

    //             $firstTimeIn = $timeInLogs->first();
    //             $lastTimeOut = $timeOutLogs->first(); // This gets the last time out since we sorted desc

    //             if ($firstTimeIn && $lastTimeOut) {
    //                 $timeIn = Carbon::parse($firstTimeIn->datetime);
    //                 $timeOut = Carbon::parse($lastTimeOut->datetime);
                    
    //                 // Only calculate hours if time out is after time in
    //                 if ($timeOut->gt($timeIn)) {
    //                     $hoursWorked = floor($timeIn->diffInHours($timeOut));

    //                     $groupedData[$dateKey] = [
    //                         'time_in' => $timeIn->format('h:i A'),
    //                         'time_out' => $timeOut->format('h:i A'),
    //                         'hours_worked' => $hoursWorked,
    //                     ];

    //                     echo "Valid time in/out found - First In: {$timeIn->format('h:i A')}, Last Out: {$timeOut->format('h:i A')}, Hours: $hoursWorked\n";
    //                 } else {
    //                     $groupedData[$dateKey] = [
    //                         'time_in' => $timeIn->format('h:i A'),
    //                         'time_out' => $timeOut->format('h:i A'),
    //                         'hours_worked' => '—',
    //                     ];
    //                     echo "Invalid time range - Time out is before time in\n";
    //                 }
    //             } else {
    //                 $groupedData[$dateKey] = [
    //                     'time_in' => $firstTimeIn ? Carbon::parse($firstTimeIn->datetime)->format('h:i A') : '—',
    //                     'time_out' => $lastTimeOut ? Carbon::parse($lastTimeOut->datetime)->format('h:i A') : '—',
    //                     'hours_worked' => '—',
    //                 ];
    //                 echo "Incomplete logs - Missing " . (!$firstTimeIn ? "time in" : "time out") . "\n";
    //             }
    //         } else {
    //             $groupedData[$dateKey] = [
    //                 'time_in' => '—',
    //                 'time_out' => '—',
    //                 'hours_worked' => '—',
    //             ];
    //             echo "No logs found for this date\n";
    //         }
    //     }

    //     $totalHoursPerMonth = 0;
    //     foreach ($groupedData as $key => $value) {
    //         if ($value['hours_worked'] !== '—') {
    //             $totalHoursPerMonth += $value['hours_worked'];
    //             echo "Adding hours for $key: {$value['hours_worked']}\n";
    //         }
    //     }

    //     echo "\nFinal total hours for month: $totalHoursPerMonth\n";
        
    //     $records = [];
    //     foreach ($groupedData as $date => $data) {
    //         $records[] = [
    //             'date' => $date,
    //             'user' => Auth::user(),
    //             'time_in' => $data['time_in'],
    //             'time_out' => $data['time_out'],
    //             'hours_worked' => $data['hours_worked']
    //         ];
    //     }
        
    //     return view('users.dtr', [
    //         'user' => Auth::user(),
    //         'records' => $groupedData,
    //         'totalHoursPerMonth' => $totalHoursPerMonth,
    //         'selectedMonth' => $selectedMonth,
    //         'selectedYear' => $selectedYear,
    //         'pagination' => [
    //             'currentMonth' => [
    //                 'name' => $selectedDate->format('F Y'),
    //                 'month' => $selectedMonth,
    //                 'year' => $selectedYear
    //             ],
    //             'previousMonth' => [
    //                 'name' => $previousMonth->format('F Y'),
    //                 'month' => $previousMonth->month,
    //                 'year' => $previousMonth->year,
    //                 'url' => route('users.dtr', ['month' => $previousMonth->month, 'year' => $previousMonth->year])
    //             ],
    //             'nextMonth' => [
    //                 'name' => $nextMonth->format('F Y'),
    //                 'month' => $nextMonth->month,
    //                 'year' => $nextMonth->year,
    //                 'url' => route('users.dtr', ['month' => $nextMonth->month, 'year' => $nextMonth->year])
    //             ]
    //         ]
    //     ]);
    // }

    public function ShowAdminDtrSummary(Request $request)
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

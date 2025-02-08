<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function getRankings()
    {
        //READ ME!

        //computation in the backend
        //send to the frontend
        //the computation works by getting the total hours worked by the user
        //then the user will be ranked based on the total hours worked
        //the ranking will be based on the total hours worked
        //the ranking will be displayed in the frontend
        //the ranking will be displayed in the frontend in a table
        //the ranking will be displayed in the frontend in a chart
        
        //constraints is that the Ranking does not have a model
        //so the calculation is based on the history table
        //the calculation is based on the total hours worked by the user

        
        $selectedMonth = request('month', Carbon::now()->month);
        $selectedYear = request('year', Carbon::now()->year);

$groupedData = [];
$username = null;
$usr_id = null;
$hours_worked = 0;


$users = User::all();

foreach ($users as $user) {
    $userLogs = Histories::where('user_id', $user->id)
        ->whereYear('datetime', $selectedYear)
        ->whereMonth('datetime', $selectedMonth)
        ->orderBy('datetime', 'asc')
        ->get();
    
    $logsByDate = $userLogs->groupBy(function ($log) {
        return Carbon::parse($log->datetime)->format('Y-m-d');
    });

    $daysInMonth = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->daysInMonth;
    $totalHours = 0;

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $dateKey = Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('Y-m-d');
        
        if (isset($logsByDate[$dateKey])) {
            $logs = $logsByDate[$dateKey];
            $firstTimeIn = null;
            $lastTimeOut = null;
            $dailyHours = 0;
            
            foreach ($logs as $log) {
                if ($log->description === 'time in') {
                    $firstTimeIn = Carbon::parse($log->datetime);
                } elseif ($log->description === 'time out' && $firstTimeIn) {
                    $lastTimeOut = Carbon::parse($log->datetime);
                    $dailyHours += $firstTimeIn->diffInMinutes($lastTimeOut) / 60;
                    $firstTimeIn = null;
                }
            }
            
            $usr_id = $user->id;
            $username = $user->firstname;
            $hours_worked += floor($logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->diffInHours($logs->last()->datetime) : '—');
            
            // $groupedData[$user->id][$dateKey] = [
            //     'user_id' => $user->id,
            //     'time_in' => $logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->format('h:i A') : '—',
            //     'time_out' => $logs->last()->datetime ? Carbon::parse($logs->last()->datetime)->format('h:i A') : '—',
            // ];
            // $totalHours += floor($logs->first()->datetime ? Carbon::parse($logs->first()->datetime)->diffInHours($logs->last()->datetime) : '—');
        }
        
        if($usr_id != null){
            $groupedData[$usr_id] = [
                'user_id' => $usr_id,
                'hours_worked' => $hours_worked,
            ];
        }
    }
}

return $groupedData;
    }
}
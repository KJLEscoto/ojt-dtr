<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function download()
    {
        // Get current month and year
        $month = Carbon::now()->format('F Y');

        // Get the number of days in the current month
        $daysInMonth = Carbon::now()->daysInMonth;
        $days = range(1, $daysInMonth);

        $user = Auth::user();

        $full_name = $user->firstname . ' ' . substr($user->middlename, 0, 1) . '. ' . $user->lastname;
        $hoursThisMonth = str(20) . ' hours';

        $data = [
            'name' => $full_name,
            'position' => 'Intern',
            'hoursThisMonth' => $hoursThisMonth,
            'month' => $month,
            'days' => $days,
        ];

        $pdf = Pdf::loadView('pdf.dtr', $data);
        return $pdf->download('DTR_Report.pdf');
    }
}
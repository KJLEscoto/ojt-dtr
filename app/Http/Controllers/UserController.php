<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HistoryController;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Mail\EmailShiftNotification;

class UserController extends Controller
{

    //this function will return all the users data in the database
    public function index()
    {
        //get all user data
        $users = User::all();

        //return the users data to the view
        return view('users.profile.index', compact('users'));
    }

    public function showSettings()
    {
        $user = Auth::user();
        return view('users.settings', [
            'user' => $user,
        ]);
    }

    public function AdminScannerTimeCheck(Request $request, EmailController $emailController)
    {
        try {
            //initialized the success text
            $success_text = "";

            //get the user data from the qr code
            $userData = User::where('qr_code', $request->qr_code)->first();

            //initialized the histories object(table)
            $timeCheck = new Histories();

            //set the user id
            $timeCheck->user_id = $userData->id;

            //set the datetime
            //internet global time
            $timeCheck->datetime = Carbon::now()->timezone('Asia/Manila');

            //it will be depends if time in or time out
            if ($request->type == 'time_in') {

                //this will set the description to time in
                $timeCheck->description = 'time in';
                $success_text = "Time in checked successfully";
            } else if ($request->type == 'time_out') {

                //this will set the description to time out
                $timeCheck->description = 'time out';
                $success_text = "Time out checked successfully";
            }

            //save the data to the database
            $timeCheck->save();

            //mail the shift notification
            $sendShiftNotification = $emailController->EmailShiftNotification($userData, $timeCheck);

            //return the success text
            return response()->json(['success' => $success_text, 'valid' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'valid' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showDTR(DtrSummaryController $dtrSummaryController, Request $request)
    {
        try {

            //initialize the local variables
            //this variables only to be used in this function so it wont conflict with the global variables 
            $users = null;
            $histories = null;
            $records = [];

            //get the user access that is currently logged in
            $user_access = Auth::user();

            //get the total hours of the user
            //the return of this function is an array
            //eaxmple
            //$groupedData
            //$groupedData['Time in']
            //$groupedData['Time out']
            //$groupedData['Hours worked']
            $totalHours = $dtrSummaryController->DtrSummary($request);

            //check if the auth user is admin which is based on their role
            if ($user_access->role == 'admin') {

                //get the user history data with history relation
                $users = User::with('history')->get();

                //get the history data with user relation
                $histories = Histories::with('user')->get();

                //this lopp will parse the history data and the user data
                //and will return the data in an array
                foreach ($histories as $history) {
                    $user = $users->firstWhere('id', $history->user_id);
                    $records[] = [
                        'user' => $user,
                        'history' => $history,
                    ];
                }
            }

            //if the role is admin it will go to this page
            if ($user_access->role == 'admin') {
                return view('dtr.index', [
                    'records' => $records,
                    'type' => 'admin',
                ]);
            } else {

                //this data will be store in the requrest object
                $data = [
                    'year' => Carbon::now()->year,
                    'month' => Carbon::now()->month,
                ];

                //this will return the total hours of the user
                $request = new Request($data);

                //then the $request will be passed to the DtrSummary function
                $totalHours = $dtrSummaryController->DtrSummary($request);

                //then the $totalHours will be passed to the view dtr.index
                //with the data of array['type' => 'user', 'groupedData' => $totalHours]
                //dd($totalHours);
                return view('dtr.index', [
                    'type' => 'user',
                    'groupedData' => $totalHours,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'valid' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showProfile($id)
    {

        //access user with authenticated user
        $access_user = Auth::user();

        //this will find the user data with the id
        $users = User::find($id);

        //check if the role is either admin or anything else
        if ($access_user->role == 'admin') {

            //return response()->json(['users' => $users], Response::HTTP_INTERNAL_SERVER_ERROR);
            if (!(isset($users))) {
                return redirect()->route('admin.dashboard');
            }

            return view('users.profile.edit', [
                'user' => $users,
                'access_user' => $access_user,
            ]);
        } else {
            //check if the user is the same as the access user
            if ($access_user->id === $users->id) {
                return view('users.profile.edit', [
                    'user' => $users,
                    'access_user' => $access_user,
                ]);
            } else {
                return redirect()->route('users.profile.index');
            }
        }
    }

    public function AdminScannerValidation($qr_code)
    {
        try {
            $users = User::where('qr_code', $qr_code)->first();
            return response()->json(['user' => $users, 'valid' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'valid' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showAdminHistories()
    {
        $histories = Histories::all();
        return view('admin.histories', compact('histories'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->route('users.profile.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function showDashboard()
    {
        $users = Auth::user();

        //check if the user is admin
        if ($users->role == 'admin') {
            return $this->showAdminScanner();
        }

        //later if not admin
        //convert all the dateitme details
        $histories = $users->history()->latest()->get()->map(function ($history) {
            return [
                'description' => $history->description,
                'datetime' => Carbon::parse($history->datetime)->format('F j, Y'),
                'timeFormat' => Carbon::parse($history->datetime)->format('g:i A'),
            ];
        })->toArray();

        $history = new HistoryController();
        $totalScan = $history->UserTotalScan();
        $totalTimeIn = $history->UserTotalTimeIn();
        $totalTimeOut = $history->UserTotalTimeOut();
        $totalRegister = $history->UserTotalRegister();

        //dd($histories);

        return view('users.dashboard', [
            'user' => $users,
            'userTimeStarted' => Carbon::parse($users->starting_date)->format('F j, Y'),
            'totalScan' => $totalScan,
            'totalTimeIn' => $totalTimeIn,
            'totalTimeOut' => $totalTimeOut,
            'totalRegister' => $totalRegister,
            'histories' => $histories,
        ]);
    }

    public function showAdminScanner()
    {
        //$users = User::all();

        //$histories = $users->history()->latest()->get();

        $histories = Histories::all();
        $users = User::get();

        $rankingController = new RankingController();
        $groupedData = $rankingController->getRankings();

        //dd($histories);

        $history = new HistoryController();
        $totalScan = $history->TotalScan();
        $totalTimeIn = $history->TotalTimeIn();
        $totalTimeOut = $history->TotalTimeOut();
        $totalRegister = $history->TotalRegister();

        return view('admin.dashboard', [
            'user' => $users,
            'totalScans' => $totalScan,
            'totalTimeIn' => $totalTimeIn,
            'totalTimeOut' => $totalTimeOut,
            'totalRegister' => $totalRegister,
            'histories' => $histories,
            'groupedData' => $groupedData,
        ]);
    }

    public function showAdminHistory()
    {
        $histories = Histories::with('user')->get();
        $users = User::with('history')->get();

        //histories and users
        $records = [];

        foreach ($histories as $history) {
            $user = $users->firstWhere('id', $history->user_id);
            $records[] = [
                'user' => $user,
                'history' => $history,
            ];
        }

        //dd($records);

        return view('admin.histories', [
            'records' => $records,
        ]);
    }

    public function showAdminUsers()
    {
        $users = User::get();

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if (is_null($user)) {
            return back()->with('invalid', 'The inpud is invalid please try again!');
        }

        // Exclude user_id from the request data
        $data = $request->except('user_id');

        $user->update($data);
        return back()->with('success', 'The information update has been successful!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.profile.index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function searchUser(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', "%$search%")->get();
        return view('admin.users', compact('users'));
    }

    public function searchHistory(Request $request)
{
    $search = $request->input('query');

    $users = User::select('id', 'firstname', 'middlename', 'lastname', 'email')
        ->where('firstname', 'like', "%$search%")
        ->orWhere('lastname', 'like', "%$search%")
        ->orWhere('middlename', 'like', "%$search%")
        ->orWhere('email', 'like', "%$search%")
        ->get();

    $records = collect();

    if ($users->isNotEmpty()) {
        $userIds = $users->pluck('id');
        $histories = Histories::whereIn('user_id', $userIds)->get();

        foreach ($histories as $history) {
            $user = $users->firstWhere('id', $history->user_id);
            $records->push([
                'user' => $user,
                'history' => $history,
            ]);
        }
    }

    // Search in histories description
    $historiesFromDescription = Histories::where('description', 'like', "%$search%")->get();

    foreach ($historiesFromDescription as $history) {
        $user = User::find($history->user_id);
        $exists = $records->contains(fn($record) => $record['history']->id === $history->id);
        
        if (!$exists) {
            $records->push([
                'user' => $user,
                'history' => $history,
            ]);
        }
    }

    // Search in histories datetime
    $historiesFromDatetime = Histories::where('datetime', 'like', "%$search%")->get();

    foreach ($historiesFromDatetime as $history) {
        $user = User::find($history->user_id);
        $exists = $records->contains(fn($record) => $record['history']->id === $history->id);
        
        if (!$exists) {
            $records->push([
                'user' => $user,
                'history' => $history,
            ]);
        }
    }

    // Paginate results
    $perPage = 10;
    $currentPage = request()->get('page', 1);
    $paginatedRecords = $records->slice(($currentPage - 1) * $perPage, $perPage)->values();

    return response()->json([
        'success' => true,
        'records' => $paginatedRecords,
        'total' => $records->count(),
        'perPage' => $perPage,
        'currentPage' => (int) $currentPage,
    ]);
}

}

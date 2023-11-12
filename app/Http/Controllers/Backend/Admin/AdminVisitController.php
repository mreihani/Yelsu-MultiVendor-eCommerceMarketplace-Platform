<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use App\Models\ShetabitVisit;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;


class AdminVisitController extends Controller
{
    public function AllVisit() {

        $adminData = auth()->user();
        $visits = ShetabitVisit::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.backend.visit.visits_all', compact('adminData', 'visits'));
    }

    public function AdminVisitViewSearch(Request $request) {

        $adminData = auth()->user();

        $query_string = Purify::clean($request->q);
  
        $users = User::where([
           ['username', 'like', "%{$query_string}%"], 
        ])->OrWhere([
            ['firstname', 'like', "%{$query_string}%"],
        ])->OrWhere([
            ['lastname', 'like', "%{$query_string}%"],
        ])->OrWhere([
            ['email', 'like', "%{$query_string}%"],
        ])->get();

        $visits = ShetabitVisit::whereIn('visitor_id', $users->pluck("id"))->get();
        
        return view('admin.backend.visit.visits_all', compact('adminData', 'visits'));
    }

    public function AdminVisitStatusView($id) {
        $adminData = auth()->user();

        // $visits = ShetabitVisit::orderBy('created_at', 'desc')->paginate(10);

        $data = User::find($id);

        return view('admin.backend.visit.visit_status_view', compact('adminData', 'data'));
    }
}

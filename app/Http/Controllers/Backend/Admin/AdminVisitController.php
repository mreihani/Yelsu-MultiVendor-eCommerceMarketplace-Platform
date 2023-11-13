<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use App\Models\ShetabitVisit;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;


class AdminVisitController extends Controller
{
    public function VisitAll() {

        $adminData = auth()->user();
        $visits = ShetabitVisit::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.backend.visit.visit_list.visits_all', compact('adminData', 'visits'));
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

        $visits = ShetabitVisit::whereIn('visitor_id', $users->pluck("id"))->orderBy('created_at', 'desc')->get();
        
        return view('admin.backend.visit.visit_list.visits_all', compact('adminData', 'visits'));
    }

    public function AdminVisitId($id) {
        $adminData = auth()->user();
        
        $visitor_id = (int) Purify::clean($id);
        $visits = User::find($visitor_id)->visits;

        return view('admin.backend.visit.visit_list.visits_all', compact('adminData', 'visits'));
    }

    public function AdminVisitStatusView($id) {

        $adminData = auth()->user();
        $data = User::find($id);

        return view('admin.backend.visit.visit_list.visit_status_view', compact('adminData', 'data'));
    }

    public function ChartAll() {

        $adminData = auth()->user();
        $all_visits = ShetabitVisit::all();

        $visits_per_day = ShetabitVisit::determine_visits_per_day_number($all_visits);
        $unique_visits_per_day = ShetabitVisit::determine_unique_visits_per_day_number($all_visits);

        return view('admin.backend.visit.visit_chart.visit_chart', compact('adminData', 'visits_per_day', 'unique_visits_per_day'));
    }
    
}

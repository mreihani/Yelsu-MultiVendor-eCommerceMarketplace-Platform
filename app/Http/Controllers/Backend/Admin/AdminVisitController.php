<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use App\Models\ShetabitVisit;
use Illuminate\Support\Facades\DB;
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

        $query_string = Purify::clean($request['query']);
  
        $query = User::search($query_string);
        $query->limit = 10000;
        $users_id_array = $query->get()->pluck('id');

        $visits = ShetabitVisit::whereIn('visitor_id', $users_id_array)->orderBy('created_at', 'desc')->paginate(10);
        
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

    public function ChartUniqueVisitors() {

        $adminData = auth()->user();
       
        $all_visits = ShetabitVisit::select('ip', 'created_at', 'country_name')->get();
        $unique_visits_per_day = ShetabitVisit::determine_unique_visits_per_day_number($all_visits);
        $all_visits_iran = $all_visits->where('country_name', 'Iran');
        $unique_visits_per_day_iran = ShetabitVisit::determine_unique_visits_per_day_number($all_visits_iran);

        return view('admin.backend.visit.visit_chart.unique-visitors', compact('adminData', 'unique_visits_per_day', 'unique_visits_per_day_iran'));
    }

    public function ChartVisits() {

        $adminData = auth()->user();
       
        $all_visits = ShetabitVisit::select('ip', 'created_at', 'country_name')->get();
        $visits_per_day = ShetabitVisit::determine_visits_per_day_number($all_visits);
        $all_visits_iran = $all_visits->where('country_name', 'Iran');
        $visits_per_day_iran = ShetabitVisit::determine_visits_per_day_number($all_visits_iran);

        return view('admin.backend.visit.visit_chart.visits', compact('adminData', 'visits_per_day', 'visits_per_day_iran'));
    }
    
}

<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;

use App\Models\Cvisitww;
use App\Models\Cvisitiran;
use App\Models\Cvisitunique;
use Illuminate\Http\Request;
use App\Models\ShetabitVisit;
use App\Models\Cvisituniqueiran;
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
       
        $unique_visits_per_day = Cvisitunique::all()->keyBy('date')->map(function($visits_item){
            return $visits_item->visits_count;
        });

        $unique_visits_per_day_iran = Cvisituniqueiran::all()->keyBy('date')->map(function($visits_item){
            return $visits_item->visits_count;
        });

        return view('admin.backend.visit.visit_chart.unique-visitors', compact('adminData', 'unique_visits_per_day', 'unique_visits_per_day_iran'));
    }

    public function ChartVisits() {

        $adminData = auth()->user();
       
        $visits_per_day = Cvisitww::all()->keyBy('date')->map(function($visits_item){
            return $visits_item->visits_count;
        });

        $visits_per_day_iran = Cvisitiran::all()->keyBy('date')->map(function($visits_item){
            return $visits_item->visits_count;
        });

        return view('admin.backend.visit.visit_chart.visits', compact('adminData', 'visits_per_day', 'visits_per_day_iran'));
    }
    
}

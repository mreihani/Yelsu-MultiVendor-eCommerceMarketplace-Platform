<?php

namespace App\Console\Commands\VisitsUpdateChart;

use Carbon\Carbon;
use App\Models\Cvisitunique;
use App\Models\ShetabitVisit;
use Illuminate\Console\Command;

class UpdateVisitorsChartUniqueWw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-visitors-chart-unique-ww';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get and update all data from shetabit_visit table
        $today_date = jdate()->format('Y/m/d');
        $all_visits = ShetabitVisit::select('country_name', 'created_at', 'ip')->whereNot('country_name', "Iran")->get();
        $all_visits_by_date = ShetabitVisit::determine_visits_per_day_obj($all_visits);
        foreach ($all_visits_by_date as $date => $visit) {
            $visit_item_by_date = Cvisitunique::where("date", $date)->get();
            if(!count($visit_item_by_date) && ($today_date != $date)) {
                Cvisitunique::create([
                    "visits_count" =>  count($visit->pluck('ip')->unique()),
                    "date" => $date,
                ]);
            }
        }

        // get and update only for the yesterday visits - for performance issues
        // $lastday_jdate = jdate()->subDays(1)->format('Y/m/d');
        // $lastday = Carbon::now()->subDays(1)->format('Y/m/d');
        // $all_visits_count = ShetabitVisit::select('country_name', 'created_at', 'ip')
        // ->whereDate('created_at', '=', $lastday)
        // ->whereNot('country_name', 'Iran')
        // ->get()
        // ->pluck('ip')
        // ->unique()
        // ->count();
        // $visit_item_by_date = Cvisitunique::where("date", $lastday_jdate)->get();
        // if(!count($visit_item_by_date)) {
        //     Cvisitunique::create([
        //         "visits_count" => $all_visits_count,
        //         "date" => $lastday_jdate,
        //     ]);
        // }
    }
}

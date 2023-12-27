<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShetabitVisit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'visitor_id');
    }

    public function determine_ip_location() {

        return "
                نام کشور: $this->country_name
                نام استان: $this->province_name 
                نام شهر: $this->city_name
            ";
    }

    // دریافت کالکشنی از داده های بازدید دیتابیس و مرتب سازی بر اساس تاریخ روز
    public function scopeDetermine_visits_per_day_obj($query, $visits) {

        $visits_array = [];

        $visits_array = $visits->groupBy(function($visit) {
            return jdate($visit->created_at)->format('Y/m/d');
        });

        return $visits_array;
    }

    // متد بالا ولی به جای شیء میاد تعداد بازدید در روز رو بر می گرداند
    public function scopeDetermine_visits_per_day_number($query, $visits) {

        $visits_array = [];

        $visits_array = $this->determine_visits_per_day_obj($visits)->map(function($visits_item){
            return count($visits_item);
        });

        return $visits_array;
    }

    // دریافت تعداد بازدید یونیک دیتابیس و مرتب سازی بر اساس تاریخ روز
    public function scopeDetermine_unique_visits_per_day_number($query, $visits) {

        $visits_array = [];

        $visits_array = $this->determine_visits_per_day_obj($visits)->map(function($visits_item){
            return count($visits_item->pluck('ip')->unique());
        });

        return $visits_array;
    }

}



// این موارد رو برای کنترل ورود کاربران داشته باش
// dd(App\Models\ShetabitVisit::all());
// dd(auth()->user()->visits()->get());
// dd(App\Models\ShetabitVisit::first()->user);
// dd(auth()->user()->isUserOnline());
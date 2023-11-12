<?php

namespace App\Models;

use App\Models\User;
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

        $location_obj = \Location::get($this->ip);

        return "
                نام کشور: $location_obj->countryName
                نام منطقه: $location_obj->regionName 
                نام شهر: $location_obj->cityName 
                عرض جغرافیایی: $location_obj->latitude 
                طول جغرافیایی: $location_obj->longitude 
            ";
    }
}



// این موارد رو برای کنترل ورود کاربران داشته باش
// dd(App\Models\ShetabitVisit::all());
// dd(auth()->user()->visits()->get());
// dd(App\Models\ShetabitVisit::first()->user);
// dd(auth()->user()->isUserOnline());
<?php

namespace App\Models;

use App\Models\ScheduleDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function schedule_date() {
        return $this->hasMany(ScheduleDate::class);
    }

    public function specific_deliver_date() {
        return $this->schedule_date()->whereDate('specific_deliver_date_format', '>=', now())->get()->pluck('specific_deliver_date');
    }

    public function specific_deliver_capacity() {
        return $this->schedule_date()->whereDate('specific_deliver_date_format', '>=', now())->get()->pluck('specific_deliver_capacity');
    }
}

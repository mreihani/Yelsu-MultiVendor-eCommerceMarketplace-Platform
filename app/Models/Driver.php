<?php

namespace App\Models;

use App\Models\Fvehicle;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fvehicle() {
        return $this->belongsTo(Fvehicle::class);
    }
}
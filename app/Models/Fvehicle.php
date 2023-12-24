<?php

namespace App\Models;

use App\Models\Fvehicle;
use App\Models\Freightageloadertype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fvehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function freightageloadertype() {
    //     return $this->belongsToMany(Freightageloadertype::class, "freightageloadertype_id", "id");
    // }

    public function freightageloadertype() {
        return $this->belongsToMany(Freightageloadertype::class);
    }

}


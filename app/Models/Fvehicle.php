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

    public function freightageLoaderType() {
        return $this->belongsTo(Freightageloadertype::class, "freightageloadertype_id", "id");
    }

}


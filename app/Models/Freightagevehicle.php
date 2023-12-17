<?php

namespace App\Models;

use App\Models\Freightagevehicle;
use App\Models\Freightageloadertype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Freightagevehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function freightageLoaderType() {
        return $this->belongsTo(Freightageloadertype::class, "freightageloadertype_id", "id");
    }

}


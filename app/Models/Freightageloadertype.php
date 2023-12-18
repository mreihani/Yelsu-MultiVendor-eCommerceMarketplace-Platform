<?php

namespace App\Models;

use App\Models\Freightagetype;
use App\Models\Freightageloadertype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Freightageloadertype extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getParentName() {
        return $this->parent != 0 ? $this::find($this->parent)->value : "اصلی";
    }

    public function freightageType() {
        return $this->belongsTo(Freightagetype::class, "freightagetype_id", "id");
    }

    public function getChildren() {
        return $this->hasMany(Freightageloadertype::class, 'parent', 'id');
    }
}


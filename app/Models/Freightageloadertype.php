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

    public function scopeGetFreightageLoaderTypeLastItems($query, $freightage_object_array) {
        $last_items_array = [];
        foreach ($freightage_object_array as $freightage_object_item) {
            $child_item = $freightage_object_item->getChildren()->get();

            if(!count($child_item)) {
                $last_items_array[] = $freightage_object_item;
            }
        }

        return $last_items_array;
    }

    public function scopeGetFreightageTypeValuesByIds($query, $freightage_loader_types) {

        $freightage_object_array = [];

        foreach ($freightage_loader_types as $freightage_loader_item) {
            $freightage_object_array[] = $this->find($freightage_loader_item);
        }

        return $freightage_object_array;
    }
}


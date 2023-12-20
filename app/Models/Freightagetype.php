<?php

namespace App\Models;

use App\Models\Freightageloadertype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Freightagetype extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getParentName() {
        return $this->parent != 0 ? $this::find($this->parent)->value : "اصلی";
    }

    public function freightageLoaderType() {
        return $this->hasMany(Freightageloadertype::class);
    }

    public function freightageLoaderTypeLastItems() {
        $freightageLoaderTypeItems = $this->freightageLoaderType()->get();

        $last_items_array = [];
        foreach ($freightageLoaderTypeItems as $freightageLoaderTypeItem) {
            $child_item = $freightageLoaderTypeItem->getChildren()->get();

            if(!count($child_item)) {
                $last_items_array[] = $freightageLoaderTypeItem;
            }
        }

        return $last_items_array;
    }

    public function getChildren() {
        return $this->hasMany(Freightagetype::class, 'parent', 'id');
    }

    public function scopeGetFreightageParentItems($query, $freightage_type_array) {
        $parent_items = $this->where('parent', 0)->get();
        
        $parent_items_array = [];
        foreach ($parent_items as $parent_item) {
            if(in_array($parent_item->id, $freightage_type_array)) {
                $parent_items_array[] = $parent_item;
            }
        }

        return $parent_items_array;
    }

    public function scopeGetFreightageTypeValuesByIds($query, $freightage_type_array) {
        $freightage_array = explode(",", $freightage_type_array);

        $freightage_value_array = [];
        foreach ($freightage_array as $freightage_id) {
            $freightage_value_array[] = $this->find($freightage_id)->value;
        }

        return $freightage_value_array;
    }

}

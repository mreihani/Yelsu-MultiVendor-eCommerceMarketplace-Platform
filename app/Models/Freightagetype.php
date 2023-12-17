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
            $child_item = $freightageLoaderTypeItem->child()->get();

            if(!count($child_item)) {
                $last_items_array[] = $freightageLoaderTypeItem;
            }
        }

        return $last_items_array;
    }

}

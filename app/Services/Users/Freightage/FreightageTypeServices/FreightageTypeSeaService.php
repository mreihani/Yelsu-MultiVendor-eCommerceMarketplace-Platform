<?php

namespace App\Services\Users\Freightage\FreightageTypeServices;

use App\Models\Freightageloadertype;

class FreightageTypeSeaService {

    public $id;
    public $parent;
    public $value;
    public $description;
    public static $class_obj_arr;

    public function __construct($id, $parent, $value, $description) {
        $this->id = $id;
        $this->parent = $parent;
        $this->value = $value;
        $this->description = $description;
    }
   
    public static function getFreightageLoaderTypeSeaArray() {

        $freightage_loader_type_sea_array = config('yelsu_freightage_array.loader_type.sea');
        // $freightage_loader_type_sea_array = Freightageloadertype::where("freightagetype_title", "sea")->get()->toArray();

        return self::getClassObjectArray($freightage_loader_type_sea_array);
    }

    private static function getClassObjectArray($freightage_array) {
        $class_obj_arr = [];

        foreach ($freightage_array as $type_object) {
            $class_obj_arr[] = new FreightageTypeSeaService($type_object['id'], $type_object['parent'], $type_object['value'], $type_object['description']);
        }

        self::$class_obj_arr = $class_obj_arr;

        return $class_obj_arr;
    }

    public function getChildren() {

        $freightage_children = [];
        $class_obj_arr = self::$class_obj_arr;

        foreach ($class_obj_arr as $freightage_item) {
            if($freightage_item->parent == $this->id) {
                $freightage_children[] = $freightage_item;
            }
        }

        return $freightage_children;
    }

    public static function findById($id) {
        $freightage_loader_type_sea_array = self::getFreightageLoaderTypeSeaArray();

        foreach ($freightage_loader_type_sea_array as $freightage_type_item) {
            if($freightage_type_item->id === (int) $id) {
              return new FreightageTypeSeaService($freightage_type_item->id, $freightage_type_item->parent, $freightage_type_item->value, $freightage_type_item->description);
            }
        }
    }

    public static function getFreightageTypeValuesByIds($id_string_db) {
        $freightage_type_value_array = [];
        $freightage_type_array = self::getFreightageLoaderTypeSeaArray();

        if($id_string_db) {
            $freightage_type_db_array = explode(",", $id_string_db);
            $freightage_type_value_array = [];
            foreach ($freightage_type_db_array as $freightage_type_db_item) {
                $freightage_type_value_array[] = self::findById((int) $freightage_type_db_item)->value;
            }
        }

        return $freightage_type_value_array;
    }

    public static function getFreightageSelectedItems($id_array) {
        $selected_items_array = [];
        $last_item_array = [];

        foreach ($id_array as $item) {
            $children = self::findById($item)->getChildren();

            if(!count($children)) {
                $last_item_array[] = self::findById($item);
            }
        }

        return $last_item_array;
    }

}


<?php

namespace App\Services\Users\Freightage\FreightageTypeServices;

use App\Models\Freightagetype;

class FreightageTypeService {

    public $id;
    public $parent;
    public $value;
    public static $class_obj_arr;

    public function __construct($id, $parent, $value) {
        $this->id = $id;
        $this->parent = $parent;
        $this->value = $value;
    }
   
    public static function getFreightageTypeArray() {

        //$freightage_type_array = config('yelsu_freightage_array.type');
        $freightage_type_array = Freightagetype::all()->toArray();

        return self::getClassObjectArray($freightage_type_array);
    }

    private static function getClassObjectArray($freightage_array) {
        $class_obj_arr = [];

        foreach ($freightage_array as $type_object) {
            $class_obj_arr[] = new FreightageTypeService($type_object['id'], $type_object['parent'], $type_object['value']);
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
        $freightage_type_array = self::getFreightageTypeArray();

        foreach ($freightage_type_array as $freightage_type_item) {
            if($freightage_type_item->id === (int) $id) {
              return new FreightageTypeService($freightage_type_item->id, $freightage_type_item->parent, $freightage_type_item->value);
            }
        }
    }

    public static function getFreightageTypeValuesByIds($id_string_db) {
        $freightage_type_value_array = [];
        $freightage_type_array = self::getFreightageTypeArray();

        if($id_string_db) {
            $freightage_type_db_array = explode(",", $id_string_db);
            $freightage_type_value_array = [];
            foreach ($freightage_type_db_array as $freightage_type_db_item) {
                $freightage_type_value_array[] = self::findById((int) $freightage_type_db_item)->value;
            }
        }

        return $freightage_type_value_array;
    }
    
    public static function getFreightageParentItems($id_array) {
        $parent_item_array = [];

        foreach ($id_array as $item) {
            if(self::findById($item)->parent == 0) {
                $parent_item_array[] = self::findById($item);
            }
        }

        return $parent_item_array;
    }
}


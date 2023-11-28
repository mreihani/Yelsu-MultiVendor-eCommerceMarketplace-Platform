<?php

namespace App\Services\Users\Freightage\FreightageTypeServices;

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

        $freightage_type_array = config('yelsu_freightage_array.type');

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

}


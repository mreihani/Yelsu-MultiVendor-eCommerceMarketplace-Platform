<?php

namespace App\Services\Users\Driver\DriverTypeServices;

class DriverTypeRoadService {

    public $id;
    public $parent;
    public $value;
    public static $class_obj_arr;

    public function __construct($id, $parent, $value) {
        $this->id = $id;
        $this->parent = $parent;
        $this->value = $value;
    }

    public static function getDriverLoaderTypeRoadArray() {

        $driver_loader_type_road_array = config('yelsu_driver_array.loader_type.road');

        return self::getClassObjectArray($driver_loader_type_road_array);
    }

    private static function getClassObjectArray($driver_array) {
        $class_obj_arr = [];

        foreach ($driver_array as $type_object) {
            $class_obj_arr[] = new DriverTypeRoadService($type_object['id'], $type_object['parent'], $type_object['value']);
        }

        self::$class_obj_arr = $class_obj_arr;

        return $class_obj_arr;
    }

    public function getChildren() {

        $driver_children = [];
        $class_obj_arr = self::$class_obj_arr;

        foreach ($class_obj_arr as $driver_item) {
            if($driver_item->parent == $this->id) {
                $driver_children[] = $driver_item;
            }
        }

        return $driver_children;
    }

}


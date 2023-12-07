<?php

namespace App\Services\Categories\GetCategoryByStringIds;

use App\Models\Category;

class GetCategoryByStringIds {

    public static function getCategoryByIds($category_ids) {
        $category_id_array = explode(",", $category_ids);
        
        return Category::find($category_id_array);
    }
}
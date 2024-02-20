<?php

namespace App\Services\Categories\GetMegaMenuCategories;
use App\Models\Category;

class GetDynamicMegaMenuMobile { 

    public function execute() {

        $megaMenuCategories = [];

        $parentCategories = Category::where('parent', 0)->get();
        
        foreach ($parentCategories as $parentCategory) {
            $categoryCount = $parentCategory->child()->get()->count();

            $chunkSubCategories = [];

            foreach($parentCategory->child()->get() as $categoryChunkItem) {

                $categoryChunkItemChildrenArray = [];

                foreach ($categoryChunkItem->child()->get() as $categoryChunkItemChildren) {
                    $categoryChunkItemChildrenArray[] = [
                        'category_id' => $categoryChunkItemChildren->id,
                        'category_name' => $categoryChunkItemChildren->category_name,
                        'child' => [],
                    ];
                }

                $chunkSubCategories[] = [
                    'category_id' => $categoryChunkItem->id,
                    'category_name' => $categoryChunkItem->category_name,
                    'img_src' => !empty($categoryChunkItem->category_image) ? asset($categoryChunkItem->category_image) : asset('storage/upload/no_image.jpg'),
                    'child' => $categoryChunkItemChildrenArray
                ];
            }

            $megaMenuCategories[] = [
                'category_id' => $parentCategory->id,
                'category_name' => $parentCategory->category_name,
                'img_src' => !empty($parentCategory->category_image) ? asset($parentCategory->category_image) : asset('storage/upload/no_image.jpg'),
                'child' => $chunkSubCategories
            ];
          
        }

        return $megaMenuCategories;
    }
}


<?php

namespace App\Services\Categories\GetMegaMenuCategories;
use App\Models\Category;

class GetDynamicMegaMenuDesktop { 

    public function execute() {

        $parentCategories = Category::where('parent', 0)->get();
        
        $megaMenuCategories = [];
        foreach ($parentCategories as $parentCategory) {
            $categoryCount = $parentCategory->child()->get()->count();

            $chunkIterationNumber = 1;
            while (true) {
                if ($categoryCount < 4 * $chunkIterationNumber) break;
                $chunkIterationNumber++;
            }
           
            if($categoryCount) {
                
                $chunkCategories = [];

                foreach($parentCategory->child()->get()->chunk($chunkIterationNumber) as $categoryChunkItem) {

                    $chunkSubCategories = [];

                    foreach ($categoryChunkItem as $categoryChunkItemLoop) {
                        $categoryChunkItemChildrenArray = [];
                        
                        foreach ($categoryChunkItemLoop->child()->get() as $categoryChunkItemChildren) {
                            $categoryChunkItemChildrenArray[] = [
                                'category_id' => $categoryChunkItemChildren->id,
                                'category_name' => $categoryChunkItemChildren->category_name,
                            ];
                        }

                        $chunkSubCategories[] = [
                            'category_id' => $categoryChunkItemLoop->id,
                            'category_name' => $categoryChunkItemLoop->category_name,
                            'img_src' => !empty($categoryChunkItemLoop->category_image) ? asset($categoryChunkItemLoop->category_image) : asset('storage/upload/no_image.jpg'),
                            'child' => $categoryChunkItemChildrenArray
                        ];
                    }

                    $chunkCategories[] = [
                        'child' => $chunkSubCategories,
                    ];
                }

                $megaMenuCategories[] = [
                    'category_id' => $parentCategory->id,
                    'category_name' => $parentCategory->category_name,
                    'img_src' => !empty($parentCategory->category_image) ? asset($parentCategory->category_image) : asset('storage/upload/no_image.jpg'),
                    'child' => $chunkCategories
                ];
            }
        }

        return $megaMenuCategories;
    }
}


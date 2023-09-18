<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
  use HasFactory;
  protected $guarded = [];


  public function child()
  {
    return $this->hasMany(Category::class, 'parent', 'id');
  }

  public function relatedChild()
  {
    return $this->hasMany(Category::class, 'parent', 'id');
  }

  public function allChildren()
  {
    $item = collect();
    $childArr = $this->child;

    foreach ($childArr as $value) {
      if (count($value->child)) {
        $item->push($value->child);
      }
    }

    $childArr->push($item);
    $item = Arr::flatten($item);

    return $item;
  }

  public function parentCategory($id)
  {
    return $this->find($id) ? $this->find($id)->category_name : "";
  }

  public function parentCategoryExists($id)
  {
    $parent_id = $this->find($id)->parent;
    return ! ! $this->where('id', $parent_id)->exists();
  }

  public function products()
  {
    return $this->belongsToMany(Product::class, 'category_products');
  }

  public function productsRandom()
  {
    return $this->belongsToMany(Product::class, 'category_products')->inRandomOrder();
  }

  public function findRootCategory($id)
  {
    $categories = $this->latest()->get();
    $category_by_id = $this->find($id);
    foreach ($categories as $categoryItem) {
      if ($category_by_id->parent == 0) {
        $root_catgory_obj = $category_by_id;
        break;
      } else {
        $category_by_id = $this->find($category_by_id->parent);
      }
    }

    return $root_catgory_obj;
  }

  // با استفاده از این متد، اگر یک آرایه از ای دی دسته بندی بدی، بهت روت اش رو برمیگردونه، استاتیک هم هست
  public function scopeFindRootCategoryArray($query, $category_id_array) {
    $root_catgory_obj_array = [];
    $categories = $this->latest()->get();
    foreach ($category_id_array as $category_id) {
        $category_by_id = $this->find($category_id);
        foreach ($categories as $categoryItem) {
            if ($category_by_id->parent == 0) {
              $root_catgory_obj = $category_by_id;
              break;
            } else {
              $category_by_id = $this->find($category_by_id->parent);
            }
        }
        $root_catgory_obj_array[] = $root_catgory_obj;
    }
    $root_catgory_obj_array = array_unique($root_catgory_obj_array);
    return $root_catgory_obj_collection = collect($root_catgory_obj_array);
  }

}
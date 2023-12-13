<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
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
    $childArr = $this->child;

    $children_array = [];
    foreach ($childArr as $childItem) {
      if (count($childItem->child)) {
        $children_array[] = $childItem->child;
      }
    }

    array_push($children_array, $childArr);

    $children_array = Arr::flatten($children_array);

    return $children_array;
  }

  public function allChildrenIds()
  {
    $children_array = [];

    foreach ($this->allChildren() as $item) {
      $children_array[] = $item->id;
    }

    return $children_array;
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

  public function scopeCategoryExists($query, $id) {
    return ! ! $this->where('id', $id)->exists();
  }

  public function products()
  {
    return $this->belongsToMany(Product::class, 'category_products');
  }

  public function productsRandom()
  {
    return $this->belongsToMany(Product::class, 'category_products')->inRandomOrder();
  }

  public function attributes()
  {
    return $this->hasMany(Attribute::class);
  }

  // این متد از متد پایینی استفاده می کنه برای برگردوندن یک آیدی کتگوری تکی، ورودیش حتما باید تک آیتم باشه نه آرایه
  public function scopeFindRootCategory($query, $id)
  {
    $id = array($id);
    return $this->findRootCategoryArray($id)[0];
  }

  // با استفاده از این متد، اگر یک آرایه از ای دی دسته بندی بدی، بهت آرایه ای از روت ها اش رو برمیگردونه، استاتیک هم هست
  public function scopeFindRootCategoryArray($query, $category_id_array) {
    $root_catgory_obj_array = [];
    $categories = $this->latest()->get();
    foreach ($category_id_array as $category_id) {

        if(empty($this->find($category_id))) {
            break;
        }

        $category_by_id = $this->find($category_id);
        foreach ($categories as $categoryItem) {
            if ($category_by_id->parent == 0) {
              $root_catgory_obj = $category_by_id;
              break;
            } else {
              $category_by_id = !empty($this->find($category_by_id->parent)) ? $this->find($category_by_id->parent) : $category_by_id;
            }
        }
        $root_catgory_obj_array[] = $root_catgory_obj;
    }
    
    $root_catgory_obj_array = array_unique($root_catgory_obj_array);
    return $root_catgory_obj_collection = collect($root_catgory_obj_array);
  }

  // این متد استاتیک یک لیست دسته بندی دریافت میکنه و بررسی می کنه آیا دسته بندی والد این ها تکرار شده است یا خیر
  public function scopeDuplicatedParentCategory($query, $category_id_array) {
    $parent_id_arr = [];
    foreach ($category_id_array as $category_item_id) {
        $parent_id_arr[] = !empty($this->find($category_item_id)->parent) ? $this->find($category_item_id)->parent : NULL;
    }

    if(sizeof(array_unique($parent_id_arr)) != sizeof($parent_id_arr)) {
        return true;
    }

    return false;
  }

}
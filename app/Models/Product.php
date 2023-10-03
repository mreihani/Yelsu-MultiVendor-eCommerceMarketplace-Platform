<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\AttributeItem;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    public function retailer()
    {
        return $this->belongsTo(User::class, 'retailer_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function attribute_items()
    {
        return $this->belongsToMany(AttributeItem::class)->withPivot('attribute_item_id', 'attribute_value_id','attribute_value');
    }

    public function ScopeCheckIfAttributeHasChanged($query, $incoming_attributes, $product_id) {
        $product = Product::find($product_id);
        $product_attributes_array = $product->attributes()->get();
        
        foreach ($product_attributes_array as $key => $attribute) {
            foreach ($incoming_attributes as $attr_key => $attribute_item) {
                if($attribute->attribute_type == "dropdown" && $attr_key == $attribute->id && $attribute->pivot->value_id != (int) $attribute_item['value_id']) {
                    return true;
                } elseif($attribute->attribute_type == "input_field" && $attr_key == $attribute->id && $attribute->pivot->value != $attribute_item['value']) {
                    return true;
                }
            }
        }
        
        // اینجا چک می کنه از بین ویژگی هایی که هیچکدام نیستن، کدوم یکی جدید اضافه شده
        $incomingValueArray = [];
        foreach ($incoming_attributes as $incomingKey => $incomingValue) {
            if($incomingValue['value_id'] != "none") {
                $incomingValueArray[] = $incomingKey;
            }
        }
        if(array_diff($incomingValueArray, $product_attributes_array->pluck("id")->toArray())) {
            return true;
        }

        return false;
    }
}
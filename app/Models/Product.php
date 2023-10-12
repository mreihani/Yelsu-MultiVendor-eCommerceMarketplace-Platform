<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeItem;
use App\Models\AttributeValue;
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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('attribute_item_id', 'attribute_value_id','attribute_value');
    }

    public function attribute_items_obj_array() {

        $product_attributes_array = $this->attributes()->pluck('attribute_item_id')->unique();
        $product_attributes_array_pivot = [];
        $attribute_loop_array = [];

        foreach ($product_attributes_array as $product_attributes_item) {

            foreach ($this->attributes()->where('attribute_item_id', $product_attributes_item)->get() as $attribute_item) {
                $attribute_loop_array[$product_attributes_item]['attribute_value_obj'][] = AttributeValue::find($attribute_item->pivot->attribute_value_id);
                $attribute_loop_array[$product_attributes_item]['attribute_value'] = $attribute_item->pivot->attribute_value;
            }
            
        }
       
        return $attribute_loop_array;
    }
    
    public function determine_product_currency() {
        $currency_type = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "currency") {
                foreach ($attribute_value_array['attribute_value_obj'] as $attribute_value_item) {
                    if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                        $currency_type = $attribute_value_item->value;
                    }
                }
            }
        }
        return $currency_type;
    }

    public function ScopeCheckIfAttributeHasChanged($query, $incoming_attributes, $product_id) {

        // آرایه برای بررسی موارد جدیدی که اضافه می شود
        $incomingValueArray = [];

        $product = Product::find($product_id);
        
        // تهیه یک لیست از ستون های پیوت مرتبط به محصول
        $product_attributes_array = $product->attributes()->get();
        $product_attributes_array_pivot = [];
        foreach ($product_attributes_array as $key => $product_attributes_item) {
            $product_attributes_array_pivot[] = [
            'attribute_item_id' => AttributeItem::find($product->attributes()->pluck('attribute_item_id')[$key]),
            'attribute_value_id' => AttributeValue::find($product->attributes()->pluck('attribute_value_id')[$key]),
            'attribute_value' => $product->attributes()->pluck('attribute_value')[$key]
        ];
        }
        // تهیه یک لیست از ستون های پیوت مرتبط به محصول
       
        foreach ($product_attributes_array_pivot as $key => $pivotTable) {

            // بررسی موارد دیتابیس و موارد دریافتی
            foreach (collect($incoming_attributes)->first() as $attr_key => $attribute_item) {

                // بررسی ویژگی های از پیش تعیین شده غیر چندگانه
                if($pivotTable['attribute_item_id']->attribute_item_type == "dropdown" && !$pivotTable['attribute_item_id']->multiple_selection_attribute && $attr_key == $pivotTable['attribute_item_id']->id && $pivotTable['attribute_value_id']->id != (int) $attribute_item['attribute_value_id']) {
                    return true;

                // بررسی ویژگی های از پیش تعیین شده چندگانه
                } elseif($pivotTable['attribute_item_id']->attribute_item_type == "dropdown" && $pivotTable['attribute_item_id']->multiple_selection_attribute && $attr_key == $pivotTable['attribute_item_id']->id && $pivotTable['attribute_value_id']->id != (int) $attribute_item['attribute_value_id']) {

                    // تهیه یک کالکشن از آیتم های ویژگی چندگانه که از فرم ویرایش محصول به این بخش ارسال میشه برای مقایسه با موارد داخل دیتابیس
                    $incoming_attribute_value_id_collection_mapped_to_integer = collect($attribute_item['attribute_value_id'])->slice(1)->map(function ($item, $key) {
                        return (int) $item;
                    })->values();

                    $attribute_value_id_collection_related_to_current_attribute_item = $product->attributes()->where('attribute_item_id', $pivotTable['attribute_item_id']->id)->pluck('attribute_value_id')->values();

                    // مقایسه لیست آیتم ویژگی چندگانه با مقادیر ذخیره شده در دیتابیس
                    $two_collection_diffs = $incoming_attribute_value_id_collection_mapped_to_integer->diff($attribute_value_id_collection_related_to_current_attribute_item);
                    if(count($two_collection_diffs)) {
                        return true;
                    } 

                // بررسی ویژگی های دلخواه
                } elseif($pivotTable['attribute_item_id']->attribute_item_type == "input_field" && $attr_key == $pivotTable['attribute_item_id']->id && $pivotTable['attribute_value'] != $attribute_item['attribute_value']) {
                    return true;
                }
             
                // تهیه یک لیست از مواردی که دریافت می شود برای بررسی آیتم های جدید
                if(AttributeItem::find($attr_key)->attribute_item_type == "dropdown" && !AttributeItem::find($attr_key)->multiple_selection_attribute && $attribute_item["attribute_value_id"] != 'none') {
                    // برای فرم های از پیش تعریف شده که نباید در صورت هیچکدام خوردن محاسبه شود
                    $incomingValueArray[] = $attr_key;
                } elseif(AttributeItem::find($attr_key)->attribute_item_type == "input_field" && $attribute_item["attribute_value"] != null) {
                    // جهت بررسی مواردی که در فرم دلخواه به صورت جدید وارد می شوند و نباید در صورت خالی ارسال شدن محاسبه شوند
                    $incomingValueArray[] = $attr_key;
                } elseif(AttributeItem::find($attr_key)->multiple_selection_attribute && count($attribute_item["attribute_value_id"]) > 1) {
                    // بررسی شود که اگر نوع ویژگی چندگانه است و یکی از موارد آن فرم تیک زده شده است
                    $incomingValueArray[] = $attr_key;
                } 

            }

        }
        
        // بررسی موارد دریافتی در و کنترل با دیتابیس در صورتی که آیتم جدید اضافه بشود
        if($product->attributes()->pluck('attribute_item_id')->unique()->count() != count(array_unique($incomingValueArray))) {
            return true;
        }

        return false;
    }
}
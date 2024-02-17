<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;

class VendorMinMaxLoaderTypeValue implements ValidationRule
{
    public $request;

    public function __construct($request) {
        $this->request = $request;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // بررسی داشتن وسیله حمل توسط تامین کننده
        if($this->request->user_has_vehicle == "on") {
            return;
        }

        // مبدا سفارش باید تعیین شود
        if(in_array(0, $this->request->origin_loadertype_outlet)) {
            $fail("مبدا سفارش باید تعیین شود.");
        }

        
        // این بخش مربوط به بررسی ویژگی حداقل است
        $category_id_array = $this->request->category_id;
        $last_cat_id = max($category_id_array);
        
        $last_cat_obj = Category::find($last_cat_id);
        $category_related_attributes = $last_cat_obj->attributes->first()->items;

        // این لوپ میاد آی دی ویژگی حداقل سفارش مجاز رو پیدا می کنه با توجه به کلمه کلیدیش
        $minimum_attribute_id = null;
        foreach ($category_related_attributes as $category_related_attribute) {
            if($category_related_attribute->attribute_item_keyword == "min") {
                $minimum_attribute_id = $category_related_attribute->values->first()->id;
            }
        }

        // این لوپ میاد با توجه به آی دی که بالا پیدا شد از ورودی های صفحه محصول مقدار حداقلی که کاربر وارد کرده را پیدا میکنه
        $min_attribute_value = null;
        foreach (array_values($this->request->attribute)[0] as $attribute_item_key) {
            $attribute_value_id = (int) $attribute_item_key["attribute_value_id"];

            if($minimum_attribute_id != null && $attribute_value_id == $minimum_attribute_id) {
                $min_attribute_value = (int) $attribute_item_key["attribute_value"];
            }
        }
        // این بخش مربوط به بررسی ویژگی حداقل است

        // اعتبار سنجی بخش انتخاب نوع بارگیر و خطا در صورتی که هیچ نوع بارگیری انتخاب نشده باشد
        if(in_array(0, $this->request->freightagetype_id)) {
            $fail("روش ارسال کالا نمیتواند خالی باشد.");
        }


        // اعتبار سنجی برای زمانی که یک روش ارسال با نوع بارگیر تکراری در آدرس مبدا انتخاب شده باشد
        $repeated_origin_address_loadertype_array = [];
        $origin_loadertype_outlet_array = $this->request->origin_loadertype_outlet;
        $freightageloadertype_id_array = $this->request->freightageloadertype_id;
        foreach ($this->request->freightageloadertype_id as $freightageloadertype_id_key => $freightageloadertype_id_item) {
            $repeated_origin_address_loadertype_array[] = array(
                $origin_loadertype_outlet_array[$freightageloadertype_id_key],
                $freightageloadertype_id_array[$freightageloadertype_id_key]
            );
        }
        $repeated_origin_address_loadertype_unique_array = array_map("unserialize", array_unique(array_map("serialize", $repeated_origin_address_loadertype_array)));
        if(count($repeated_origin_address_loadertype_unique_array) != count($repeated_origin_address_loadertype_array)) {
            $fail("نوع بارگیر در روش های ارسال در یک آدرس یکسان نمی تواند تکراری باشد.");
        }
        // اعتبار سنجی برای زمانی که یک روش ارسال با نوع بارگیر تکراری در آدرس مبدا انتخاب شده باشد


        // اعتبارسنجی برای مقدار حداقل و حداکثر
        $loader_type_min = $this->request->loader_type_min;
        $loader_type_max = $this->request->loader_type_max;

        if(in_array(null, $loader_type_min)) {
            $fail("مقدار حداقل نوع بارگیر نمیتواند خالی باشد.");
        }

        if(in_array(null, $loader_type_max)) {
            $fail("مقدار حداکثر نوع بارگیر نمیتواند خالی باشد.");
        }

        foreach ($loader_type_max as $key => $value) {
            $loader_type_min_item = $loader_type_min[$key];
            $loader_type_max_item = $loader_type_max[$key];

            if(!is_numeric($loader_type_min_item) || $loader_type_min_item <= 0) {
                $fail("مقدار صحیح برای حداقل نوع بارگیر وارد نمایید.");
            }

            if(!is_numeric($loader_type_max_item) || $loader_type_max_item <= 0) {
                $fail("مقدار صحیح برای حداکثر نوع بارگیر وارد نمایید.");
            }

            if(($loader_type_min_item >= $loader_type_max_item) && !in_array(null, $loader_type_min) && !in_array(null, $loader_type_max)) {
                $fail("مقدار حداقل نوع بارگیر نمیتواند با مقدار حداکثر آن برابر یا از آن بزرگتر باشد.");
            }

            // این یک آیتم مربوط به بررسی ویژگی حداقل سفارش است
            if($min_attribute_value != null && $min_attribute_value > $loader_type_min_item) {
                $fail("مقدار حداقل نوع بارگیر نمیتواند کوچکتر از مقدار حداقل سفارش باشد.");
            }
        }
    }
}

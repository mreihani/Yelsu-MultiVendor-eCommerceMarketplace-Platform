<?php

namespace App\Rules;

use Closure;
use App\Models\Product;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Contracts\Validation\ValidationRule;

class VendorScheduleDailyDeliveryCapacityValidation implements ValidationRule
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
        foreach ($this->request->product_obj as $product_obj_json_item) {
            $product_name = Product::find(Purify::clean(json_decode($product_obj_json_item)->product_id))->product_name;

            // اعتبارسنجی برای ظرفیت روزانه محصول
            if(json_decode($product_obj_json_item)->product_deliver_capacity) {
                if(empty(json_decode($product_obj_json_item)->daily_deliver_capacity)) {
                    $fail("لطفا در بخش ظرفیت تحویل روزانه برای محصول $product_name مقدار عددی ظرفیت را وارد نمایید.");
                }
            }
           
        }
    
    }
}

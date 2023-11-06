<?php

namespace App\Rules;

use Closure;
use App\Models\Product;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Contracts\Validation\ValidationRule;

class RepresentativeGeolocationProduct implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->request->product_obj_server as $product_obj_json_item) {
            $product_name = Product::find(Purify::clean(json_decode($product_obj_json_item)->product_id))->product_name;

            // اعتبارسنجی برای تک محصول در قسمت فروش داخل کشور
            if(json_decode($product_obj_json_item)->product_specific_geolocation_internal) {
                if(empty(json_decode($product_obj_json_item)->product_geolocation_permission_province)) {
                    $fail("لطفا در بخش فروش داخلی برای محصول $product_name حداقل یک استان انتخاب نمایید.");
                }
            }

            // اعتبارسنجی برای تک محصول در قسمت فروش خارج از کشور
            if(json_decode($product_obj_json_item)->product_specific_geolocation_external) {
                if(empty(json_decode($product_obj_json_item)->product_geolocation_permission_export_country)) {
                    $fail("لطفا در بخش فروش خارج از کشور برای محصول $product_name حداقل یک کشور انتخاب نمایید.");
                }
            }
        }
    }
}


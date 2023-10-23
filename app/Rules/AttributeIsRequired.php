<?php

namespace App\Rules;

use Closure;
use App\Models\Attribute;
use App\Models\AttributeItem;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Contracts\Validation\ValidationRule;

class AttributeIsRequired implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach (Purify::clean(collect($value)->first()) as $key => $attribute_item) {
            $attribute_in_loop = AttributeItem::find($key);

            if((auth()->user()->role == 'vendor' && $attribute_in_loop->disabled_attribute) || (auth()->user()->role == 'merchant' && $attribute_in_loop->disabled_attribute) || (auth()->user()->role == 'retailer' && $attribute_in_loop->disabled_attribute)) {
                // مستثنی کردن ویژگی هایی که از سمت کاربران تامین کننده، خرده فروش و بازرگان میاد اما ویژگی غیر فعال شده است
                continue;
            }

            if($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_in_loop->attribute_item_required && $attribute_item["attribute_value_id"] == 'none' && !$attribute_in_loop->multiple_selection_attribute) {
                $fail("$attribute_in_loop->attribute_item_name ضروری است");

            } elseif($attribute_in_loop->attribute_item_type == "dropdown" && $attribute_in_loop->attribute_item_required && count(collect($attribute_item["attribute_value_id"])) == 1 && $attribute_in_loop->multiple_selection_attribute) {
                $fail("$attribute_in_loop->attribute_item_name ضروری است");

            } elseif($attribute_in_loop->attribute_item_type == "input_field" && $attribute_in_loop->attribute_item_required && $attribute_item["attribute_value"] == null && !$attribute_in_loop->multiple_selection_attribute) {
                $fail("$attribute_in_loop->attribute_item_name ضروری است");
            }
        }
    }
}

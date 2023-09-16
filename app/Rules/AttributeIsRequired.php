<?php

namespace App\Rules;

use Closure;
use App\Models\Attribute;
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
        foreach (Purify::clean($value) as $key => $attribute) {
            $attribute_in_loop = Attribute::find($key);
            if($attribute_in_loop->attribute_type == "dropdown" && $attribute_in_loop->required == 'true' && $attribute["value_id"] == 'none') {
                $fail("$attribute_in_loop->name ضروری است");
            } elseif($attribute_in_loop->attribute_type == "input_field" && $attribute_in_loop->required == 'true' && $attribute["value"] == null) {
                $fail("$attribute_in_loop->name ضروری است");
            }
        }
    }
}

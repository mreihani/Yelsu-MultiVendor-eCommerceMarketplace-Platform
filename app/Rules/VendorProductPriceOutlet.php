<?php

namespace App\Rules;

use Closure;
use App\Models\Outlet;
use Illuminate\Contracts\Validation\ValidationRule;

class VendorProductPriceOutlet implements ValidationRule
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
        if(!$this->request->product_outlet_selling_price) {
            $fail("لطفا قیمت محصول برای حداقل یکی از نقاط ثبت شده را وارد نمایید. اگر هیچ آدرسی در سامانه قبلا ثبت نکرده اید، از بخش مدیریت آدرس ها ابتدا یک مختصات مکانی اضافه کنید.");
        } else if(in_array(null, $this->request->product_outlet_selling_price)) {
            
            $null_item_index = array_search(null, $this->request->product_outlet_selling_price);
            $product_outlet_id = $this->request->product_outlet_id[$null_item_index];
            $shop_name = Outlet::find($product_outlet_id)->shop_name;

            $fail("لطفا مبلغ محصول واقع در $shop_name را وارد نمایید.");
        }
    }
}

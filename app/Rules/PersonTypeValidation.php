<?php

namespace App\Rules;

use Closure;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Contracts\Validation\ValidationRule;

class PersonTypeValidation implements ValidationRule
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
        if($this->request->person_type == "haghighi") {
            if($this->request->national_code == null) {
                $fail("لطفا کد ملی خود را وارد نمایید.");
            } elseif(strlen($this->request->national_code) != 10 || ! is_numeric($this->request->national_code)) {
                $fail("لطفا کد ملی صحیح وارد نمایید.");
            }
        } else {
            if($this->request->company_number == null) {
                $fail("لطفا شماره شناسه شرکت راوارد نمایید.");
            } elseif(strlen($this->request->company_number) != 11 || ! is_numeric($this->request->company_number)) {
                $fail("لطفا شماره صحیح شناسه شرکت را وارد نمایید.");
            }
        }
    }
}

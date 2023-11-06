<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RepresentativeGeolocation implements ValidationRule
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
        // اعتبارسنجی برای فعال کردن یکی از دو گزینه فروش داخل یا خارج
        if ($this->request->specific_geolocation_internal == null && $this->request->specific_geolocation_external == null) {
            $fail("لطفا حداقل گزینه فروش داخل یا فروش خارج از کشور را فعال نمایید.");
        }

        // اعتبارسنجی برای این که اگر داخلی رو زد ولی هیچ گزینه ای از شهر و استان نزده باشه
        if ($this->request->specific_geolocation_internal == "on") {
            foreach ($this->request->geolocation_permission_province as $geolocation_permission_province) {
                if($geolocation_permission_province == null) {
                   $fail("استان نمی تواند در بخش مجوز موقعیت جغرافیایی فعالیت خالی باشد، لطفا حداقل یک مورد را انتخاب نمایید.");
                }
            }
        }

        // اعتبارسنجی برای این که اگر خارج رو زد ولی هیچ گزینه ای از شهر و استان نزده باشه
        if ($this->request->specific_geolocation_external == "on" && $this->request->geolocation_permission_export_country == null) {
            $fail("لطفا برای فروش خارج از کشور حداقل یک کشور انتخاب نمایید.");
        }
    }
}

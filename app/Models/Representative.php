<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representative extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(
            'product_in_stock',
            'change_price_permission', 
            'product_geolocation_permission_province', 
            'product_geolocation_permission_city', 
            'product_geolocation_permission_export_country', 
            'product_specific_geolocation_internal', 
            'product_specific_geolocation_external'
        );
    }

    // اطلاعات مجوز جغرافیایی این کاربر را به صورت کالکشن به ترتیب استان و شهر خروجی میدهد
    public function getUserGeolocationInfo($geolocation) {
        
        $user_geolocation_array = [];

        if($this->specific_geolocation_internal && $geolocation == "internal") {
            $geolocation_permission_province_array = explode(",", $this->geolocation_permission_province);
            $geolocation_permission_city_array = explode(",", $this->geolocation_permission_city);
            foreach ($geolocation_permission_province_array as $location_key => $geolocation_permission_province_value) {
                $user_geolocation_array[] = array(
                    "province" => $geolocation_permission_province_value, 
                    "city" => $geolocation_permission_city_array[$location_key], 
                );
            }
        }

        if($this->specific_geolocation_external && $geolocation == "external") {
            $geolocation_permission_export_country_array = explode(",", $this->geolocation_permission_export_country);
            foreach ($geolocation_permission_export_country_array as $location_key => $geolocation_permission_export_country_value) {
                $user_geolocation_array[] = $geolocation_permission_export_country_value;
            }
        }

        return collect($user_geolocation_array);
    }

    // آیتم های تابع بالا رو برای نمایش در صحفه به رشته تبدیل می کند
    public function getUserGeolocationInfoString($geolocation) {
        
        // تهیه رشته اطلاعات داخلی
        if($this->specific_geolocation_internal && $geolocation == "internal") {
            $user_geolocation_array = [];

            foreach ($this->getUserGeolocationInfo($geolocation) as $location_value) {
                $user_geolocation_array[] = $location_value["province"] . "، " . $location_value["city"];
            }
            
        } elseif($geolocation == "internal") {
            $user_geolocation_array = "تعیین نشده";
        }

        // تهیه رشته اطلاعات خارجی
        if($this->specific_geolocation_external && $geolocation == "external") {
            $user_geolocation_array = [];

            foreach ($this->getUserGeolocationInfo($geolocation) as $location_value) {
                $user_geolocation_array[] = $location_value;
            }

        } elseif($geolocation == "external") {
            $user_geolocation_array = "تعیین نشده";
        }

        return collect($user_geolocation_array);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Arr;
use App\Models\AttributeItem;
use Laravel\Scout\Searchable;
use App\Models\AttributeValue;
use App\Models\Representative;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return Arr::only($array, ['id','product_name']);
    }

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

    // این تابع برای برگرداندن کلیه ویژگی های یک محصول است
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

    // تابعی که لیستی از محصولات را دریافت و آن ها را بر اساس دسته بندی خروجی میدهد
    public function ScopeSort_products_by_last_category($query, $product_object_collection) {
        $last_category_id_array = [];
        $product_object_array = [];
        
        // ایجاد یک لیست از شماره دسته بندی آخر موجود در تمام محصولات فروشنده
        foreach ($product_object_collection as $product_object_key => $product_object) {
            $last_category_id_array[] = (int) collect(explode(",", $product_object->category_id))->last();
        }
        
        // تهیه لیست نهایی از محصولاتی که مرتبط با لیست دسته بندی هستند
        foreach ($product_object_collection as $product_object_key => $product_object) {
            foreach ($last_category_id_array as $last_category_id) {
                if(in_array($last_category_id, explode(",", $product_object->category_id))) {
                    $product_object_array[$last_category_id][] = $product_object;
                    break;
                }
            }
        }
        
        return $product_object_array;
    }

    // تابعی که  محصولات را برای جدول بر اساس فروشندگان خروجی می دهد
    public function ScopeSort_products_by_last_vendor($query, $product_object_collection) {
        $product_related_user_id_array = [];
        $product_object_array = [];

        // ایجاد یک لیست از کاربران موجود در محصولات ورودی
        foreach ($product_object_collection as $product_object_item) {
            $product_related_user_id_array[] = $product_object_item->determine_product_related_user_object();
        }
        
        // تهیه یک لیست از محصولات بر اساس هر کاربر مرتبط
        foreach ($product_object_collection as $product_object_key => $product_object) {
            foreach ($product_related_user_id_array as $product_related_user_id_item) {
                if($product_related_user_id_item == $product_object->determine_product_related_user_object()) {
                    $product_object_array[$product_related_user_id_item][] = $product_object;
                    break;
                }
            }
        }

        // اینجا به ترتیب اندیس آرایه می چیند
        ksort($product_object_array);
       
        return $product_object_array;
    }

    // این تابع برای برگرداندن ویژگی هایی که گزینه جدول ثبت شده باشد
    public function table_attribute_items_obj_array() {

        $product_attributes_array = $this->attributes()->pluck('attribute_item_id')->unique();
        $product_attributes_array_pivot = [];
        $attribute_loop_array = [];

        foreach ($product_attributes_array as $product_attributes_item) {
            if(AttributeItem::find($product_attributes_item)->show_in_table_page) {
                foreach ($this->attributes()->where('attribute_item_id', $product_attributes_item)->get() as $attribute_item) {
                    $attribute_loop_array[$product_attributes_item]['attribute_value_obj'][] = AttributeValue::find($attribute_item->pivot->attribute_value_id);
                    $attribute_loop_array[$product_attributes_item]['attribute_value'] = $attribute_item->pivot->attribute_value;
                    $attribute_loop_array[$product_attributes_item]['attribute_item_order'] = AttributeItem::find($product_attributes_item)->attribute_item_order;
                }
            }
        }

        $attribute_loop_array = collect($attribute_loop_array)->sortBy([
            ['attribute_item_order', 'asc'],
        ]);

        return $attribute_loop_array;
    }
    
    // تابع برای تعیین واحد پولی یک محصول
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

    // تابع برای تعیین کمیسیون یک محصول
    public function determine_product_commission() {
        $commission_value = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && (AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "fix_commission" || AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "percent_commission")) {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                    $commission_value = $attribute_value_array['attribute_value_obj'][0]->value;
                } else {
                    $commission_value = $attribute_value_array["attribute_value"];
                }
            }
        }

        return $commission_value;
    }

    // تابع برای تعیین نوع کمیسیون یک محصول
    public function determine_product_commission_type() {
        $commission_type = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword) {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "fix_commission") {
                    $commission_type = "fix_commission";
                } elseif(AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "percent_commission") {
                    $commission_type = "percent_commission";
                }
            } 
        }

        return $commission_type;
    }

    // تابع برای تعیین حداقل مقدار مجاز یک محصول
    public function determine_product_min() {
        $min_value = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && (AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "min")) {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                    $min_value = $attribute_value_array['attribute_value_obj'][0]->value;
                } else {
                    $min_value = $attribute_value_array["attribute_value"];
                }
            }
        }

        return $min_value;
    }

    // تابع برای تعیین حداکثر مقدار مجاز یک محصول
    public function determine_product_max() {
        $max_value = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && (AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "max")) {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                    $max_value = $attribute_value_array['attribute_value_obj'][0]->value;
                } else {
                    $max_value = $attribute_value_array["attribute_value"];
                }
            }
        }

        return $max_value;
    }

    // تابع برای تعیین مقدار مالیات بر ارزش افزوده
    public function determine_product_value_added_tax() {
        $added_value_tax = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "value_added_tax") {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                    $added_value_tax = $attribute_value_array['attribute_value_obj'][0]->value;
                } else {
                    $added_value_tax = $attribute_value_array["attribute_value"];
                }
            }
        }

        return $added_value_tax;
    }

    // تابع برای تعیین مالیات بر ارزش افزوده به درصد
    public function determine_product_value_added_tax_by_percent() {
        $added_value_tax = $this->determine_product_value_added_tax();

        return floor($this->selling_price * ($added_value_tax / 100 + 1));
    }

    // تابع برای بررسی تغییر یک ویژگی که برای تاییدیه ارسال بشه
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

    // ورودی را محصول میگیرد و در نهایت شیء کاربر مرتبط را تحویل می دهد
    public function determine_product_related_user_object() {
        if($this->vendor_id != NULL) {
            $user_id = (int) $this->vendor_id;
        } elseif($this->merchant_id != NULL) {
            $user_id = (int) $this->merchant_id;
        } elseif($this->retailer_id != NULL) {
            $user_id = (int) $this->retailer_id;
        } else {
            $user_id = 0;
        }

        return $user_id;
    }
    
    public function determine_product_owner() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    // یک متد برای ایجاد آرایه مربوط به استان ها با توجه به لیست کامل استان ها و موارد انتخاب شده
    public function create_province_array_based_on_representative_product($product_item, $representative) {
        
        $province_list = config("yelsu_location_array.provinces");

        $selected_provinces = explode(",", $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_province')->first());

        $province_name_array = [];
        foreach ($selected_provinces as $selected_province_key => $selected_province_item) {
            foreach ($province_list as $province_list_item) {
                if($selected_province_item == $province_list_item) {
                    $selected = true;
                } else {
                    $selected = false;
                }
                $province_name_array[$selected_province_key][] = array(
                    'selected' => $selected,
                    'value' => $province_list_item
                );
            }
        }
        return $province_name_array;
    }

    // یک متد برای ایجاد آرایه مربوط به شهر ها با توجه به لیست کامل شهر ها و موارد انتخاب شده
    public function create_city_array_based_on_representative_product($product_item, $representative) {
        
        $selected_cities = explode(",", $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_city')->first());

        $city_name_array = [];
        foreach ($selected_cities as $selected_city_key => $selected_city_item) {
            $city_name_array[][] = array(
                "selected" => true,
                "value" => $selected_city_item
            );
        }
        
        return $city_name_array;
    }

    // یک متد برای ایجاد آرایه مربوط به کشور ها با توجه به لیست کامل کشور ها و موارد انتخاب شده
    public function create_country_array_based_on_representative_product($product_item, $representative) {
        
        $country_list = config("yelsu_location_array.countries");

        $selected_countries = explode(",", $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_export_country')->first());

        $country_name_array = [];
        foreach ($country_list as $country_item) {

            if(in_array($country_item, $selected_countries)) {
                $selected = true;
            } else {
                $selected = false;
            }

            $country_name_array[] = array(
                "selected" => $selected,
                "value" => $country_item
            );
        }
        
        return $country_name_array;
    }

    // برای بارگذاری آرایه مربوط به هر محصول در کاربر عامل
    public function scopeDetermine_representative_product_array($query, $product_item, $representative) {
        
        if(count($representative->products()->where("product_id", $product_item->id)->get())) {
            $product_array = array(
                "product_id" => $product_item->id,
                "product_in_stock" => $representative->products()->where("product_id", $product_item->id)->pluck('product_in_stock')->first() ?: "",
                "change_price_permission" => $representative->products()->where("product_id", $product_item->id)->pluck('change_price_permission')->first() ? true : false,
                "product_specific_geolocation_internal" => $representative->products()->where("product_id", $product_item->id)->pluck('product_specific_geolocation_internal')->first() ? true : false,
                "product_specific_geolocation_external" => $representative->products()->where("product_id", $product_item->id)->pluck('product_specific_geolocation_external')->first() ? true : false,
                "product_geolocation_permission_city" => $this->create_city_array_based_on_representative_product($product_item, $representative) ?: [],
                "product_geolocation_permission_export_country" => $this->create_country_array_based_on_representative_product($product_item, $representative) ?: [],
                "product_geolocation_permission_province" => $this->create_province_array_based_on_representative_product($product_item, $representative) ?: [],
            );
        } else {
            $product_array = array(
                "product_id" => $product_item->id, 
                "product_in_stock" => "نامحدود", 
                "change_price_permission" => false, 
                "product_specific_geolocation_internal" => false, 
                "product_specific_geolocation_external" => false, 
                "product_geolocation_permission_city" => [], 
                "product_geolocation_permission_export_country" => [], 
                "product_geolocation_permission_province" => [] 
            );
        }

        return $product_array;
    }

    // برای ایجاد آرایه ای از محصولات نسبت داده شده به کاربر عامل
    public function scopeDetermine_representative_selected_product_server_array($query, $product_item, $representative) {

        if(count($representative->products()->where("product_id", $product_item->id)->get())) {
            $product_array = array(
                "product_id" => $product_item->id,
                "product_in_stock" => $representative->products()->where("product_id", $product_item->id)->pluck('product_in_stock')->first() ?: "",
                "change_price_permission" => $representative->products()->where("product_id", $product_item->id)->pluck('change_price_permission')->first() ? true : false,
                "product_specific_geolocation_internal" => $representative->products()->where("product_id", $product_item->id)->pluck('product_specific_geolocation_internal')->first() ? true : false,
                "product_specific_geolocation_external" => $representative->products()->where("product_id", $product_item->id)->pluck('product_specific_geolocation_external')->first() ? true : false,
                "product_geolocation_permission_city" => $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_city')->first() ?: [],
                "product_geolocation_permission_export_country" => $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_export_country')->first() ?: [],
                "product_geolocation_permission_province" => $representative->products()->where("product_id", $product_item->id)->pluck('product_geolocation_permission_province')->first() ?: [],
            );
        } else {
            $product_array = array(
                "product_id" => $product_item->id, 
                "product_in_stock" => "نامحدود", 
                "change_price_permission" => false, 
                "product_specific_geolocation_internal" => false, 
                "product_specific_geolocation_external" => false, 
                "product_geolocation_permission_city" => [], 
                "product_geolocation_permission_export_country" => [], 
                "product_geolocation_permission_province" => [] 
            );
        }

        return $product_array;
    }

    public function representative()
    {
        return $this->belongsToMany(Representative::class)->withPivot(
            'product_in_stock',
            'change_price_permission', 
            'product_geolocation_permission_province', 
            'product_geolocation_permission_city', 
            'product_geolocation_permission_export_country', 
            'product_specific_geolocation_internal', 
            'product_specific_geolocation_external'
        );
    }
    
}
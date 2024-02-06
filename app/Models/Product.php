<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Attribute;
use Illuminate\Support\Arr;
use App\Models\AttributeItem;
use Laravel\Scout\Searchable;
use App\Models\AttributeValue;
use App\Models\Representative;
use App\Models\ProductLoadertype;
use App\Models\Freightageloadertype;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute as AttributeMutator;


class Product extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    /**
     * Converts the object to a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // Convert the object to an array
        $array = $this->toArray();

        // Return only the 'id' and 'product_name' fields from the array
        return Arr::only($array, ['id','product_name']);
    }

    /**
     * Define a many-to-many relationship with the Category model through the 'category_products' pivot table.
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class, 
            'category_products'
        );
    }

    /**
     * Define a relationship where the current model belongs to a User model.
     * It uses the 'vendor_id' column of the current model and the 'id' column of the User model.
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    /**
     * Define a relationship where a particular model belongs to a user as a merchant.
     * The user is identified by the 'merchant_id' foreign key, and the user's primary key is 'id'.
     */
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    /**
     * Define a relationship with the User model for the retailer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retailer()
    {
        return $this->belongsTo(
            User::class,  // Related model
            'retailer_id', // Foreign key
            'id' // Owner key
        );
    }

    /**
     * Define a many-to-many relationship with the Order model,
     * including the quantity and price pivot columns.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }

    /**
     * Define the relationship between the model and the Attribute model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        // Define a many-to-many relationship with the Attribute model
        return $this->belongsToMany(Attribute::class)
                    // Include the pivot columns in the query result
                    ->withPivot('attribute_item_id', 'attribute_value_id', 'attribute_value');
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

    /**
     * Calculate the product value added tax by percentage.
     * 
     * @return int The calculated value added tax
     */
    public function determineProductValueAddedTaxByPercent() {
        // Determine the product value added tax
        $addedValueTax = $this->determine_product_value_added_tax();

        // Calculate the value added tax by percentage
        if($addedValueTax) {
            return ceil($this->price_with_commission * ($addedValueTax / 100 + 1));
        } else {
            return $this->price_with_commission;
        }
    }

    // تعیین واحد سفارش
    public function determine_product_unit() {
        $product_unit = null;

        foreach ($this->attribute_items_obj_array() as $attribute_value_item_key => $attribute_value_array) {
            if(count($attribute_value_array['attribute_value_obj']) == 1 && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword && AttributeItem::find($attribute_value_item_key)->attribute_item_keyword == "unit") {
                if(AttributeItem::find($attribute_value_item_key)->attribute_item_type == 'dropdown') {
                    $product_unit = $attribute_value_array['attribute_value_obj'][0]->value;
                } else {
                    $product_unit = $attribute_value_array["attribute_value"];
                }
            }
        }

        return $product_unit;
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
        // if($this->vendor_id != NULL) {
        //     $user_id = (int) $this->vendor_id;
        // } elseif($this->merchant_id != NULL) {
        //     $user_id = (int) $this->merchant_id;
        // } elseif($this->retailer_id != NULL) {
        //     $user_id = (int) $this->retailer_id;
        // } else {
        //     $user_id = 0;
        // }

        $user_id = $this->determine_product_owner->id;

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

    /**
     * Returns an array of products associated with a given user representative
     *
     * @param $query
     * @param $productItem
     * @param $representative
     * @return array
     */
    public function scopeDetermineRepresentativeSelectedProductServerArray($query, $productItem, $representative)
    {
        // Check if the representative has the product
        $product = $representative->products()->where("product_id", $productItem->id)->first();

        // Populate the product array with data based on representative having the product or not
        $productArray = [
            "product_id" => $productItem->id,
            "product_in_stock" => $product ? $product->product_in_stock : "",
            "change_price_permission" => (bool)($product ? $product->change_price_permission : false),
            "product_specific_geolocation_internal" => (bool)($product ? $product->product_specific_geolocation_internal : false),
            "product_specific_geolocation_external" => (bool)($product ? $product->product_specific_geolocation_external : false),
            "product_geolocation_permission_city" => $product ? $product->product_geolocation_permission_city : [],
            "product_geolocation_permission_export_country" => $product ? $product->product_geolocation_permission_export_country : [],
            "product_geolocation_permission_province" => $product ? $product->product_geolocation_permission_province : [],
        ];

        return $productArray;
    }

    /**
     * Define a many-to-many relationship with the Representative model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function representative()
    {
        return $this->belongsToMany(Representative::class)->withPivot(
            'product_in_stock', // Pivot column for product in stock
            'change_price_permission', // Pivot column for change price permission
            'product_geolocation_permission_province', // Pivot column for product geolocation permission province
            'product_geolocation_permission_city', // Pivot column for product geolocation permission city
            'product_geolocation_permission_export_country', // Pivot column for product geolocation permission export country
            'product_specific_geolocation_internal', // Pivot column for product specific geolocation internal
            'product_specific_geolocation_external' // Pivot column for product specific geolocation external
        );
    }

    /**
     * Get the freightage loadertype associated with the product.
     */
    public function freightageLoadertype()
    {
        return $this->hasMany(ProductLoadertype::class);
    }

    /**
     * Get the schedules associated with the user.
     */
    public function schedule() {
        return $this->hasMany(Schedule::class);
    }
    
    /**
     * Define a many-to-many relationship with the Outlet model,
     * including the "selling_price" pivot column.
     */
    public function outlets() 
    {
        return $this->belongsToMany(Outlet::class)->withPivot("selling_price");
    }

    /**
     * Get the price of the product including commission.
     *
     * @return float
     */
    public function getPriceWithCommissionAttribute()
    {
        // Get the selling price of the product
        $sellingPrice = $this->selling_price;

        // Determine the type of commission for the product
        $commissionType = $this->determine_product_commission_type();
        
        // Determine the value of commission for the product
        $commissionValue = $this->determine_product_commission();

        // If the selling price is not zero and there is a commission value
        if ($sellingPrice != 0 && $commissionValue) {
            // If the commission type is percentage-based
            if ($commissionType == "percent_commission") {
                // Calculate the price with the percentage-based commission
                return $sellingPrice + $commissionValue * $sellingPrice / 100;
            }

            // If the commission type is fixed
            if ($commissionType == "fix_commission") {
                // Calculate the price with the fixed commission
                return $sellingPrice + $commissionValue;
            }
        }

        // Return the selling price if no commission applies
        return $sellingPrice;
    }

    /**
    * Calculate the price with commission and value added tax.
    * @return float The calculated price with commission and value added tax.
    */
    public function getPriceWithCommissionValueAddedAttribute($outlet_id = null) {

        if($outlet_id) {
            // Get selling price from pivot table
            $sellingPrice = $this->outlets->where("id", $outlet_id)->first()->pivot->selling_price;
        } else {
            $sellingPrice = $this->selling_price;
        }

        // Determine the type of commission for the product
        $commissionType = $this->determine_product_commission_type();
        
        // Determine the value of commission for the product
        $commissionValue = $this->determine_product_commission();

        // Set selling price with commsision to zero
        $sellingPriceWithCommission = 0;

        // If the selling price is not zero and there is a commission value
        if ($sellingPrice != 0 && $commissionValue) {
            // If the commission type is percentage-based
            if ($commissionType == "percent_commission") {
                // Calculate the price with the percentage-based commission
                $sellingPriceWithCommission = $sellingPrice + $commissionValue * $sellingPrice / 100;
            }

            // If the commission type is fixed
            if ($commissionType == "fix_commission") {
                // Calculate the price with the fixed commission
                $sellingPriceWithCommission = $sellingPrice + $commissionValue;
            }
        }

        // Determine the product value added tax
        $valueAddedTax = $this->determine_product_value_added_tax() ?: 0;

        // Calculate the price with commission and value added tax
        return ($valueAddedTax / 100 + 1) * $sellingPriceWithCommission;

    }
}


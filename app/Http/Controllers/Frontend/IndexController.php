<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Useroutlets;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Customsoutlet;
use App\Models\Merchantoutlet;
use App\Models\Retaileroutlet;
use App\Models\CategoryProduct;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cookie;
use Stevebauman\Purify\Facades\Purify;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Pagination\LengthAwarePaginator;


class IndexController extends Controller
{
    public function HomePage()
    {

        $i = 0;
        $steelCategory = [];
        $steelCategoryArray = [];
        $steelCatProductsArray = [];

        $j = 0;
        $miningCategory = [];
        $miningCategoryArray = [];
        $miningCatProductsArray = [];

        $k = 0;
        $constructionCategory = [];
        $constructionCategoryArray = [];
        $constructionCatProductsArray = [];

        $l = 0;
        $petroCategory = [];
        $petroCategoryArray = [];
        $petroCatProductsArray = [];

        $recently_viewed_product_arr = [];

        $products = Product::where('status', 'active')->latest()->get();
        $categories = Category::latest()->get();
        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        if ($parentCategories) {
            foreach ($parentCategories as $parentCategory) {

                // محصولات فولادی و فلزی
                if ($parentCategory->id == 1) {
                    $steelCategory = $parentCategory->child;
                }

                // محصولات معدنی و فرآوری
                if ($parentCategory->id == 2) {
                    $miningCategory = $parentCategory->child;
                }

                // محصولات ساختمانی و عمرانی 
                if ($parentCategory->id == 3) {
                    $constructionCategory = $parentCategory->child;
                }

                // صنایع نفت، گاز و پتروشیمی
                if ($parentCategory->id == 4) {
                    $petroCategory = $parentCategory->child;
                }
            }
        }

        foreach ($steelCategory as $steelItem) {
            $i++;
            if ($i < 9) {
                $steelCategoryArray[] = $steelItem;
            }
        }

        foreach ($miningCategory as $miningItem) {
            $j++;
            if ($j < 9) {
                $miningCategoryArray[] = $miningItem;
            }
        }

        foreach ($constructionCategory as $constructionItem) {
            $k++;
            if ($k < 9) {
                $constructionCategoryArray[] = $constructionItem;
            }
        }

        foreach ($petroCategory as $petroItem) {
            $l++;
            if ($l < 9) {
                $petroCategoryArray[] = $petroItem;
            }
        }

        foreach ($steelCategoryArray as $steelCatItem) {
            $itemArray = $steelCatItem->with('products')->where('id', $steelCatItem->id)->inRandomOrder()->get();
            $steelCatProductsArray[] = $itemArray[0];
        }

        foreach ($miningCategoryArray as $miningCatItem) {
            $itemArray = $miningCatItem->with('products')->where('id', $miningCatItem->id)->inRandomOrder()->get();
            $miningCatProductsArray[] = $itemArray[0];
        }

        foreach ($constructionCategoryArray as $constructionCatItem) {
            $itemArray = $constructionCatItem->with('products')->where('id', $constructionCatItem->id)->inRandomOrder()->get();
            $constructionCatProductsArray[] = $itemArray[0];
        }

        foreach ($petroCategoryArray as $petroCatItem) {
            $itemArray = $petroCatItem->with('products')->where('id', $petroCatItem->id)->inRandomOrder()->get();
            $petroCatProductsArray[] = $itemArray[0];
        }

        if (Cookie::get('recently_viewed') && Product::count() > 0) {
            $recently_viewed_product_array[] = unserialize(Cookie::get('recently_viewed'));

            foreach ($recently_viewed_product_array as $recent_product_id) {
                $recently_viewed_product_arr[] = Product::find($recent_product_id);
            }
        }

        $blogposts = BlogPost::latest()->where('status', 'active')->get();

        return view('frontend.index', compact('products', 'categories', 'parentCategories', 'petroCategoryArray', 'steelCategoryArray', 'miningCategoryArray', 'constructionCategoryArray', 'steelCatProductsArray', 'miningCatProductsArray', 'constructionCatProductsArray', 'petroCatProductsArray', 'recently_viewed_product_arr', 'blogposts'));
    }

    public function ProductDetails($slug)
    {
        $recently_viewed_product_arr = [];

        $product = Product::where('product_slug', Purify::clean($slug))->get();

        if(count($product) == 0) {
            redirect()->to('/')->send();
        }

        $product = $product[0];

        if ($product->status == 'disabled' || ($product->vendor_id != NULL && $product->product_verification == 'inactive')) {
            return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
        }

        if ($product->status == 'disabled' || ($product->merchant_id != NULL && $product->product_verification == 'inactive')) {
            return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
        }

        if ($product->status == 'disabled' || ($product->retailer_id != NULL && $product->product_verification == 'inactive')) {
            return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
        }

        // check if vendor is inactive to disable product
        if ($product->vendor_id != NULL) {
            $vendor_user_type = $product->vendor->role;
            if ($vendor_user_type == 'vendor') {
                $vendor_status = $product->vendor->status;
                if ($vendor_status == 'inactive') {
                    return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
                }
            }
        }
        // end of - check if vendor is inactive to disable product

        // check if merchant is inactive to disable product
        if ($product->merchant_id != NULL) {
            $merchant_user_type = $product->merchant->role;
            if ($merchant_user_type == 'merchant') {
                $merchant_status = $product->merchant->status;
                if ($merchant_status == 'inactive') {
                    return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
                }
            }
        }
        // end of - check if merchant is inactive to disable product

        // check if retailer is inactive to disable product
        if ($product->retailer_id != NULL) {
            $retailer_user_type = $product->retailer->role;
            if ($retailer_user_type == 'retailer') {
                $retailer_status = $product->retailer->status;
                if ($retailer_status == 'inactive') {
                    return redirect(route('shop'))->with('error', 'محصول مورد نظر یافت نشد.');
                }
            }
        }
        // end of - check if retailer is inactive to disable product


        $category_id = $product->category_id;
        if (! empty($category_id)) {
            $category = Category::findOrFail($category_id);
        } else {
            $category = '';
        }

        if ($product->meta_title != NULL) {
            SEOMeta::setTitle($product->meta_title);
        }

        if ($product->meta_description != NULL) {
            SEOMeta::setDescription($product->meta_description);
        }

        if ($product->meta_keywords != NULL) {
            $meta_keywords = explode('،', $product->meta_keywords);
            SEOMeta::setKeywords($meta_keywords);
        }

        // section for recently viewed products      
        $recently_viewed_product_array[] = unserialize(Cookie::get('recently_viewed'));
        $recently_viewed_product_array = Arr::flatten($recently_viewed_product_array, 1);
        if (in_array(false, $recently_viewed_product_array)) {
            $recently_viewed_product_array = array_diff($recently_viewed_product_array, array(false));
        }
        array_push($recently_viewed_product_array, $product->id);
        $recently_viewed_product_array = array_unique($recently_viewed_product_array);
        foreach ($recently_viewed_product_array as $check_item) {
            if (! Product::find($check_item)) {
                $recently_viewed_product_array = [];
            }
        }
        if (sizeof($recently_viewed_product_array) > 8) {
            unset($recently_viewed_product_array[0]);
        }
        $cookie = Cookie::queue('recently_viewed', serialize($recently_viewed_product_array), 86400 * 30);
        // END section for recently viewed products

        // added recursive function
        $categories = Category::latest()->get();
        foreach ($categories as $categoryItem) {
            if ($category->parent == 0) {
                $root_catgory_obj = $category;
                break;
            } else {
                $category = Category::find($category->parent);
            }
        }
        $relatedProducts = $root_catgory_obj->productsRandom;
        // end of - recursive function

        // show recent viewed section
        if (Cookie::get('recently_viewed') && Product::count() > 0) {
            $recently_viewed_product_array = [];
            $recently_viewed_product_array[] = unserialize(Cookie::get('recently_viewed'));

            foreach ($recently_viewed_product_array as $recent_product_id) {
                $recently_viewed_product_arr[] = Product::find($recent_product_id);
            }
        }
        // end of - show recent viewd section

        return view('frontend.product.product_details', compact('product', 'category', 'relatedProducts', 'root_catgory_obj', 'recently_viewed_product_arr'));
    } //End method

    public function VendorDetails($id)
    {
        $vendor = User::findOrFail(Purify::clean($id));

        // check if vendor is inactive to disable shop single page
        $vendor_user_type = $vendor->role;
        if ($vendor_user_type == 'vendor') {
            $vendor_status = $vendor->status;
            if ($vendor_status == 'inactive') {
                return redirect(route('shop'))->with('error', 'صفحه مورد نظر یافت نشد.');
            }
        }
        // end of - check if vendor is inactive to disable shop single page

        $vendor_product = Product::where('vendor_id', $id)->where('status', 'active')->where('product_verification', 'active')->orderBy('created_at','asc')->get();
        $sort_products_by_last_category = Product::sort_products_by_last_category($vendor_product);
        
        // افزودن نقاط تامین کنندگان
        $outletsArr = [];
        $outlets = Outlet::where('user_id', $id)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('vendor.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-vendor-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }
        // افزودن نقاط تامین کنندگان


        // افزودن نقاط گمرک ها
        $outlets = Customsoutlet::all();
        foreach ($outlets as $outlet) {
            $name = $outlet->name;
            $address = $outlet->address;
            $coords = [$outlet->latitude, $outlet->longitude];
            $link = route('customs.details', $outlet->id);
            $logo = $outlet->photo ? url($outlet->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-customs-marker';

            $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
        }
        // افزودن نقاط گمرک ها


        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده
        
        
        return view('vendor.vendor_details', compact('outlets', 'outletsArr', 'vendor', 'vendor_product', 'sort_products_by_last_category'));
    } //End method

    public function VendorAll()
    {
        $outletsArr = [];
        $vendors = User::where('role', 'vendor')->where('status', 'active')->orderBy('id', 'DESC')->paginate(30);

        $vendor_id_arr = $vendors->pluck('id');

        $outlets = Outlet::whereIn('user_id', $vendor_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('vendor.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-vendor-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('vendor.vendor_all', compact('latitudeVal', 'longitudeVal', 'vendors', 'outletsArr', 'query'));
    } //End method

    public function VendorAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $vendors = User::search($query)->where('status','active')->where('role','vendor')->paginate(12);
        $vendor_id_arr = $vendors->pluck('id');

        $outletsArr = [];
        $outlets = Outlet::whereIn('user_id', $vendor_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('vendor.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-vendor-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        if (count($outletsArr)) {
            $latitudeVal = $outletsArr[0][2][0];
            $longitudeVal = $outletsArr[0][2][1];
        } else {
            $latitudeVal = env('latitudeVal');
            $longitudeVal = env('longitudeVal');
        }

        return view('vendor.vendor_all', compact('latitudeVal', 'longitudeVal', 'vendors', 'outletsArr', 'query'));
    } //End method

    public function MerchantDetails($id)
    {
        $merchant = User::findOrFail(Purify::clean($id));

        // check if merchant is inactive to disable shop single page
        $merchant_user_type = $merchant->role;
        if ($merchant_user_type == 'merchant') {
            $merchant_status = $merchant->status;
            if ($merchant_status == 'inactive') {
                return redirect(route('shop'))->with('error', 'صفحه مورد نظر یافت نشد.');
            }
        }
        // end of - check if merchant is inactive to disable shop single page

        $merchant_product = Product::where('merchant_id', $id)->where('status', 'active')->where('product_verification', 'active')->get();

        $outletsArr = [];
        $outlets = Merchantoutlet::where('user_id', $id)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('merchant.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/merchant_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-merchant-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        return view('merchant.merchant_details', compact('outlets', 'outletsArr', 'merchant', 'merchant_product'));
    } //End method

    public function MerchantAll()
    {
        $merchants = User::where('role', 'merchant')->where('status', 'active')->orderBy('id', 'DESC')->paginate(30);

        $merchant_id_arr = $merchants->pluck('id');

        $outlets = Merchantoutlet::whereIn('user_id', $merchant_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('merchant.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/merchant_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-merchant-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('merchant.merchant_all', compact('latitudeVal', 'longitudeVal', 'merchants', 'outletsArr', 'query'));
    } //End method

    public function MerchantAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $merchants = User::search($query)->where('status','active')->where('role','merchant')->paginate(12);

        $merchant_id_arr = $merchants->pluck('id');

        $outletsArr = [];
        $outlets = Merchantoutlet::whereIn('user_id', $merchant_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('merchant.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/merchant_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-merchant-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        if (count($outletsArr)) {
            $latitudeVal = $outletsArr[0][2][0];
            $longitudeVal = $outletsArr[0][2][1];
        } else {
            $latitudeVal = env('latitudeVal');
            $longitudeVal = env('longitudeVal');
        }

        return view('merchant.merchant_all', compact('latitudeVal', 'longitudeVal', 'merchants', 'outletsArr', 'query'));
    } //End method

    public function RetailerAll()
    {
        $outletsArr = [];
        $retailers = User::where('role', 'retailer')->where('status', 'active')->orderBy('id', 'DESC')->paginate(30);

        $retailer_id_arr = $retailers->pluck('id');

        $outletsArr = [];
        $outlets = Retaileroutlet::whereIn('user_id', $retailer_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('retailer.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/retailer_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-retailer-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('retailer.retailer_all', compact('latitudeVal', 'longitudeVal', 'retailers', 'outletsArr', 'query'));
    } //End method

    public function RetailerDetails($id)
    {
        $retailer = User::findOrFail(Purify::clean($id));

        // check if retailer is inactive to disable shop single page
        $retailer_user_type = $retailer->role;
        if ($retailer_user_type == 'retailer') {
            $retailer_status = $retailer->status;
            if ($retailer_status == 'inactive') {
                return redirect(route('shop'))->with('error', 'صفحه مورد نظر یافت نشد.');
            }
        }
        // end of - check if retailer is inactive to disable shop single page

        $retailer_product = Product::where('retailer_id', $id)->where('status', 'active')->where('product_verification', 'active')->get();

        $outletsArr = [];
        $outlets = Retaileroutlet::where('user_id', $id)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('retailer.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/retailer_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-retailer-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        return view('retailer.retailer_details', compact('outlets', 'outletsArr', 'retailer', 'retailer_product'));
    } //End method

    public function RetailerAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $retailers = User::search($query)->where('status','active')->where('role','retailer')->paginate(12);

        $retailer_id_arr = $retailers->pluck('id');

        $outletsArr = [];
        $outlets = Retaileroutlet::whereIn('user_id', $retailer_id_arr)->get();

        foreach ($outlets as $outlet) {
            $shop_name = $outlet->shop_name;
            $shop_address = $outlet->shop_address;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $shop_link = route('retailer.details', $outlet->user_id);
            $shop_logo = $outlet->user->photo ? url('storage/upload/retailer_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-retailer-marker';

            $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
        }

        if (count($outletsArr)) {
            $latitudeVal = $outletsArr[0][2][0];
            $longitudeVal = $outletsArr[0][2][1];
        } else {
            $latitudeVal = env('latitudeVal');
            $longitudeVal = env('longitudeVal');
        }

        return view('retailer.retailer_all', compact('latitudeVal', 'longitudeVal', 'retailers', 'outletsArr', 'query'));
    } //End method

    public function CustomsDetails($id)
    {
        $outletsArr = [];
        $customsItem = Customsoutlet::find(Purify::clean($id));

        if(empty($customsItem)) {
            redirect()->to('/')->send();
        }

        $customs_type = $customsItem->customsItem_type;
        $name = $customsItem->name;
        $province = $customsItem->province;
        $address = $customsItem->address;
        $customs_coords = [$customsItem->latitude, $customsItem->longitude];
        $photo = $customsItem->photo ? url($customsItem->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
        $customs_link = route('customs.details', $customsItem->id);
        $marker_class = 'leaflet-customs-marker';

        $outletsArr[] = array($name, $address, $customs_coords, $customs_link, $photo, $marker_class, $customs_type);

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        return view('frontend.customs.customs_details', compact('customsItem', 'outletsArr'));
    } //End method

    public function CustomsAll()
    {
        $outletsArr = [];
        $customsAll = Customsoutlet::latest()->paginate(30);

        foreach ($customsAll as $customs) {
            $customs_type = $customs->customs_type;
            $name = $customs->name;
            $province = $customs->province;
            $address = $customs->address;
            $customs_coords = [$customs->latitude, $customs->longitude];
            $customs_link = route('customs.details', $customs->id);
            $photo = $customs->photo ? url($customs->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-customs-marker';

            $outletsArr[] = array($name, $address, $customs_coords, $customs_link, $photo, $marker_class, $customs_type, $province);
        }

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('frontend.customs.customs_all', compact('latitudeVal', 'longitudeVal', 'customsAll', 'outletsArr', 'query'));
    } //End method

    public function CustomsAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $customsAll = Customsoutlet::search($query)->paginate(12);

        $customs_id_arr = $customsAll->pluck('id');

        $outletsArr = [];

        foreach ($customsAll as $customs) {
            $customs_type = $customs->customs_type;
            $name = $customs->name;
            $province = $customs->province;
            $address = $customs->address;
            $customs_coords = [$customs->latitude, $customs->longitude];
            $customs_link = route('customs.details', $customs->id);
            $photo = $customs->photo ? url($customs->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-customs-marker';

            $outletsArr[] = array($name, $address, $customs_coords, $customs_link, $photo, $marker_class, $customs_type, $province);
        }

        if (count($outletsArr)) {
            $latitudeVal = $outletsArr[0][2][0];
            $longitudeVal = $outletsArr[0][2][1];
        } else {
            $latitudeVal = env('latitudeVal');
            $longitudeVal = env('longitudeVal');
        }

        return view('frontend.customs.customs_all', compact('latitudeVal', 'longitudeVal', 'customsAll', 'outletsArr', 'query'));
    } //End method

    public function FreightageAll()
    {
        $freightages = User::where('role', 'freightage')->where('status', 'active')->orderBy('id', 'DESC')->paginate(30);

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('freightage.freightage_all', compact('freightages', 'query'));
    } //End method

    public function FreightageDetails($id)
    {
        $freightage = User::findOrFail(Purify::clean($id));

        // check if freightage is inactive to disable shop single page
        $freightage_user_type = $freightage->role;
        if ($freightage_user_type == 'freightage') {
            $freightage_status = $freightage->status;
            if ($freightage_status == 'inactive') {
                return redirect(route('shop'))->with('error', 'صفحه مورد نظر یافت نشد.');
            }
        }
        // end of - check if freightage is inactive to disable shop single page

        return view('freightage.freightage_details', compact('freightage'));
    } //End method

    public function FreightageAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $freightages = User::search($query)->where('status','active')->where('role','freightage')->paginate(12);

        return view('freightage.freightage_all', compact('freightages', 'query'));
    } //End method

    public function DriverAll()
    {
        $drivers = User::where('role', 'driver')->where('status', 'active')->orderBy('id', 'DESC')->paginate(30);

        $query = "";

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('driver.driver_all', compact('drivers', 'query'));
    } //End method

    public function DriverDetails($id)
    {
        $driver = User::findOrFail(Purify::clean($id));

        // check if driver is inactive to disable shop single page
        $driver_user_type = $driver->role;
        if ($driver_user_type == 'driver') {
            $driver_status = $driver->status;
            if ($driver_status == 'inactive') {
                return redirect(route('shop'))->with('error', 'صفحه مورد نظر یافت نشد.');
            }
        }
        // end of - check if driver is inactive to disable shop single page

        return view('driver.driver_details', compact('driver'));
    } //End method

    public function DriverAllSearch(Request $request)
    {
        $query = Purify::clean($request['query']);
        
        $drivers = User::search($query)->where('status','active')->where('role','driver')->paginate(12);

        return view('driver.driver_all', compact('drivers', 'query'));
    } //End method

    public function ViewShop()
    {
        SEOMeta::setTitle('پلتفرم اقتصادی یلسو');
        SEOMeta::setDescription('قیمت سیمان قیمت بتن قیمت فولاد خرید اینترنتی محصولات معدنی و ماشین آلات کشاورزی');
        SEOMeta::setKeywords(['قیمت سیمان', 'قیمت بتن', 'قیمت فولاد', 'یلسو']);

        OpenGraph::setTitle('یلسو');
        OpenGraph::setDescription('قیمت سیمان, قیمت بتن, قیمت فولاد, خرید اینترنتی محصولات معدنی, ماشین آلات کشاورزی');

        // exclude products which store has been disabled
        $products_arr = [];

        $products = Product::where('status', 'active')->latest()->get();
        
        foreach ($products as $product) {
            if ($product->vendor_id != NULL) {
                $vendor_id = (int) $product->vendor_id;
                $vendor_user = User::where('id', $vendor_id)->first();

                if ($vendor_user && $vendor_user->role == "vendor" && ($vendor_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->merchant_id != NULL) {
                $merchant_id = (int) $product->merchant_id;
                $merchant_user = User::where('id', $merchant_id)->first();

                if ($merchant_user && $merchant_user->role == "merchant" && ($merchant_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->retailer_id != NULL) {
                $retailer_id = (int) $product->retailer_id;
                $retailer_user = User::where('id', $retailer_id)->first();

                if ($retailer_user && $retailer_user->role == "retailer" && ($retailer_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            $products_arr[] = $product;
        }
        $products = new Collection($products_arr);

        $totalGroup = count($products);
        $perPage = 40;
        $page = Paginator::resolveCurrentPage('page');

        $products = new LengthAwarePaginator($products->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        // End of - exclude products which store has been disabled


        $categories = Category::latest()->get();
        $parentCategories = Category::where('parent', 0)->latest()->get()->reverse();

        $root_catgory_obj = NULL;
        $category_hierarchy_arr = [];

        // category for filter
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);
        }
        $filter_category_array = array_reverse($filter_category_array);
        // category for filter

        $category = NULL;
        $outletsArr = [];


        // افزودن نقاط تامین کنندگان
        $outlets = Outlet::all();
        foreach ($outlets as $outlet) {
            if ($outlet->user->status == 'active') {
                $shop_name = $outlet->shop_name;
                $shop_address = $outlet->shop_address;
                $shop_coords = [$outlet->latitude, $outlet->longitude];
                $shop_link = route('vendor.details', $outlet->user_id);
                $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
                $marker_class = 'leaflet-vendor-marker';

                $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
            }
        }
        // افزودن نقاط تامین کنندگان


        // افزودن نقاط بازرگانان
        $outlets = Merchantoutlet::all();
        foreach ($outlets as $outlet) {
            if ($outlet->user->status == 'active') {
                $shop_name = $outlet->shop_name;
                $shop_address = $outlet->shop_address;
                $shop_coords = [$outlet->latitude, $outlet->longitude];
                $shop_link = route('merchant.details', $outlet->user_id);
                $shop_logo = $outlet->user->photo ? url('storage/upload/merchant_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
                $marker_class = 'leaflet-merchant-marker';

                $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
            }
        }
        // افزودن نقاط بازرگانان


        // افزودن نقاط خرده فروشان
        $outlets = Retaileroutlet::all();
        foreach ($outlets as $outlet) {
            if ($outlet->user->status == 'active') {
                $shop_name = $outlet->shop_name;
                $shop_address = $outlet->shop_address;
                $shop_coords = [$outlet->latitude, $outlet->longitude];
                $shop_link = route('retailer.details', $outlet->user_id);
                $shop_logo = $outlet->user->photo ? url('storage/upload/retailer_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
                $marker_class = 'leaflet-retailer-marker';

                $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
            }
        }
        // افزودن نقاط خرده فروشان


        // افزودن نقاط گمرک ها
        $outlets = Customsoutlet::all();
        foreach ($outlets as $outlet) {
            $name = $outlet->name;
            $address = $outlet->address;
            $coords = [$outlet->latitude, $outlet->longitude];
            $link = route('customs.details', $outlet->id);
            $logo = $outlet->photo ? url($outlet->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
            $marker_class = 'leaflet-customs-marker';

            $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
        }
        // افزودن نقاط گمرک ها

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده


        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        $inputArray = [];

        return view('frontend.shop', compact('latitudeVal', 'longitudeVal', 'outletsArr', 'category', 'products', 'categories', 'parentCategories', 'root_catgory_obj', 'category_hierarchy_arr', 'filter_category_array', 'inputArray'));
    } //End method

    public function ViewShopFiltered(Request $request)
    {
        $products = [];
        $cat_id_arr = [];
        $category_hierarchy_arr = [];

        $query_str = parse_url(Purify::clean($request->getRequestUri()), PHP_URL_QUERY);
        parse_str($query_str, $output);

        foreach ($output as $key => $cat) {
            preg_match("/category_[0-9]+/", $key, $matches);
            if ($matches) {
                $cat_id_arr[] = $cat;
            }
        }

        // dd($request->min_price);
        // dd($request->max_price);

        if (! empty($cat_id_arr)) {
            foreach ($cat_id_arr as $key => $category_filter) {
                $category_products = Category::with('products')->where('id', $category_filter)->get();
                $products[] = $category_products[0]->products;
            }

            $products = new Collection($products);
            $products = $products->flatten();


            if (! $products->isEmpty()) {
                foreach ($products as $product) {
                    $product_ids[] = $product->id;
                }

                $product_ids = array_unique($product_ids);

                foreach ($product_ids as $product_id) {
                    $product_id_arr[] = Product::find($product_id);
                }
                $products = $product_id_arr;
            } else {
                $products = [];
            }
        } else {
            $products = Product::latest()->get();
        }


        // exclude products which store has been disabled
        $products_arr = [];
        foreach ($products as $product) {
            if ($product->status == 'disabled') {
                continue;
            }

            if ($product->vendor_id != NULL) {
                $vendor_id = (int) $product->vendor_id;
                $vendor_user = User::where('id', $vendor_id)->first();

                if ($vendor_user && $vendor_user->role == "vendor" && ($vendor_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->merchant_id != NULL) {
                $merchant_id = (int) $product->merchant_id;
                $merchant_user = User::where('id', $merchant_id)->first();

                if ($merchant_user && $merchant_user->role == "merchant" && ($merchant_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->retailer_id != NULL) {
                $retailer_id = (int) $product->retailer_id;
                $retailer_user = User::where('id', $retailer_id)->first();

                if ($retailer_user && $retailer_user->role == "retailer" && ($retailer_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            $products_arr[] = $product;
        }
        $products = new Collection($products_arr);
        // End of - exclude products which store has been disabled



        $inputArray = Purify::clean($request->input());

        $categories = Category::latest()->get();
        $parentCategories = Category::where('parent', 0)->latest()->get();

        $root_catgory_obj = NULL;

        // category for filter
        $filter_category_array = [];
        foreach ($parentCategories as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        $filter_category_array = array_reverse($filter_category_array);
        // category for filter

        $category = NULL;
        $outletsArr = [];

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        return view('frontend.shop', compact('latitudeVal', 'longitudeVal', 'outletsArr', 'category', 'products', 'categories', 'parentCategories', 'root_catgory_obj', 'category_hierarchy_arr', 'filter_category_array', 'inputArray'));
    } //End method

    public function ViewShopCategoryFiltered(Request $request)
    {
        $category_hierarchy_arr = [];

        $id = Purify::clean(request('id'));

        // exclude products which store has been disabled
        $category = Category::where('id', $id)->first();

        if(empty($category)) {
            redirect()->to('/')->send();
        }

        $products = $category->products()->where('status', 'active')->latest()->get();
        
        $products_arr = [];

        foreach ($products as $product) {
            if ($product->vendor_id != NULL) {
                $vendor_id = (int) $product->vendor_id;
                $vendor_user = User::where('id', $vendor_id)->first();

                if ($vendor_user && $vendor_user->role == "vendor" && ($vendor_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->merchant_id != NULL) {
                $merchant_id = (int) $product->merchant_id;
                $merchant_user = User::where('id', $merchant_id)->first();

                if ($merchant_user && $merchant_user->role == "merchant" && ($merchant_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            if ($product->retailer_id != NULL) {
                $retailer_id = (int) $product->retailer_id;
                $retailer_user = User::where('id', $retailer_id)->first();

                if ($retailer_user && $retailer_user->role == "retailer" && ($retailer_user->status == 'inactive' || $product->product_verification == 'inactive')) {
                    continue;
                }
            }

            $products_arr[] = $product;
        }
        $products_without_pagination = new Collection($products_arr);

        $totalGroup = count($products_without_pagination);
        $perPage = 40;
        $page = Paginator::resolveCurrentPage('page');

        $products = new LengthAwarePaginator($products_without_pagination->forPage($page, $perPage), $totalGroup, $perPage, $page, [
            'path' => 'https://www.yelsu.com/shop/category?id=' . $id,
            'pageName' => 'page',
        ]);
        // End of - exclude products which store has been disabled


        $categories = Category::latest()->get();
        $parentCategories = Category::where('parent', $id)->latest()->get()->reverse();

        // added recursive function
        $category_by_id = Category::find($id);
        foreach ($categories as $categoryItem) {
            if ($category_by_id->parent == 0) {
                $root_catgory_obj = $category_by_id;

                $category_hierarchy_arr[] = $category_by_id;
                break;
            } else {
                $category_hierarchy_arr[] = $category_by_id;

                $category_by_id = Category::find($category_by_id->parent);
            }
        }
        // end of - recursive function

        $category_hierarchy_arr = array_reverse($category_hierarchy_arr);

        // category for filter
        $filter_category_array = [];
        $parentCategoriesTotal = Category::where('parent', 0)->latest()->get();
        foreach ($parentCategoriesTotal as $parentCategory) {
            $all_children = Category::find($parentCategory->id)->child;
            $filter_category_array[] = array($parentCategory, $all_children);

        }
        $filter_category_array = array_reverse($filter_category_array);
        // category for filter


        // افزودن نقاط تامین کنندگان
        $outletsArr = [];
        $outletsArrDB = [];
        $outlets = Outlet::all();

        foreach ($outlets as $outlet) {
            $category_id_arr = explode(",", $outlet->category_id);
            if (in_array($id, $category_id_arr)) {
                $outletsArrDB[] = $outlet;
            }
        }

        foreach ($outletsArrDB as $outlet) {
            if ($outlet->user->status == 'active') {
                $shop_name = $outlet->shop_name;
                $shop_address = $outlet->shop_address;
                $shop_coords = [$outlet->latitude, $outlet->longitude];
                $shop_link = route('vendor.details', $outlet->user_id);
                $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
                $marker_class = 'leaflet-vendor-marker';

                $outletsArr[] = array($shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
            }
        }
        // افزودن نقاط تامین کنندگان

        // افزودن موقعیت مکانی کاربر وارد شده 
        if (Auth::check()) {
            $outlets = Useroutlets::where('user_id', Auth::user()->id)->get();
            foreach ($outlets as $outlet) {
                $name = $outlet->name;
                $address = $outlet->address;
                $coords = [$outlet->latitude, $outlet->longitude];
                $link = NULL;
                $logo = 'https://www.yelsu.com/frontend/assets/plugins/leaflet/images/marker-icon.png';
                $marker_class = 'leaflet-user-marker';

                $outletsArr[] = array($name, $address, $coords, $link, $logo, $marker_class);
            }
        }
        // افزودن موقعیت مکانی کاربر وارد شده

        $latitudeVal = env('latitudeVal');
        $longitudeVal = env('longitudeVal');

        $inputArray = [];
        
        // تنظیمات سئو داینامیک
        if ($category->meta_title != NULL) {
            SEOMeta::setTitle($category->meta_title);
        }
        if ($category->meta_description != NULL) {
            SEOMeta::setDescription($category->meta_description);
        }
        if ($category->meta_keywords != NULL) {
            $meta_keywords = explode('،', $category->meta_keywords);
            SEOMeta::setKeywords($meta_keywords);
        }

        
        return view('frontend.shop', compact('latitudeVal', 'longitudeVal', 'outletsArr', 'category', 'products', 'categories', 'parentCategories', 'root_catgory_obj', 'category_hierarchy_arr', 'filter_category_array', 'inputArray'));
    }

    // ایجاد آرایه ای از آی دی محصولاتی که مجاز نیستند
    // public function getDisallowedProducts() {
    //     $products_arr_id = [];
    //     $all_products = Product::all();
    //     foreach ($all_products as $product) {

    //         if ($product->vendor_id != NULL) {
    //             $vendor_id = (int) $product->vendor_id;
    //             $vendor_user = User::where('id', $vendor_id)->first();

    //             if ($vendor_user && $vendor_user->role == "vendor" && ($vendor_user->status == 'inactive' || $product->product_verification == 'inactive')) {
    //                 $products_arr_id[] = $product->id;
    //                 continue;
    //             }
    //         }

    //         if ($product->merchant_id != NULL) {
    //             $merchant_id = (int) $product->merchant_id;
    //             $merchant_user = User::where('id', $merchant_id)->first();

    //             if ($merchant_user && $merchant_user->role == "merchant" && ($merchant_user->status == 'inactive' || $product->product_verification == 'inactive')) {
    //                 $products_arr_id[] = $product->id;
    //                 continue;
    //             }
    //         }

    //         if ($product->retailer_id != NULL) {
    //             $retailer_id = (int) $product->retailer_id;
    //             $retailer_user = User::where('id', $retailer_id)->first();

    //             if ($retailer_user && $retailer_user->role == "retailer" && ($retailer_user->status == 'inactive' || $product->product_verification == 'inactive')) {
    //                 $products_arr_id[] = $product->id;
    //                 continue;
    //             }
    //         }

    //         if($product->status == "disabled") {
    //             $products_arr_id[] = $product->id;
    //         }
    //     }

    //     return $products_arr_id;
    // }

    // ایجاد آرایه ای از آی دی محصولاتی که مجاز هستند
    public function getAllowedProducts($products) {
        $products_arr_id = [];
        
        foreach ($products as $product) {

            if($product->determine_product_owner->id !== 1 && ($product->determine_product_owner->status == "inactive" || $product->product_verification == 'inactive')) {
                continue;
            }

            $products_arr_id[] = $product->id;
        }

        return $products_arr_id;
    }

    public function ViewSearchProducts(Request $request)
    {
        $category_id = Purify::clean($request->cat_id);
        $parentCategories = Category::where('parent', 0)->latest()->get();
       
        if (Purify::clean($request['query']) == NULL) {
            return back();
        }
        
        if (in_array($category_id, [0, 1, 2, 3, 4, 5, 6, 7, 8])) {
            $search_keyword = Purify::clean($request['query']);

            // ایجاد آرایه ای از آی دی محصولاتی که مجاز هستند
            $all_products = Product::all();
            $products_arr_id = $this->getAllowedProducts($all_products);
            
            if ($category_id == 0) {
                $products = Product::search($search_keyword)->whereIn('id', $products_arr_id)->paginate(24);
            } else {
                $products = Product::search($search_keyword)->whereIn('id', $products_arr_id)->where('parent_category_id', $category_id)->paginate(24);
            }
            
            $categories = Category::latest()->get();

            $root_catgory_obj = NULL;
            $category_hierarchy_arr = NULL;

            // category for filter
            $filter_category_array = [];
            foreach ($parentCategories as $parentCategory) {
                $all_children = Category::find($parentCategory->id)->child;
                $filter_category_array[] = array($parentCategory, $all_children);

            }
            $filter_category_array = array_reverse($filter_category_array);
            // category for filter

            $category = NULL;
            $outletsArr = [];

            $latitudeVal = env('latitudeVal');
            $longitudeVal = env('longitudeVal');

            $inputArray = [];

            return view('frontend.shop', compact('latitudeVal', 'longitudeVal', 'outletsArr', 'category', 'products', 'categories', 'parentCategories', 'root_catgory_obj', 'category_hierarchy_arr', 'filter_category_array', 'inputArray'));
        } elseif ($category_id == "v") {
            return $this->VendorAllSearch($request);
        } elseif ($category_id == "m") {
            return $this->MerchantAllSearch($request);
        } elseif ($category_id == "r") {
            return $this->RetailerAllSearch($request);
        } elseif ($category_id == "c") {
            return $this->CustomsAllSearch($request);
        } elseif ($category_id == "f") {
            return $this->FreightageAllSearch($request);
        } elseif ($category_id == "d") {
            return $this->DriverAllSearch($request);
        }

        return NULL;
    }

    // متد برای بارگذاری جدول قیمت صفحه دسته بندی
    public function CategoryFetchPriceTables(Request $request) {
        $products_arr = [];

        $category_id = Purify::clean($request->category_id);
        $pagination_vendor_id = Purify::clean($request->pagination_vendor_id);

        $category = Category::where('id', $category_id)->first();
        $products = $category->products()->where('status', 'active')->select([
        "id",
        "products.category_id", 
        "product_name", 
        "product_slug", 
        "selling_price", 
        "vendor_id", 
        "product_verification", 
        "merchant_id", 
        "retailer_id",
        "owner_id"
        ])->get();
        
        foreach ($products as $product) {
            
            if($product->determine_product_owner->id !== 1 && ($product->determine_product_owner->status == "inactive" || $product->product_verification == 'inactive')) {
                continue;
            }

            $products_arr[] = $product;
        }
       
        $products_without_pagination = new Collection($products_arr);
        $sort_products_by_last_vendor_total = Product::sort_products_by_last_vendor($products_without_pagination);
        
        $table = [];
        $table_header_arr = [];
        $thead_arr = [];

        // تهیه یک لیست از موارد هدر جدول
        foreach($category->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_header_key => $attribute_header_items) {
            $thead_arr[] = $attribute_header_items->attribute_item_name;
        }
        
        // اینجا برای صفحه گذاری استفاده می شود
        $sort_products_by_last_vendor = $pagination_vendor_id != null ? array($pagination_vendor_id => $sort_products_by_last_vendor_total[$pagination_vendor_id]) : array(key($sort_products_by_last_vendor_total) => reset($sort_products_by_last_vendor_total));

        foreach ($sort_products_by_last_vendor as $user_id => $product_object_array) {

            // اگر جدول مربوط به کاربر تأمین کننده باشد
            if(User::find($user_id)->role == "vendor") {

                if(!empty(User::find($user_id)->photo)) {
                    $table[$user_id]['table_header_arr']['img_src_url'] = url('storage/upload/vendor_images/' . User::find($user_id)->photo);
                } else {
                    $table[$user_id]['table_header_arr']['img_src_url'] = asset('frontend/assets/images/demos/demo13/logo_cropped.png');
                }

                $table[$user_id]['table_header_arr']['anchor_link'] = route('vendor.details', $user_id);
                $table[$user_id]['table_header_arr']['shop_name'] = User::find($user_id)->shop_name;
                $table[$user_id]['table_header_arr']['category_name'] = $category->category_name;
                $table[$user_id]['table_header_arr']['user_role'] = "vendor";

            // اگر جدول مربوط به کاربر بازرگان باشد
            } elseif(User::find($user_id)->role == "merchant") {

                if(!empty(User::find($user_id)->photo)) {
                    $table[$user_id]['table_header_arr']['img_src_url'] = url('storage/upload/merchant_images/' . User::find($user_id)->photo);
                } else {
                    $table[$user_id]['table_header_arr']['img_src_url'] = asset('frontend/assets/images/demos/demo13/logo_cropped.png');
                }

                $table[$user_id]['table_header_arr']['anchor_link'] = route('merchant.details', $user_id);
                $table[$user_id]['table_header_arr']['shop_name'] = User::find($user_id)->shop_name;
                $table[$user_id]['table_header_arr']['category_name'] = $category->category_name;
                $table[$user_id]['table_header_arr']['user_role'] = "merchant";

            // اگر جدول مربوط به کاربر خرده فروش باشد
            } elseif(User::find($user_id)->role == "retailer") {

                if(!empty(User::find($user_id)->photo)) {
                    $table[$user_id]['table_header_arr']['img_src_url'] = url('storage/upload/retailer_images/' . User::find($user_id)->photo);
                } else {
                    $table[$user_id]['table_header_arr']['img_src_url'] = asset('frontend/assets/images/demos/demo13/logo_cropped.png');
                }

                $table[$user_id]['table_header_arr']['anchor_link'] = route('retailer.details', $user_id);
                $table[$user_id]['table_header_arr']['shop_name'] = User::find($user_id)->shop_name;
                $table[$user_id]['table_header_arr']['category_name'] = $category->category_name;
                $table[$user_id]['table_header_arr']['user_role'] = "retailer";

            // اگر جدول مربوط به خود یلسو باشد
            } elseif(User::find($user_id)->role == "admin" || User::find($user_id)->role == "specialist") {

                $table[$user_id]['table_header_arr']['img_src_url'] = asset('frontend/assets/images/demos/demo13/logo_cropped.png');
                $table[$user_id]['table_header_arr']['anchor_link'] = "";
                $table[$user_id]['table_header_arr']['shop_name'] = "یلسو";
                $table[$user_id]['table_header_arr']['category_name'] = $category->category_name;
                $table[$user_id]['table_header_arr']['user_role'] = "admin";

            }

            // ایجاد آرایه ای از محصولات مرتبط
            foreach ($product_object_array as $product_key => $product_item) {
                $table[$user_id]['products_array'][$product_key]['anchor_link'] = route('product.details', $product_item->product_slug);
                $table[$user_id]['products_array'][$product_key]['product_name'] = $product_item->product_name;

                // تهیه یک لیست از مقادیر ویژگی ها
                foreach ($category->attributes->first()->items->where('show_in_table_page', 1)->sortBy('attribute_item_order', SORT_NUMERIC) as $attribute_row_key => $attribute_row_items) {
                    if(in_array($attribute_row_items->id, $product_item->table_attribute_items_obj_array()->keys()->toArray()))
                        if($attribute_row_items->attribute_item_type == "dropdown") {
                            $table[$user_id]['products_array'][$product_key]['attribute_value_array'][] = collect($product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value_obj'])->pluck('value')->join('، ');
                        } else {
                            $table[$user_id]['products_array'][$product_key]['attribute_value_array'][] = $product_item->table_attribute_items_obj_array()[$attribute_row_items->id]['attribute_value'];
                        }
                    else {
                        $table[$user_id]['products_array'][$product_key]['attribute_value_array'][] = "ناموجود";
                    }
                }

                // بخش قیمت محصول    
                $table[$user_id]['products_array'][$product_key]['selling_price'] = $product_item->price_with_commission;
                $table[$user_id]['products_array'][$product_key]['selling_price_formatted'] = number_format($product_item->price_with_commission, 0, '', ',');
                $table[$user_id]['products_array'][$product_key]['product_value_added_tax_by_percent'] = $product_item->determineProductValueAddedTaxByPercent();
                $table[$user_id]['products_array'][$product_key]['product_currency'] = $product_item->determine_product_currency();
            }
        }

        $vendor_name_array = [];
        foreach ($sort_products_by_last_vendor_total as $user_id_total => $vendor_product_total) {
            // ایجاد یک لیست از نام تامین کنندگان بر اساس شماره آن ها
            if(User::find($user_id_total)->role == "admin" || User::find($user_id_total)->role == "specialist") {
                $vendor_name_array[$user_id_total] = "یلسو";
            } else {
                $vendor_name_array[$user_id_total] = User::find($user_id_total)->shop_name;
            }
        }

        return response(['table' => $table, 'thead_arr' => $thead_arr, 'vendor_name_array' => $vendor_name_array]);
    }
}
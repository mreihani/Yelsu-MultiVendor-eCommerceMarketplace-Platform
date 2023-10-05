<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';


Route::get('changeDatabase', function () {
    // $all_users = App\Models\User::all();
    // foreach ($all_users as $value) {
    //     // FIX - ISSUE in USERNAME
    //     if (str_contains($value->username, '-')) {
    //         $username2 = str_replace("-", "_", $value->username);
    //         $value->username = $username2;
    //         $value->save();
    //     }

    //     // LOWER CASE USERNAME
    //     $username2 = strtolower($value->username);
    //     $value->username = $username2;
    //     $value->save();
    // }


    // $role = "admin";
    // $selected_categories_arr = [1,662];
    // $attributes = App\Models\Category::find(662)->attributes()->get();
    // $attribute_items = $attributes[0]->items;

    // // اینجا برای هر ویژگی چک کن که آیا مجاز به استفاده از اون ویژگی هست یا خیر
    // $user_role_permission = true;
    // if(!in_array($role, explode(',', $attributes[0]->role))) {
    //     $user_role_permission = false;
    // } 
    // foreach ($attribute_items as $attribute_item) {
    //     if($user_role_permission && App\Models\User::canVendorSeeAttribute($attributes[0]->category_id, implode(',', $selected_categories_arr))){
    //         $attribute_item->push(['values' => $attribute_item->values]);
    //         $selected_attributes_arr[] = $attribute_item;
    //     }
    // }    

    // $duplicated_parent = App\Models\Category::duplicatedParentCategory($selected_categories_arr);
    // dd($selected_attributes_arr);   



});
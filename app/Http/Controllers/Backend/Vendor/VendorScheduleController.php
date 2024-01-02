<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\Product;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use App\Rules\VendorScheduleDailyDeliveryCapacityValidation;

class VendorScheduleController extends Controller
{
    public function VendorAddSchedule() {
        $vendorData = auth()->user();
        $vendor_products = Product::sort_products_by_last_category($vendorData->vendorProducts);

        return view('vendor.backend.schedule.schedule_add', compact('vendorData', 'vendor_products'));
    }

    public function VendorStoreSchedule(Request $request) {

        $incomingFields = $request->validate([
            'product_obj' => new VendorScheduleDailyDeliveryCapacityValidation($request),
        ]);

        foreach ($incomingFields['product_obj'] as $product_obj_item) {
            $product_item = json_decode($product_obj_item);

            $schedule_obj = Schedule::updateOrCreate(
            [
                'product_id' => $product_item->product_id,
            ],
            [
                'product_id' => $product_item->product_id,
                'product_deliver_capacity' => $product_item->product_deliver_capacity,
                'daily_deliver_capacity' => $product_item->daily_deliver_capacity,
            ]);
            
            // check if specific date and specific capacity have been equally submitted
            if(
                ($product_item->specific_deliver_date && $product_item->specific_deliver_capacity) && 
                sizeof($product_item->specific_deliver_date) == sizeof($product_item->specific_deliver_capacity)
            ) 
            {
                // generate an assoc array for specific values
                $specific_values_array = [];
                foreach ($product_item->specific_deliver_date as $key => $specific_value) {
                    $date_item = $product_item->specific_deliver_date[$key];
                    $specific_deliver_date_format = Jalalian::fromFormat('Y/m/d', $date_item)->toCarbon()->toDateTimeString();
                    
                    $specific_values_array[] = array(
                        'specific_deliver_date' => $date_item,
                        'specific_deliver_date_format' => $specific_deliver_date_format,
                        'specific_deliver_capacity' => $product_item->specific_deliver_capacity[$key],
                    );
                }
            }

            // first clear every data of specific values
            $schedule_obj->schedule_date()->delete();
           
            // // check if capacity is enabled then insert into DB
            if($product_item->product_deliver_capacity) {
                foreach ($specific_values_array as $specific_value_item) {
                    $schedule_obj->schedule_date()->create([
                        'schedule_id' => $schedule_obj->id,
                        'specific_deliver_date' => $specific_value_item['specific_deliver_date'],
                        'specific_deliver_date_format' => $specific_value_item['specific_deliver_date_format'],
                        'specific_deliver_capacity' => $specific_value_item['specific_deliver_capacity'],
                    ]);
                }
            }
        }

        return redirect(route("vendor.add.schedule"))->with("success", "برنامه زمان بندی با موفقیت به روز رسانی گردید.");
    }
}

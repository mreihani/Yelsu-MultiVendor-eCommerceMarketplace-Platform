<?php

namespace App\Console\Commands;

use App\Models\Productliveprice;
use Stevebauman\Purify\Facades\Purify;

use Illuminate\Console\Command;

class MilgerdAjdarAlborzGharb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:milgerd-ajdar-alborz-gharb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to insert milgerd-ajdar-alborz-gharb into DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        require_once app_path() . "/Includes/simple_html_dom.php";

        $milgered_product_id = 24;
        $milgered_category_id = 18;
        $vendor_id = 288;

        $html = file_get_html('https://ahanmelal.com/rebar/ribbed-rebar-price/alborz-gharb-rebar');
        $alborz_qarb_html = str_get_html($html);
        $alborz_qarb_price_table = $alborz_qarb_html->find("div#62fdd594e70aa910ffe10b3d");

        // check if received anything right from ahanmelal.com website
        if (sizeof($alborz_qarb_price_table)) {

            $alborz_qarb_tableArray = $alborz_qarb_price_table[0]->children(1)->children(1)->children();

            $alborz_qarb_factory_name = Purify::clean(trim($alborz_qarb_price_table[0]->children(0)->children(0)->children(1)->children(0)->plaintext));
            $alborz_qarb_latest_update = Purify::clean(trim($alborz_qarb_price_table[0]->children(0)->children(0)->children(1)->children(1)->plaintext));

            $alborz_qarb_db = Productliveprice::where('product_factory_name', $alborz_qarb_factory_name)->orderBy("id", 'ASC')->get();


            // اینجا عملیات خواندن سطر اول جدول به صورت خود  به خود انجام میگیرد
            $alborz_qarb_headArray = $alborz_qarb_price_table[0]->children(1)->children(0)->children(0);
            $tableHeadTitleArr = [];
            foreach ($alborz_qarb_headArray->children as $headItem) {
                $tableHeadTitleArr[] = trim($headItem->plaintext);
            }

            foreach (config("services.ahanmelal.rebar.table_head.product_name") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_name_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_type") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_type_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_analyze") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_analyze_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_weight") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_weight_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_unit_of_measurement") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_unit_of_measurement_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_loading_place") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_loading_place_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_size") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_size_index = array_search($value, $tableHeadTitleArr);
                }
            }
            foreach (config("services.ahanmelal.rebar.table_head.product_price_today") as $value) {
                if (array_search($value, $tableHeadTitleArr)) {
                    $product_price_today_index = array_search($value, $tableHeadTitleArr);
                }
            }
            // اینجا عملیات خواندن سطر اول جدول به صورت خود  به خود انجام میگیرد


            // here check if anything available in database
            if (count($alborz_qarb_db)) {

                $alborz_qarb_latest_update_db = $alborz_qarb_db->last()->product_latest_update;

                if ($alborz_qarb_latest_update_db != $alborz_qarb_latest_update) {
                    $alborz_qarb_price_update_number = $alborz_qarb_db->last()->product_price_update_number;
                    $latest_query_pack = Productliveprice::where('product_price_update_number', $alborz_qarb_price_update_number)->latest()->get();

                    // insert into db
                    foreach ($alborz_qarb_tableArray as $key => $tableRow) {

                        Productliveprice::insert([
                            'product_name' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_name_index]->plaintext)),
                            'product_type' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_type_index]->plaintext)),
                            'product_analyze' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_analyze_index]->plaintext)),
                            'product_weight' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_weight_index]->plaintext)),
                            'product_unit_of_measurement' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_unit_of_measurement_index]->plaintext)),
                            'product_loading_place' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_loading_place_index]->plaintext)),
                            'product_size' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_size_index]->plaintext)),
                            'product_price_yesterday' => $latest_query_pack[$key]->product_price_today,
                            'product_price_today' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_price_today_index]->plaintext)),

                            'product_factory_name' => $alborz_qarb_factory_name,
                            'product_latest_update' => $alborz_qarb_latest_update,
                            'product_price_update_number' => $alborz_qarb_price_update_number + 1,
                            'factory_pic' => 'alborz_qarb.png',
                            'category_id' => $milgered_category_id,
                            'product_id' => $milgered_product_id,
                        ]);

                    }
                }

                // here delete all and keep one month last results
                $product_price_update_number_arr = [];
                foreach ($alborz_qarb_db as $alborz_qarb_item) {
                    $product_price_update_number_arr[] = $alborz_qarb_item->product_price_update_number;
                }
                $product_price_update_number_arr = array_unique($product_price_update_number_arr);
                if (sizeof($product_price_update_number_arr) > config("services.ahanmelal.rebar.days_iteration")) {
                    foreach ($alborz_qarb_db as $alborz_qarb_item) {
                        Productliveprice::where('product_factory_name', $alborz_qarb_factory_name)->where('product_price_update_number', '=', $product_price_update_number_arr[0])->delete();
                    }
                }

            } else {

                foreach ($alborz_qarb_tableArray as $key => $tableRow) {

                    Productliveprice::insert([
                        'product_name' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_name_index]->plaintext)),
                        'product_type' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_type_index]->plaintext)),
                        'product_analyze' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_analyze_index]->plaintext)),
                        'product_weight' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_weight_index]->plaintext)),
                        'product_unit_of_measurement' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_unit_of_measurement_index]->plaintext)),
                        'product_loading_place' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_loading_place_index]->plaintext)),
                        'product_size' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_size_index]->plaintext)),
                        'product_price_yesterday' => NULL,
                        'product_price_today' => Purify::clean(trim($alborz_qarb_tableArray[$key]->children[$product_price_today_index]->plaintext)),

                        'product_factory_name' => $alborz_qarb_factory_name,
                        'product_latest_update' => $alborz_qarb_latest_update,
                        'product_price_update_number' => 1,
                        'factory_pic' => 'alborz_qarb.png',
                        'category_id' => $milgered_category_id,
                        'product_id' => $milgered_product_id,
                        'vendor_id' => $vendor_id,
                    ]);
                }
            }
            //end of (check if received anything right from ahanmelal.com website)    
        }
    }
}
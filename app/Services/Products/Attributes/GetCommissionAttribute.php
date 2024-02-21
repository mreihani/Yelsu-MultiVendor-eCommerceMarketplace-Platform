<?php

namespace App\Services\Products\Attributes;
use App\Models\AttributeItem;

class GetCommissionAttribute
{
    public static function getCommissionType($product) {

        $commission_type = null;

        $fix_commission =
        $product
        ->attributes
        ->pluck('items')
        ->flatten(1)
        ->where('attribute_item_keyword', 'fix_commission')
        ->first(); 

        $commission_type =
        $fix_commission
        ?
        'fix_commission'
        :
        'percent_commission';

        return $commission_type;
    }

    public static function getCommissionValue($product) {

        $commission_value = null;

        $fix_commission
        =
        $product
        ->attributes
        ->pluck('items')
        ->flatten(1)
        ->where('attribute_item_keyword', 'fix_commission')
        ->first(); 

        $precent_commission
        =
        $product
        ->attributes
        ->pluck('items')
        ->flatten(1)
        ->where('attribute_item_keyword', 'percent_commission')
        ->first(); 

        if($fix_commission) {
            $commission_value = AttributeItem::find($fix_commission->id)
            ->values
            ->where('attribute_item_id', $fix_commission->id)
            ->first()
            ->value;
        }

        if($precent_commission) {
            $commission_value = AttributeItem::find($precent_commission->id)
            ->values
            ->where('attribute_item_id', $precent_commission->id)
            ->first()
            ->value;
        }

        return $commission_value;
    }
}
<?php

namespace App\Services\Products\Attributes;
use App\Models\AttributeItem;

class GetAttributeValueByKeywordEagered
{
    public static function getAttributeValue($product, $keyword) {

        // Initialize attribute value
        $attributeValue = null;

        // Retrieve attribute item by keyword
        $attributeItem = $product
            ->attributes
            ->pluck('items')
            ->flatten(1)
            ->where('attribute_item_keyword', $keyword)
            ->first();

        // If attribute item not found, return null
        if (!$attributeItem) {
            return null;
        }

        // Get attribute item type
        $attributeItemType = $attributeItem->attribute_item_type;

        // If attribute item type is input field, retrieve and return attribute value
        if ($attributeItemType == 'input_field') {
            $attributeItemValue = $product
                ->attributes
                ->pluck('pivot')
                ->where('attribute_item_id', $attributeItem->id)
                ->first();

            // If attribute item value not found, return null
            if (!$attributeItemValue) {
                return null;
            }

            $attributeValue = $attributeItemValue->attribute_value;

            return $attributeValue;
        }

        // If attribute item type is dropdown, retrieve and return attribute value
        if ($attributeItemType == 'dropdown') {
            $attributeValue = AttributeItem::find($attributeItem->id)
                ->values
                ->where('attribute_item_id', $attributeItem->id)
                ->first()
                ->value;

            return $attributeValue;
        }
    }
}
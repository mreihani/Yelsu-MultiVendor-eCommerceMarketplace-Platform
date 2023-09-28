<?php

namespace App\Models;

use App\Models\AttributeValue;
use App\Models\AttributeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function attribute_categories()
    {
        return $this->belongsTo(AttributeCategory::class);
    }
}

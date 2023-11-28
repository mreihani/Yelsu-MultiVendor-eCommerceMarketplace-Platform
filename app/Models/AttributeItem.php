<?php

namespace App\Models;

use App\Models\Attribute;
use Laravel\Scout\Searchable;
use App\Models\AttributeValue;
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

    public function attributes()
    {
        return $this->belongsTo(Attribute::class,'attribute_id');
    }
}

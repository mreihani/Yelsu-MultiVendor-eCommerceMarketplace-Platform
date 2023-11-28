<?php

namespace App\Models;

use App\Models\AttributeItem;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attribute_items()
    {
        return $this->belongsTo(AttributeItem::class);
    }
}

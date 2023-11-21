<?php

namespace App\Models;

use App\Models\AttributeItem;
use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(AttributeItem::class);
    }
}

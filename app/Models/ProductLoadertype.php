<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Freightageloadertype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductLoadertype extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function loader_type() {
        return $this->belongsTo(Freightageloadertype::class, 'freightageloadertype_id');
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representative extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_in_stock', 'change_price_permission', 'product_geolocation_permission_province', 'product_geolocation_permission_city', 'product_geolocation_permission_export_country', 'product_specific_geolocation');
    }
}

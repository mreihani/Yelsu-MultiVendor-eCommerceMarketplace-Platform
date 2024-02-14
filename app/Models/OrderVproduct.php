<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderVproduct extends Model
{
    use HasFactory;
    protected $guarded =  [];

    /**
     * Define a relationship to the products.
     */
    public function products() {
        return $this->hasMany(
            Product::class, // Related model
            'id', // Foreign key on the products table
            'product_id' // Local key on the current model
        );
    }

    /**
     * Define a relationship with the Order model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * Define a relationship with the Shipping model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipping()
    {
        return $this->hasMany(Shipping::class);
    }
    
}

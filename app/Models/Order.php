<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Useroutlets;
use App\Models\OrderVproduct;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $guarded =  [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vproducts() {
        return $this->hasMany(OrderVproduct::class, 'order_id', 'id'); 
    } 

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function addresses() {
        return $this->belongsTo(Useroutlets::class, 'useroutlet_id', 'id');
    }
}

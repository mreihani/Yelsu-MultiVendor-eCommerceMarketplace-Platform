<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Useroutlets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $guarded =  [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity','price'); 
    } 

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function addresses() {
        return $this->belongsTo(Useroutlets::class, 'useroutlet_id', 'id');
    }
}

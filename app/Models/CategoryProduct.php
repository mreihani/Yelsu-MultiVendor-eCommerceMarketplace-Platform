<?php

namespace App\Models;

use App\Models\Product;
use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryProduct extends Model
{
    use HasFactory, Searchable;
    protected $guarded =  [];

}

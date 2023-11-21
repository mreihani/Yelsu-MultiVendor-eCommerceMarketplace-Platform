<?php

namespace App\Models;

use App\Models\User;
use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchant extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];
   
}

<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
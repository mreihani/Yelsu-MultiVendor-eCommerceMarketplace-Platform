<?php

namespace App\Models;

use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchantoutlet extends Model
{
    use HasFactory, Searchable;
    protected $guarded =  [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogcategory() {
        return $this->belongsTo(BlogCategory::class, 'category_id','id');
    }

    public function bloguser() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

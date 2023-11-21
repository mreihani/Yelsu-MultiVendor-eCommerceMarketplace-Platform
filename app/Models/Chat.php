<?php

namespace App\Models;

use App\Models\User;
use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'userId','id');
    }

    public function otherUser() {
        return $this->belongsTo(User::class, 'otherUserId','id');
    }
}

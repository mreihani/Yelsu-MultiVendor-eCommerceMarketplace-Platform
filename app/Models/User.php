<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use App\Models\Merchant;
use App\Models\Attribute;
use App\Models\ActiveCode;
use App\Models\Useroutlets;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function specialist_category()
    {
        return $this->belongsTo(Category::class, 'specialist_category_id', 'id');
    }

    public function merchantUser()
    {
        return $this->hasOne(Merchant::class, 'user_id', 'id');
    }

    public function outlets()
    {
        return $this->hasMany(Useroutlets::class);
    }

    public function freightage()
    {
        return $this->hasOne(Freightage::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function scopeCanUpdateAttribute($query, $attribute)
    {
        $collection = collect($attribute);
        $multiplied = $collection->map(function ($item, $key) {
            return $key;
        });
        foreach (Attribute::find($multiplied)->pluck('role') as $role) {
            if (! in_array(auth()->user()->role, explode(',', $role))) {
                return false;
            }
        }
        return true;
    }

}
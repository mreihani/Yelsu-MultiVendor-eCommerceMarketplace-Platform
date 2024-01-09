<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\Attribute;
use App\Models\ActiveCode;
use App\Models\Useroutlets;
use App\Models\ShetabitVisit;
use Laravel\Scout\Searchable;
use App\Models\Representative;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\FreightageVendorInvitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

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

    public $timestamps = false;

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

    public function vendor_outlets()
    {
        return $this->hasMany(Outlet::class);
    }

    public function outlets()
    {
        return $this->hasMany(Useroutlets::class);
    }

    public function user_outlets_array()
    {
        $outletsArr = [];
        $outlets = $this->outlets()->get();

        foreach ($outlets as $outlet) {
            
            $id = $outlet->id;
            $name = $outlet->name;
            $shop_coords = [$outlet->latitude, $outlet->longitude];
            $address = $outlet->address;

            $outletsArr[] = array($id, $name, $shop_coords, $address);
        }

        return $outletsArr;
    }

    public function verified_freightages_with_vendor_id() {
        return $this->hasMany(FreightageVendorInvitation::class, 'vendor_user_id')->where("verified",1);
    }

    public function verified_freightages_with_freightage_id() {
        return $this->hasMany(FreightageVendorInvitation::class, 'freightage_user_id')->where("verified",1);
    }

    public function vendor_outelts_array() {
        
        $outletsArr = [];
        $outlets = $this->vendor_outlets()->get();

        foreach ($outlets as $outlet) {
            if ($outlet->user->status == 'active') {
                $id = $outlet->id;
                $shop_name = $outlet->shop_name;
                $shop_address = $outlet->shop_address;
                $shop_coords = [$outlet->latitude, $outlet->longitude];
                $shop_link = route('vendor.details', $outlet->user_id);
                $shop_logo = $outlet->user->photo ? url('storage/upload/vendor_images/' . $outlet->user->photo) : url('frontend/assets/images/icons/store_alternative_icon.png');
                $marker_class = 'leaflet-vendor-marker';

                $outletsArr[] = array($id, $shop_name, $shop_address, $shop_coords, $shop_link, $shop_logo, $marker_class);
            }
        }

        return $outletsArr;
    }

    public function freightage()
    {
        return $this->hasOne(Freightage::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function chat() {
        return $this->hasMany(Chat::class,'userId','id');
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

    public function scopeCanVendorSeeAttribute($query, $category_id, $vendor_sector)
    {
        if($vendor_sector == NULL) {
            return true;
        }
        foreach (explode(',', $category_id) as $category_id_item) {
            if(in_array($category_id_item, explode(',', $vendor_sector))) {
                return true;
            }
        }
        return false;
    }

    public function representative()
    {
        return $this->hasOne(Representative::class);
    }

    public function vendor_representatives()
    {
        return $this->hasmany(Representative::class, 'vendor_id');
    }

    public function vendorProducts() {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function visits() {
        return $this->hasMany(ShetabitVisit::class, 'visitor_id')->orderBy('created_at', 'desc');
    }

    public function isUserOnline($seconds = 180) {

        $time = now()->subSeconds($seconds);

        return $this->visits()->where("updated_at", '>=', $time->toDateTime())->count() ? true : false;
    }

}
<?php

namespace App\Models;

use App\Models\User;
use App\Models\Freightagetype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FreightageVendorInvitation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_user_id');
    }

    public function freightage() {
        return $this->belongsTo(User::class, 'freightage_user_id');
    }

    public function getFreightageObject() {
        return $this->belongsTo(User::class, 'freightage_user_id')->get()->first()->freightage;
    }

    // دریافت آیتم والد
    public function getFreightageTypeParent() {
        $freightage_type = $this->getFreightageObject()->type;
        $freightage_type_array = explode(",", $freightage_type);
        $freightage_type_object = Freightagetype::getFreightageParentItems($freightage_type_array);

        return $freightage_type_object;
    }

   
}

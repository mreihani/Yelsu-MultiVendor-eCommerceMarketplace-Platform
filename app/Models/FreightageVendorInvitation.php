<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeService;

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
        $freightage_type_object = FreightageTypeService::getFreightageParentItems($freightage_type_array);

        return $freightage_type_object;
    }

    public function getFreightageTypeRoad() {
        $freightage_loader_type = $this->getFreightageObject()->freightage_loader_type;
        $freightage_type_array = explode(",", $freightage_loader_type);

        return $freightage_type_array;
    }

    public function getFreightageTypeRail() {
        $freightage_loader_type = $this->getFreightageObject()->freightage_loader_type_rail;
        $freightage_type_array = explode(",", $freightage_loader_type);

        return $freightage_type_array;
    }

    public function getFreightageTypeSea() {
        $freightage_loader_type = $this->getFreightageObject()->freightage_loader_type_sea;
        $freightage_type_array = explode(",", $freightage_loader_type);

        return $freightage_type_array;
    }

    public function getFreightageTypeAir() {
        $freightage_loader_type = $this->getFreightageObject()->freightage_loader_type_air;
        $freightage_type_array = explode(",", $freightage_loader_type);

        return $freightage_type_array;
    }
}

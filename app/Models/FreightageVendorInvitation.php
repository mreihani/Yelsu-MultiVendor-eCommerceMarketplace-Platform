<?php

namespace App\Models;

use App\Models\User;
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
}

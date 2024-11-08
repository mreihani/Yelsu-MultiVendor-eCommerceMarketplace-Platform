<?php

namespace App\Models;

use App\Models\User;
use App\Models\VendorSignature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor_signatures() {
        return $this->hasMany(VendorSignature::class);
    }
}

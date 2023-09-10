<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActiveCode extends Model
{
    
    protected $fillable = [
        'user_id',
        'code',
        'expired_at'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeVerifyCode($query, $code, $user) {
        $status = $user->activeCode()->where('expired_at', '>', now())->first();

        if(!is_null($status) && $status->code == $code) {
            return true;
        }
        return false;
    }

    public function scopeGenerateCode($query, $user) {
        if($code = $this->getAliveCodeForUser($user)) {
            $code = $code->code;
        } else {
            do {
                $code = mt_rand(10000,99999);
            } while($this->checkCodeIsUnique($user, $code));    

            $user->activeCode()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(2)
            ]);
        }

        // delete expired sms entry codes from database when a new code is created
        $user->activeCode()->where('expired_at', '<=', now())->delete();

        return $code;
    }

    private function checkCodeIsUnique($user, int $code) {
        return !! $user->activeCode()->where('code', $code)->first();
    }

    private function getAliveCodeForUser($user) {
        return $user->activeCode()->where('expired_at', '>', now())->first();
    }

    
}

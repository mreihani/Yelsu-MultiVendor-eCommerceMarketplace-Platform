<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Representative;
use Stevebauman\Purify\Facades\Purify;
use Symfony\Component\HttpFoundation\Response;

class VendorRepresentativeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = auth()->user()->id;
        $representative_id = Purify::clean($request->representative_id);
        $representative = Representative::find($representative_id);

        if($user_id == $representative->vendor_id) {
            return $next($request);
        }

        return redirect(route('vendor.all.representative'))->with('error', 'شما اجازه دسترسی به کاربر مورد نظر را ندارید!');
    }
}

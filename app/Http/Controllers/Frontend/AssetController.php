<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function __invoke($role, $user_id, $file)
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);

        $role = Purify::clean($role);
        $user_id = Purify::clean($user_id);
        $file = Purify::clean($file);

        $path = "secret/identity_verification_documents/$role/$user_id/$file";

        abort_unless(Storage::exists($path), Response::HTTP_NOT_FOUND);

        if (Auth::user()->id == $user_id || Auth::user()->role == 'admin' || Auth::user()->role == 'specialist') {

            return response()->file(
                Storage::path($path)
            );
        } else {
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}
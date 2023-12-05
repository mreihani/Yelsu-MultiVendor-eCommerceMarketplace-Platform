<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stevebauman\Purify\Facades\Purify;

class GeomarketingController extends Controller
{
    public function sendCoords(Request $request)
    {
        $lat = Purify::clean($request->lat);
        $lng = Purify::clean($request->lng);

        $NESHAN_SERVICES_API_KEY = config("services.neshan.api-key.services");

        $neshan_response = Http::withHeaders(["Api-Key" => $NESHAN_SERVICES_API_KEY])->get("https://api.neshan.org/v5/reverse?lat=$lat&lng=$lng");

        return response($neshan_response);
    }
}
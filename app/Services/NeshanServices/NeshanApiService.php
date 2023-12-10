<?php

namespace App\Services\NeshanServices;

use Illuminate\Support\Facades\Http;

class NeshanApiService {

    public function GetCoordsDistance($origin, $destination) {
        
        $NESHAN_SERVICES_API_KEY = config("services.neshan.api-key.services");

        $origin_lt = $origin['lt'];
        $origin_ln = $origin['ln'];

        $destination_lt = $destination['lt'];
        $destination_ln = $destination['ln'];

        $neshan_response = Http::withHeaders(["Api-Key" => $NESHAN_SERVICES_API_KEY])->get("https://api.neshan.org/v1/distance-matrix/no-traffic?type=car&origins=$origin_lt,$origin_ln&destinations=$destination_lt,$destination_ln");
        
        return response($neshan_response)->getContent();
    }

    public function GetNeshanArcMapImage($origin, $destination) {
        $NESHAN_SERVICES_API_KEY = config("services.neshan.api-key.services");

        $image_width = 500;
        $image_height = 500;

        $marker1Token = "401532.8upZaBbh";
        $marker2Token = "51535.QRbBXfZFT";

        $origin_lt = $origin['lt'];
        $origin_ln = $origin['ln'];

        $destination_lt = $destination['lt'];
        $destination_ln = $destination['ln'];

        $static_map_arc = Http::get("https://api.neshan.org/v4/static/arc?key=$NESHAN_SERVICES_API_KEY&type=neshan&from=$origin_ln,$origin_lt&to=$destination_ln,$destination_lt&width=$image_width&height=$image_height&dashed=true&color=%336699&marker1Token=$marker1Token&marker2Token=$marker2Token");

        $image = \Image::make($static_map_arc->body());
        $image->encode('png');
        $type = 'png';
        $image_arc_src = 'data:image/' . $type . ';base64,' . base64_encode($image);

        return $image_arc_src;
    }

}    
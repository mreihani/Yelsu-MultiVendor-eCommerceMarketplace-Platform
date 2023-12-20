<?php

namespace App\Http\Controllers\Backend\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Freightagetype;
use App\Http\Controllers\Controller;
use App\Models\Freightageloadertype;
use Stevebauman\Purify\Facades\Purify;
use App\Models\FreightageVendorInvitation;
use App\Services\Categories\GetCategoryByStringIds\GetCategoryByStringIds;

class VendorFreightageController extends Controller
{
    public function VendorAllFreightageVerified() {
        $vendorData = auth()->user();
        $invitations = FreightageVendorInvitation::with("freightage")->where('vendor_user_id', $vendorData->id)->where('verified',1)->latest()->get();

        return view('vendor.backend.freightage.freightage_invitation_verified_all', compact('vendorData', 'invitations'));
    }

    public function VendorAllFreightageNotVerified() {
        $vendorData = auth()->user();
        $invitations = FreightageVendorInvitation::with("freightage")->where('vendor_user_id', $vendorData->id)->where('verified',0)->latest()->get();

        return view('vendor.backend.freightage.freightage_invitation_not_verified_all', compact('vendorData', 'invitations'));
    }

    public function VendorEditFreightage(FreightageVendorInvitation $invitation) {
        $vendorData = auth()->user();
        
        if($invitation->vendor_user_id != $vendorData->id) {
            return redirect(route('vendor.all.freightage.verified'))->with('error', 'شما اجازه دسترسی ندارید.');
        }

        $freightage_type_array = [];
        foreach (explode(",", $invitation->freightage->freightage->type) as $freightage_type) {
            $freightage_type_array[] = Freightagetype::find($freightage_type)->value;
        }

        $freightage_loader_type_road_array = [];
        $freightage_loader_type = $invitation->freightage->freightage->freightage_loader_type;
        if($freightage_loader_type) {
            foreach (explode(",", $invitation->freightage->freightage->freightage_loader_type) as $road_loader_type_id) {
                $freightage_loader_type_road_array[] = Freightageloadertype::find($road_loader_type_id)->value;
            }
        }

        $freightage_loader_type_rail_array = [];
        $freightage_loader_type_rail = $invitation->freightage->freightage->freightage_loader_type_rail;
        if($freightage_loader_type_rail) {
            foreach (explode(",", $invitation->freightage->freightage->freightage_loader_type_rail) as $rail_loader_type_id) {
                $freightage_loader_type_rail_array[] = Freightageloadertype::find($rail_loader_type_id)->value;
            }
        }

        $freightage_loader_type_sea_array = [];
        $freightage_loader_type_sea = $invitation->freightage->freightage->freightage_loader_type_sea;
        if($freightage_loader_type_sea) {
            foreach (explode(",", $freightage_loader_type_sea) as $sea_loader_type_id) {
                $freightage_loader_type_sea_array[] = Freightageloadertype::find($sea_loader_type_id)->value;
            }
        }

        $freightage_loader_type_air_array = [];
        $freightage_loader_type_air = $invitation->freightage->freightage->freightage_loader_type_air;
        if($freightage_loader_type_air) {
            foreach (explode(",", $invitation->freightage->freightage->freightage_loader_type_air) as $air_loader_type_id) {
                $freightage_loader_type_air_array[] = Freightageloadertype::find($air_loader_type_id)->value;
            }
        }
      

        $freightage_category_id = GetCategoryByStringIds::getCategoryByIds($invitation->freightage->freightage->category_id);

        return view('vendor.backend.freightage.freightage_invitation_detail', 
        compact(
        'vendorData', 
        'invitation', 
        'freightage_type_array',
        'freightage_loader_type_road_array',
        'freightage_loader_type_rail_array',
        'freightage_loader_type_sea_array',
        'freightage_loader_type_air_array',
        'freightage_category_id'
        ));
    }

    public function VendorUpdateFreightage(Request $request) {
        $invitation_id = Purify::clean($request->id);

        $vendorData = auth()->user();
        $user_id = $vendorData->id;

        $invitation = FreightageVendorInvitation::findOrFail($invitation_id);

        if($invitation->vendor_user_id != $user_id) {
            return redirect(route('vendor.all.freightage.verified'))->with('error', 'شما اجازه دسترسی ندارید.');
        }

        $freightageVendorInvitation = $invitation->update([
            'verified' => true,
        ]);

        return redirect(route('vendor.all.freightage.verified'))->with('success', 'شرکت باربری تأیید شد.');
    }
}

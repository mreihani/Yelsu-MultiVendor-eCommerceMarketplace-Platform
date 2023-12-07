<?php

namespace App\Http\Controllers\Backend\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;
use App\Models\FreightageVendorInvitation;
use App\Services\Categories\GetCategoryByStringIds\GetCategoryByStringIds;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeAirService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeSeaService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRailService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRoadService;

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

        $freightage_type_array = FreightageTypeService::getFreightageTypeValuesByIds($invitation->freightage->freightage->type);
        $freightage_loader_type_road_array = FreightageTypeRoadService::getFreightageTypeValuesByIds($invitation->freightage->freightage->freightage_loader_type_sea);
        $freightage_loader_type_rail_array = FreightageTypeRailService::getFreightageTypeValuesByIds($invitation->freightage->freightage->freightage_loader_type_sea);
        $freightage_loader_type_sea_array = FreightageTypeSeaService::getFreightageTypeValuesByIds($invitation->freightage->freightage->freightage_loader_type_sea);
        $freightage_loader_type_air_array = FreightageTypeAirService::getFreightageTypeValuesByIds($invitation->freightage->freightage->freightage_loader_type_sea);
       
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

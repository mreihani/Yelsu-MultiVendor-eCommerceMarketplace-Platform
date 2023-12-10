<?php

namespace App\Http\Controllers\Backend\Freightage;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;
use App\Models\FreightageVendorInvitation;

class FreightageToVendorInvitationController extends Controller
{
    public function FreightageAllVendorRequest() {
        $freightageData = auth()->user();
        $id = $freightageData->id;
        $all_invitations = FreightageVendorInvitation::with('vendor')->where('freightage_user_id', $id)->latest()->get();

        return view('freightage.backend.vendor.freightrage_to_vendor_request_all', 
        compact('freightageData','all_invitations'));
    }

    public function FreightageAddVendorRequest() {
        $freightageData = auth()->user();
        $id = $freightageData->id;

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

        return view('freightage.backend.vendor.freightrage_to_vendor_request_add', 
        compact('freightageData','vendorsName'));
    }

    public function FreightageStoreVendorRequest(Request $request) {

        $incomingFields = $request->validate([
            'vendor_id' => ['required', Rule::unique('freightage_vendor_invitations', 'vendor_user_id')->where('freightage_user_id', auth()->user()->id)],
        ], [
            'vendor_id.required' => 'لطفا تأمین کننده مورد نظر را انتخاب نمایید.',
            'vendor_id.unique' => 'درخواست دیگری برای تأمین کننده مورد نظر قبلا ارسال شده است.',
        ]);

        $freightageVendorInvitation = FreightageVendorInvitation::create([
            'freightage_user_id' => auth()->user()->id,
            'vendor_user_id' => Purify::clean($incomingFields['vendor_id']),
            'description' => Purify::clean($request->description) ?: NULL,
        ]);

        return redirect(route('freightage.all.vendor-request'))->with('success', 'درخواست شما با موفقیت ارسال گردید.');
    }

    public function FreightageEditVendorRequest(FreightageVendorInvitation $invitation) {

        $freightageData = auth()->user();
        $id = $freightageData->id;

        if($invitation->freightage_user_id != $id) {
            return redirect(route('freightage.all.vendor-request'))->with('error', 'شما اجازه دسترسی ندارید.');
        }

        $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

        return view('freightage.backend.vendor.freightrage_to_vendor_request_edit', 
        compact('freightageData','vendorsName', 'invitation'));
    }

    public function FreightageUpdateVendorRequest(Request $request) {

        $invitation_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'vendor_id' => ['required', Rule::unique('freightage_vendor_invitations', 'vendor_user_id')->where('freightage_user_id', auth()->user()->id)->ignore($invitation_id)],
        ], [
            'vendor_id.required' => 'لطفا تأمین کننده مورد نظر را انتخاب نمایید.',
            'vendor_id.unique' => 'درخواست دیگری برای تأمین کننده مورد نظر قبلا ارسال شده است.',
        ]);

        $freightageData = auth()->user();
        $user_id = $freightageData->id;

        $invitation = FreightageVendorInvitation::findOrFail($invitation_id);

        if($invitation->freightage_user_id != $user_id) {
            return redirect(route('freightage.all.vendor-request'))->with('error', 'شما اجازه دسترسی ندارید.');
        }

        if($invitation->verified) {
            return redirect(route('freightage.all.vendor-request'))->with('error', 'درخواست شما مورد توسط تأمین کننده تأیید شده و امکان ویرایش آن وجود ندارد.');
        }

        $freightageVendorInvitation = $invitation->update([
            'freightage_user_id' => auth()->user()->id,
            'vendor_user_id' => Purify::clean($incomingFields['vendor_id']),
            'description' => Purify::clean($request->description) ?: NULL,
        ]);

        return redirect(route('freightage.all.vendor-request'))->with('success', 'درخواست شما با موفقیت بروز رسانی گردید.');

    }

    public function FreightageDeleteVendorRequest(FreightageVendorInvitation $invitation) {

        $freightageData = auth()->user();
        $user_id = $freightageData->id;
       
        if($invitation->freightage_user_id != $user_id) {
            return redirect(route('freightage.all.vendor-request'))->with('error', 'شما اجازه دسترسی ندارید.');
        }

        if($invitation->verified) {
            return redirect(route('freightage.all.vendor-request'))->with('error', 'درخواست شما مورد توسط تأمین کننده تأیید شده و امکان حذف آن وجود ندارد.');
        }

        $invitation->delete();

        return redirect(route('freightage.all.vendor-request'))->with('success', 'درخواست شما با موفقیت حذف گردید.');
    }
}

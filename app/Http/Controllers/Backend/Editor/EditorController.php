<?php

namespace App\Http\Controllers\Backend\Editor;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\File as LaravelFile;

use App\Http\Controllers\Controller;

class EditorController extends Controller
{
    public function EditorDashboard()
    {
        $id = Auth::user()->id;
        $editorData = User::find($id);

        return view('editor.index', compact('editorData'));
    } //End method

    public function EditorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    } //End method

    public function EditorProfile()
    {
        $id = Auth::user()->id;
        $editorData = User::find(Purify::clean($id));
        return view('editor.editor_profile_view', compact('editorData'));
    } //End method

    public function EditorProfileSettings()
    {
        $id = Auth::user()->id;
        $editorData = User::find(Purify::clean($id));
        return view('editor.editor_profile_settings', compact('editorData'));
    } //End method

    public function EditorProfileStore(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ], [
            'firstname.required' => 'لطفا نام خود را وارد نمایید.',
            'lastname.required' => 'لطفا نام خانوادگی خود را وارد نمایید.',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        if (Purify::clean($incomingFields['firstname'])) {
            $data->firstname = Purify::clean($incomingFields['firstname']);
        }

        if (Purify::clean($incomingFields['lastname'])) {
            $data->lastname = Purify::clean($incomingFields['lastname']);
        }

        if (Purify::clean($request->photo)) {
            $file = Purify::clean($request->photo);

            if ($data->photo != NULL) {
                unlink('storage/upload/editor_images/' . $data->photo);
            }

            $unique_image_name = hexdec(uniqid());
            $filename = $unique_image_name . '.' . 'jpg';

            Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/editor_images/' . $filename);

            $data['photo'] = $filename;
        }

        $data->save();
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

    } //End method

    public function EditorUpdatePassword(Request $request)
    {

        //Validation
        $incomingFields = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8|max:20',
        ], [
            'old_password.required' => 'لطفا کلمه عبور فعلی خود را وارد نمایید.',
            'new_password.required' => 'لطفا کلمه عبور جدید را وارد نمایید.',
            'new_password.confirmed' => 'لطفا تکرار کلمه عبور جدید را به درستی وارد نمایید.',
            'new_password.min' => 'کلمه عبور جدید باید حداقل 8 کاراکتر باشد.',
            'new_password.max' => 'کلمه عبور جدید باید حداکثر 20 کاراکتر باشد.',
        ]);

        //Match the old password
        if (! Hash::check(($incomingFields['old_password']), Auth::user()->password)) {
            return back()->with('error', 'لطفا کلمه عبور فعلی خود را به درستی وارد نمایید.');
        }

        //Update the now password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(($incomingFields['new_password']))
        ]);
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    } //End method

    /**************************************
    Start of Media Section 
    **************************************/

    public function EditorMediaFiles()
    {

        $id = Auth::user()->id;
        $editorData = User::find($id);

        $files = File::latest()->get();

        return view('editor.media.files', compact('editorData', 'files'));
    }

    public function EditorMediaAddFiles()
    {
        $id = Auth::user()->id;
        $editorData = User::find($id);

        return view('editor.media.add', compact('editorData'));
    }

    public function EditorMediaStoreFiles(Request $request)
    {

        $id = Auth::user()->id;
        $editorData = User::find($id);

        $incomingFields = $request->validate([
            'file_upload' => ['required', 'image', 'max:5000'],
        ], [
            'file_upload.required' => 'لطفا تصویر را بارگذاری نمایید.',
            'file_upload.image' => 'لطفا فایل JPG یا PNG بارگذاری نمایید.',
            'file_upload.max' => 'حداکثر حجم قابل بارگذاری 4 مگابایت است.',
        ]);

        if (! LaravelFile::exists('storage/upload/media_files/' . $id)) {
            LaravelFile::makeDirectory('storage/upload/media_files/' . $id);
        }

        $actualfileName = Purify::clean($incomingFields['file_upload']->getClientOriginalName());
        $fileSize = Purify::clean($incomingFields['file_upload']->getSize());

        $image = Purify::clean($incomingFields['file_upload']);
        $name_gen = hexdec(uniqid()) . '.' . 'jpg';

        Image::make($image)->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg')->save('storage/upload/media_files/' . $id . '/' . $name_gen);
        $save_url = 'storage/upload/media_files/' . $id . '/' . $name_gen;


        File::insert([
            'fileName' => $save_url,
            'user_id' => $id,
            'actualfileName' => $actualfileName,
            'fileSize' => $fileSize / 1000,
        ]);

        return redirect(route('editor.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
    }

    public function EditorDeleteFile($id)
    {
        $user_id = Auth::user()->id;
        $file = File::findOrFail(Purify::clean($id));
        $img = $file->fileName;

        if ($file->user_id == $user_id) {
            unlink($img);
            File::findOrFail($id)->delete();
        } else {
            return redirect(route('editor.media.files'))->with('error', 'شما اجازه حذف این فایل را ندارید!');
        }

        return redirect(route('editor.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
    }

    /**************************************
    End of Media Section 
    **************************************/

}
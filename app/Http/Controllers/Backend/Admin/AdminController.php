<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\File;
use App\Models\User;
use App\Models\Driver;
use App\Models\Product;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Freightage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File as LaravelFile;
use App\Services\Users\Driver\DriverTypeServices\DriverTypeService;
use App\Services\Users\Driver\DriverTypeServices\DriverTypeRoadService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeAirService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeSeaService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRailService;
use App\Services\Users\Freightage\FreightageTypeServices\FreightageTypeRoadService;


class AdminController extends Controller
{
   public function AdminDashboard()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      return view('admin.index', compact('adminData'));
   } //End method

   public function AdminLogin()
   {
      return view('admin.admin_login');
   } //End method

   public function AdminDestroy(Request $request)
   {
      Auth::guard('web')->logout();
      
      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
   } //End method

   public function AdminProfile()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      return view('admin.admin_profile_view', compact('adminData'));
   } //End method

   public function AdminProfileSettings()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      return view('admin.admin_profile_settings', compact('adminData'));
   } //End method

   public function AdminProfileStore(Request $request)
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

      if ($incomingFields['firstname']) {
         $data->firstname = Purify::clean($incomingFields['firstname']);
      }

      if ($incomingFields['lastname']) {
         $data->lastname = Purify::clean($incomingFields['lastname']);
      }


      if (Purify::clean($request->photo)) {
         $file = Purify::clean($request->photo);

         if ($data->photo != NULL) {
            unlink('storage/upload/admin_images/' . $data->photo);
         }

         $unique_image_name = hexdec(uniqid());
         $filename = $unique_image_name . '.' . 'jpg';

         Image::make($file)->fit(160)->encode('jpg')->save('storage/upload/admin_images/' . $filename);

         $data['photo'] = $filename;
      }

      $data->save();
      return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');

   } //End method

   public function AdminUpdatePassword(Request $request)
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

   public function AdminVendorStatus()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $VendorStatus = User::where('role', 'vendor')->latest()->paginate(10);

      return view('admin.backend.users.vendor.activate_account.vendor_status', compact('VendorStatus', 'adminData'));
   } //End method

   public function AdminVendorStatusSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $VendorStatus = User::search($query_string)->where('role','vendor')->paginate(10);  

      return view('admin.backend.users.vendor.activate_account.vendor_status', compact('VendorStatus', 'adminData'));
   } //End method

   public function AdminVendorStatusChange(Request $request)
   {
      $vendor_id = Purify::clean($request->vendor_id);
      $data = User::find($vendor_id);

      if ($data['status'] === "inactive") {
         $data['status'] = "active";
      } else {
         $data['status'] = "inactive";
      }

      $data->save();
      return redirect()->back()->with('success', 'وضعیت فروشنده با موفقیت تغییر داده شد.');
   } //End method

   public function AdminVendorStatusView($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $data = User::find(Purify::clean($id));


      $vendor_sector_arr = explode(",", $data->vendor_sector);
      $vendor_sector_cat_arr = [];
      foreach ($vendor_sector_arr as $vendor_sector_item) {
         $vendor_sector_cat_arr[] = Category::find($vendor_sector_item);
      }

      return view('admin.backend.users.vendor.activate_account.vendor_status_view', compact('data', 'adminData', 'vendor_sector_cat_arr'));
   } //End method

   public function AdminMerchantStatus()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $MerchantStatus = User::where('role', 'merchant')->latest()->paginate(10);

      return view('admin.backend.users.merchant.activate_account.merchant_status', compact('MerchantStatus', 'adminData'));
   } //End method

   public function AdminMerchantStatusSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $MerchantStatus = User::search($query_string)->where('role','merchant')->paginate(10);

      return view('admin.backend.users.merchant.activate_account.merchant_status', compact('MerchantStatus', 'adminData'));
   } //End method

   public function AdminMerchantStatusChange(Request $request)
   {
      $merchant_id = Purify::clean($request->merchant_id);
      $data = User::find($merchant_id);

      if ($data['status'] === "inactive") {
         $data['status'] = "active";
      } else {
         $data['status'] = "inactive";
      }

      $data->save();
      return redirect()->back()->with('success', 'وضعیت بازرگان با موفقیت تغییر داده شد.');
   } //End method

   public function AdminMerchantStatusView($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $data = User::find(Purify::clean($id));


      return view('admin.backend.users.merchant.activate_account.merchant_status_view', compact('data', 'adminData'));
   } //End method

   public function AdminRetailerStatus()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $RetailerStatus = User::where('role', 'retailer')->latest()->paginate(10);

      return view('admin.backend.users.retailer.activate_account.retailer_status', compact('RetailerStatus', 'adminData'));
   } //End method

   public function AdminRetailerStatusSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $query_string = Purify::clean($request['query']);

      $RetailerStatus = User::search($query_string)->where('role','retailer')->paginate(10);

      return view('admin.backend.users.retailer.activate_account.retailer_status', compact('RetailerStatus', 'adminData'));
   } //End method

   public function AdminRetailerStatusChange(Request $request)
   {
      $retailer_id = Purify::clean($request->retailer_id);
      $data = User::find($retailer_id);

      if ($data['status'] === "inactive") {
         $data['status'] = "active";
      } else {
         $data['status'] = "inactive";
      }

      $data->save();
      return redirect()->back()->with('success', 'وضعیت فروشنده با موفقیت تغییر داده شد.');
   } //End method

   public function AdminRetailerStatusView($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $data = User::find(Purify::clean($id));


      return view('admin.backend.users.retailer.activate_account.retailer_status_view', compact('data', 'adminData'));
   } //End method

   public function AdminFreightageStatus()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $FreightageStatus = User::where('role', 'freightage')->latest()->paginate(10);

      return view('admin.backend.users.freightage.activate_account.freightage_status', compact('FreightageStatus', 'adminData'));
   } //End method

   public function AdminFreightageStatusSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $FreightageStatus = User::search($query_string)->where('role','freightage')->paginate(10);

      return view('admin.backend.users.freightage.activate_account.freightage_status', compact('FreightageStatus', 'adminData'));
   } //End method

   public function AdminFreightageStatusChange(Request $request)
   {
      $freightage_id = Purify::clean($request->freightage_id);
      $data = User::find($freightage_id);

      if ($data['status'] === "inactive") {
         $data['status'] = "active";
      } else {
         $data['status'] = "inactive";
      }

      $data->save();
      return redirect()->back()->with('success', 'وضعیت باربری با موفقیت تغییر داده شد.');
   } //End method

   public function AdminFreightageStatusView($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $data = User::find(Purify::clean($id));

      $freightage_sector_arr = explode(",", $data->freightage->type_temp);

      return view('admin.backend.users.freightage.activate_account.freightage_status_view', compact('data', 'adminData', 'freightage_sector_arr'));
   } //End method


   public function AdminDriverStatus()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $DriverStatus = User::where('role', 'driver')->latest()->paginate(10);

      return view('admin.backend.users.driver.activate_account.driver_status', compact('DriverStatus', 'adminData'));
   } //End method

   public function AdminDriverStatusSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $DriverStatus = User::search($query_string)->where('role','driver')->paginate(10);

      return view('admin.backend.users.driver.activate_account.driver_status', compact('DriverStatus', 'adminData'));
   } //End method

   public function AdminDriverStatusChange(Request $request)
   {
      $driver_id = Purify::clean($request->driver_id);
      $data = User::find($driver_id);

      if ($data['status'] === "inactive") {
         $data['status'] = "active";
      } else {
         $data['status'] = "inactive";
      }

      $data->save();
      return redirect()->back()->with('success', 'وضعیت باربری با موفقیت تغییر داده شد.');
   } //End method

   public function AdminDriverStatusView($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $data = User::find(Purify::clean($id));

      $driver_sector_arr = explode(",", $data->driver->type_temp);

      return view('admin.backend.users.driver.activate_account.driver_status_view', compact('data', 'adminData', 'driver_sector_arr'));
   } //End method

   public function AdminUsersView()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $categories = Category::where('parent', 0)->latest()->get()->reverse();

      //$users = User::orderBy('firstname', 'ASC')->get();
      $users = User::orderBy('firstname', 'ASC')->paginate(10);
      return view('admin.backend.users.user.users_all', compact('adminData', 'users', 'categories'));
   } //End method

   public function AdminUsersViewSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $categories = Category::where('parent', 0)->latest()->get()->reverse();
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->paginate(10);

      return view('admin.backend.users.user.users_all', compact('adminData', 'users', 'categories'));
   } //End method

   public function AdminUsersAdd()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $categories = Category::where('parent', 0)->latest()->get()->reverse();

      $users = User::orderBy('firstname', 'ASC')->get();
      return view('admin.backend.users.user.users_add', compact('adminData', 'users', 'categories'));
   } //End method

   public function AdminUserStore(Request $request)
   {
      $incomingFields = $request->validate([
         'firstname' => ['required', 'string', 'max:255'],
         'lastname' => ['required', 'string', 'max:255'],
         'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/', 'min:5', 'max:255', 'unique:' . User::class],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
         'password' => 'required|min:8|max:20',
      ], [
         'firstname.required' => 'لطفا نام کاربر را وارد نمایید.',
         'lastname.required' => 'لطفا نام خانوادگی کاربر را وارد نمایید.',
         'username.required' => 'لطفا نام کاربری را وارد نمایید.',
         'username.unique' => 'نام کاربری مورد نظر قبلا در سامانه ثبت شده است. لطفا نام کاربری دیگری انتخاب نمایید.',
         'username.min' => 'نام کاربری حداقل 5 کاراکتر باید باشد.',
         'username.regex' => 'نام کاربری فقط باید شامل حروف و اعداد انگلیسی باشد. !@#)($%^&-* و فاصله غیر مجاز است.',
         'email.required' => 'لطفا ایمیل کاربر را وارد نمایید.',
         'email.unique' => 'ایمیل مورد نظر قبلا در سامانه ثبت شده است. لطفا ایمیل دیگری انتخاب نمایید.',
         'email.email' => 'لطفا آدرس ایمیل صحیح وارد نمایید.',
         'password.required' => 'لطفا کلمه عبور کاربر را وارد نمایید.',
         'password.min' => 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
         'password.max' => 'کلمه عبور باید حداکثر 20 کاراکتر باشد.',
      ]);

      if (Purify::clean($request->role) == 'specialist' && Purify::clean($request->specialist_category_id) == 0) {
         return back()->with('error', 'لطفا یک دسته بندی برای کاربر کارشناس انتخاب نمایید.')->withInput();
      }

      if (Purify::clean($request->username) == trim(Purify::clean($request->username)) && str_contains(Purify::clean($request->username), ' ')) {
         return back()->with('error', 'لطفا نام کاربری خود را بدون کاراکتر فاصله در میان دو کلمه وارد نمایید. می توانید به جای فاصله از _ بین دو کلمه استفاده کنید.')->withInput();
      }

      if (Purify::clean($request->role) != 'specialist') {
         $specialist_category_id = NULL;
      } else {
         $specialist_category_id = Purify::clean($request->specialist_category_id);
      }

      $vendor_sector = Category::where('parent', 0)->get()->pluck('id')->join(", ");

      if ($request->role == "vendor") {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'inactive',
            'specialist_category_id' => $specialist_category_id,
            'vendor_sector' => $vendor_sector,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

      } elseif ($request->role == 'merchant') {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'inactive',
            'specialist_category_id' => $specialist_category_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

         Merchant::create([
            'user_id' => $user->id,
         ]);

      } elseif ($request->role == 'retailer') {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'inactive',
            'specialist_category_id' => $specialist_category_id,
            'vendor_sector' => $vendor_sector,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

         Merchant::create([
            'user_id' => $user->id,
         ]);

      } elseif ($request->role == 'freightage') {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'inactive',
            'specialist_category_id' => $specialist_category_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

         Freightage::create([
            'user_id' => $user->id,
            'category_id' => $vendor_sector,
            'category_id_temp' => $vendor_sector,
         ]);

      } elseif ($request->role == 'driver') {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'inactive',
            'specialist_category_id' => $specialist_category_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

         Driver::create([
            'user_id' => $user->id,
            'category_id' => $vendor_sector,
            'category_id_temp' => $vendor_sector,
         ]);

      } else {

         $user = User::create([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'status' => 'active',
            'specialist_category_id' => $specialist_category_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

      }

      $user->searchable();
      
      return redirect(route('admin.users'))->with('success', 'حساب کاربری با موفقیت ایجاد گردید.');
   } //End method

   public function AdminEditUser($id)
   {
      $adminData = User::find(Auth::user()->id);
      $user = User::find(Purify::clean($id));
      $categories = Category::where('parent', 0)->latest()->get()->reverse();

      return view('admin.backend.users.user.users_edit', compact('adminData', 'user', 'categories'));
   } //End method

   public function AdminUpdateUser(Request $request)
   {
      $user_id = Purify::clean($request->user_id);

      $incomingFields = $request->validate([
         'firstname' => ['required', 'string', 'max:255'],
         'lastname' => ['required', 'string', 'max:255'],
         'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/', 'min:5', 'max:255', Rule::unique('users', 'username')->ignore($user_id)],
         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user_id)],
         'password' => 'required|min:8|max:20',
      ], [
         'firstname.required' => 'لطفا نام کاربر را وارد نمایید.',
         'lastname.required' => 'لطفا نام خانوادگی کاربر را وارد نمایید.',
         'username.required' => 'لطفا نام کاربری را وارد نمایید.',
         'username.unique' => 'نام کاربری مورد نظر قبلا در سامانه ثبت شده است. لطفا نام کاربری دیگری انتخاب نمایید.',
         'username.min' => 'نام کاربری حداقل 5 کاراکتر باید باشد.',
         'username.regex' => 'نام کاربری فقط باید شامل حروف و اعداد انگلیسی باشد. !@#)($%^&-* و فاصله غیر مجاز است.',
         'email.required' => 'لطفا ایمیل کاربر را وارد نمایید.',
         'email.unique' => 'ایمیل مورد نظر قبلا در سامانه ثبت شده است. لطفا ایمیل دیگری انتخاب نمایید.',
         'email.email' => 'لطفا آدرس ایمیل صحیح وارد نمایید.',
         'password.required' => 'لطفا کلمه عبور کاربر را وارد نمایید.',
         'password.min' => 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
         'password.max' => 'کلمه عبور باید حداکثر 20 کاراکتر باشد.',
      ]);

      if (Purify::clean($request->role) == 'specialist' && Purify::clean($request->specialist_category_id) == 0) {
         return back()->with('error', 'لطفا یک دسته بندی برای کاربر کارشناس انتخاب نمایید.')->withInput();
      }

      if ($request->role != 'specialist') {
         $specialist_category_id = NULL;
      } else {
         $specialist_category_id = $request->specialist_category_id;
      }

      //Update the new info
      if ($incomingFields['password'] != 'password') {
         User::findOrFail($user_id)->update([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'password' => Hash::make(($incomingFields['password'])),
            'role' => Purify::clean($request->role),
            'specialist_category_id' => $specialist_category_id,
         ]);
      } else {
         User::findOrFail($user_id)->update([
            'firstname' => Purify::clean($incomingFields['firstname']),
            'lastname' => Purify::clean($incomingFields['lastname']),
            'username' => Purify::clean($incomingFields['username']),
            'email' => Purify::clean($incomingFields['email']),
            'role' => Purify::clean($request->role),
            'specialist_category_id' => $specialist_category_id,
         ]);
      }

      return redirect(route('admin.users'))->with('success', 'حساب کاربری با موفقیت به روز رسانی گردید.');
   } //End method

   public function AdminDeleteUser($id)
   {
      User::findOrFail(Purify::clean($id))->delete();

      return redirect(route('admin.users'))->with('success', 'حساب کاربری با موفقیت به حذف گردید.');
   } //End method

   // media functions begin
   public function AdminMediaFiles()
   {

      $id = Auth::user()->id;
      $adminData = User::find($id);

      $files = File::latest()->get();

      return view('admin.media.files', compact('adminData', 'files'));
   }

   public function AdminMediaAddFiles()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      return view('admin.media.add', compact('adminData'));
   }

   public function AdminMediaStoreFiles(Request $request)
   {

      $id = Auth::user()->id;
      $adminData = User::find($id);

      $incomingFields = $request->validate([
         'file_upload' => 'required',
      ], [
         'file_upload.required' => 'لطفا تصویر را بارگذاری نمایید.',
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

      return redirect(route('admin.media.files'))->with('success', 'فایل مورد نظر با موفقیت بارگذاری گردید.');
   }

   public function AdminDeleteFile($id)
   {
      $file = File::findOrFail(Purify::clean($id));
      $img = $file->fileName;

      unlink($img);

      File::findOrFail($id)->delete();

      return redirect(route('admin.media.files'))->with('success', 'فایل مورد نظر با موفقیت حذف گردید.');
   }
   // media functions ends

   public function AdminVendorProductVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $products = Product::where('product_verification', 'inactive')->whereNot('vendor_id', NULL)->latest()->get();

      return view('admin.backend.product.product_verify.vendor_product_verify_all', compact('adminData', 'products'));
   }

   public function AdminMerchantProductVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $products = Product::where('product_verification', 'inactive')->whereNot('merchant_id', NULL)->latest()->get();

      return view('admin.backend.product.product_verify.merchant_product_verify_all', compact('adminData', 'products'));
   }

   public function AdminRetailerProductVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $products = Product::where('product_verification', 'inactive')->whereNot('retailer_id', NULL)->latest()->get();

      return view('admin.backend.product.product_verify.retailer_product_verify_all', compact('adminData', 'products'));
   }

   public function AdminVendorAboutVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $users = User::where('role', 'vendor')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

      return view('admin.backend.users.vendor.verify_about.vendor_about_status', compact('adminData', 'users'));
   }

   public function AdminVendorAboutVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->where('role','vendor')->where('status','active')->where('vendor_description_status','inactive')->paginate(10);

      return view('admin.backend.users.vendor.verify_about.vendor_about_status', compact('adminData', 'users'));
   }

   public function AdminVendorAboutVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $vendorData = User::find((int) Purify::clean($id));

      return view('admin.backend.users.vendor.verify_about.about_vendor', compact('adminData', 'id', 'vendorData'));
   }

   public function AdminVendorAboutVerifyStore(Request $request)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $id = Purify::clean($request->id);
      $data = User::find((int) $id);

      $incomingFields = $request->validate([
         'vendor_description' => 'required',
      ], [
         'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
      ]);


      $data->vendor_description = ($incomingFields['vendor_description']);
      $data->vendor_description_status = 'active';
      $data->save();

      return redirect()->route('admin.vendor.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminMerchantAboutVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $users = User::where('role', 'merchant')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

      return view('admin.backend.users.merchant.verify_about.merchant_about_status', compact('adminData', 'users'));
   }
   public function AdminMerchantAboutVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->where('role','merchant')->where('status','active')->where('vendor_description_status','inactive')->paginate(10);

      return view('admin.backend.users.merchant.verify_about.merchant_about_status', compact('adminData', 'users'));
   }

   public function AdminMerchantAboutVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $merchantData = User::find((int) Purify::clean($id));

      return view('admin.backend.users.merchant.verify_about.about_merchant', compact('adminData', 'id', 'merchantData'));
   }

   public function AdminMerchantAboutVerifyStore(Request $request)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $id = Purify::clean($request->id);
      $data = User::find((int) $id);

      $incomingFields = $request->validate([
         'vendor_description' => 'required',
      ], [
         'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
      ]);


      $data->vendor_description = ($incomingFields['vendor_description']);
      $data->vendor_description_status = 'active';
      $data->save();

      return redirect()->route('admin.merchant.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminRetailerAboutVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $users = User::where('role', 'retailer')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

      return view('admin.backend.users.retailer.verify_about.retailer_about_status', compact('adminData', 'users'));
   }
   public function AdminRetailerAboutVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->where('role','retailer')->where('status','active')->where('vendor_description_status','inactive')->paginate(10);

      return view('admin.backend.users.retailer.verify_about.retailer_about_status', compact('adminData', 'users'));
   }

   public function AdminRetailerAboutVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $retailerData = User::find((int) Purify::clean($id));

      return view('admin.backend.users.retailer.verify_about.about_retailer', compact('adminData', 'id', 'retailerData'));
   }

   public function AdminRetailerAboutVerifyStore(Request $request)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $id = Purify::clean($request->id);
      $data = User::find((int) $id);

      $incomingFields = $request->validate([
         'vendor_description' => 'required',
      ], [
         'vendor_description.required' => 'لطفا توضیحات فروشگاه را وارد نمایید.',
      ]);


      $data->vendor_description = ($incomingFields['vendor_description']);
      $data->vendor_description_status = 'active';
      $data->save();

      return redirect()->route('admin.retailer.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminFreightageAboutVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $users = User::where('role', 'freightage')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

      return view('admin.backend.users.freightage.verify_about.freightage_about_status', compact('adminData', 'users'));
   }
   public function AdminFreightageAboutVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->where('role','freightage')->where('status','active')->where('vendor_description_status','inactive')->paginate(10);
      
      return view('admin.backend.users.freightage.verify_about.freightage_about_status', compact('adminData', 'users'));
   }

   public function AdminFreightageAboutVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $freightageData = User::find((int) Purify::clean($id));

      return view('admin.backend.users.freightage.verify_about.about_freightage', compact('adminData', 'id', 'freightageData'));
   }

   public function AdminFreightageAboutVerifyStore(Request $request)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $id = Purify::clean($request->id);
      $data = User::find((int) $id);

      $incomingFields = $request->validate([
         'vendor_description' => 'required',
      ], [
         'vendor_description.required' => 'لطفا توضیحات شرکت باربری را وارد نمایید.',
      ]);


      $data->vendor_description = ($incomingFields['vendor_description']);
      $data->vendor_description_status = 'active';
      $data->save();

      return redirect()->route('admin.freightage.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminFreightageProfileVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $freightages_id = Freightage::where('status', "inactive")->pluck('user_id')->toArray();
      $users = User::whereIn('id', $freightages_id)->paginate(10);

      return view('admin.backend.users.freightage.profile_field_of_activity.freightage_activity_status', compact('adminData', 'users'));
   }

   public function AdminFreightageProfileVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $freightages_id = Freightage::where('status', "inactive")->pluck('user_id')->toArray();
      $users = User::search($query_string)->whereIn('id', $freightages_id)->paginate(10);

      return view('admin.backend.users.freightage.profile_field_of_activity.freightage_activity_status', compact('adminData', 'users'));
   }

   public function AdminFreightageProfileVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $freightageData = User::find((int) Purify::clean($id));

      $freightage_sector_arr = explode(",", $freightageData->freightage->type_temp);

      // category for filter
      $vendor_sector_cat_arr = Category::where('parent', 0)->get();

      $filter_category_array = [];
      foreach ($vendor_sector_cat_arr as $parentCategory) {
         $all_children = Category::find($parentCategory->id)->child;
         $filter_category_array[] = array($parentCategory, $all_children);
      }
      // category for filter

      $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

      $category_sector_cat_arr_selected = explode(',', $freightageData->freightage->category_id_temp);
      $vendor_arr_selected = explode(',', $freightageData->freightage->vendor_id_temp);

      $loader_type_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_temp);

      $loader_type_rail_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_rail_temp);
      $loader_type_sea_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_sea_temp);
      $loader_type_air_arr_selected = explode(',', $freightageData->freightage->freightage_loader_type_air_temp);

      $freightageTypeArray = FreightageTypeService::getFreightageTypeArray();
      $freightageLoaderTypeRoadArray = FreightageTypeRoadService::getFreightageLoaderTypeRoadArray();
      $freightageLoaderTypeRailArray = FreightageTypeRailService::getFreightageLoaderTypeRailArray();
      $freightageLoaderTypeSeaArray = FreightageTypeSeaService::getFreightageLoaderTypeSeaArray();
      $freightageLoaderTypeAirArray = FreightageTypeAirService::getFreightageLoaderTypeAirArray();

      return view('admin.backend.users.freightage.profile_field_of_activity.activity_freightage', compact('adminData', 'id', 'freightageData', 'freightage_sector_arr', 'vendor_sector_cat_arr', 'filter_category_array', 'vendorsName', 'category_sector_cat_arr_selected', 'vendor_arr_selected', 'loader_type_arr_selected', 'loader_type_rail_arr_selected', 'loader_type_sea_arr_selected', 'loader_type_air_arr_selected', 'freightageTypeArray', 'freightageLoaderTypeRoadArray', 'freightageLoaderTypeRailArray', 'freightageLoaderTypeSeaArray', 'freightageLoaderTypeAirArray'));
   }

   public function AdminFreightageProfileVerifyStore(Request $request)
   {
      $incomingFields = $request->validate([
         'type' => 'required',
         'category_id' => 'required',
      ], [
         'type.required' => 'لطفا زمینه فعالیت باربری را انتخاب نمایید.',
         'category_id.required' => 'لطفا حداقل یک دسته بندی مرتبط با باربری را انتخاب نمایید.',
      ]);

      // زمینه فعالیت زمینی
      if (in_array(1, $incomingFields['type'])) {
         if ($request->loader_type == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا نوع بارگیر در حمل جاده ای را مشخص نمایید.');
         }
      }

      // زمینه فعالیت ریلی
      if (in_array(6, $incomingFields['type'])) {
         if ($request->loader_type_rail == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا نوع بارگیر در حمل ریلی را مشخص نمایید.');
         }
      }

      // زمینه فعالیت آبی
      if (in_array(8, $incomingFields['type'])) {
         if ($request->loader_type_sea == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا نوع بارگیر در حمل آبی را مشخص نمایید.');
         }
      }

      // زمینه فعالیت هوایی
      if (in_array(7, $incomingFields['type'])) {
         if ($request->loader_type_air == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا نوع بارگیر در حمل هوایی را مشخص نمایید.');
         }
      }

      $data = User::find(Purify::clean($request->id));

      $data->freightage->type = implode(',', Purify::clean($incomingFields['type']));
      $data->freightage->category_id = implode(',', Purify::clean($incomingFields['category_id']));
      $data->freightage->vendor_id = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
      $data->freightage->freightage_loader_type = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;
      $data->freightage->freightage_loader_type_rail = $request->loader_type_rail ? implode(',', Purify::clean($request->loader_type_rail)) : NULL;
      $data->freightage->freightage_loader_type_sea = $request->loader_type_sea ? implode(',', Purify::clean($request->loader_type_sea)) : NULL;
      $data->freightage->freightage_loader_type_air = $request->loader_type_air ? implode(',', Purify::clean($request->loader_type_air)) : NULL;

      $data->freightage->type_temp = implode(',', Purify::clean($incomingFields['type']));
      $data->freightage->category_id_temp = implode(',', Purify::clean($incomingFields['category_id']));
      $data->freightage->vendor_id_temp = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
      $data->freightage->freightage_loader_type_temp = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;
      $data->freightage->freightage_loader_type_rail_temp = $request->loader_type_rail ? implode(',', Purify::clean($request->loader_type_rail)) : NULL;
      $data->freightage->freightage_loader_type_sea_temp = $request->loader_type_sea ? implode(',', Purify::clean($request->loader_type_sea)) : NULL;
      $data->freightage->freightage_loader_type_air_temp = $request->loader_type_air ? implode(',', Purify::clean($request->loader_type_air)) : NULL;

      $data->freightage->status = "active";

      $data->freightage->save();

      return redirect()->route('admin.freightage.profile.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminDriverAboutVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $users = User::where('role', 'driver')->where('status', 'active')->where('vendor_description_status', 'inactive')->latest()->paginate(10);

      return view('admin.backend.users.driver.verify_about.driver_about_status', compact('adminData', 'users'));
   }
   public function AdminDriverAboutVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $users = User::search($query_string)->where('role','driver')->where('status','active')->where('vendor_description_status','inactive')->paginate(10);

      return view('admin.backend.users.driver.verify_about.driver_about_status', compact('adminData', 'users'));
   }

   public function AdminDriverAboutVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $driverData = User::find((int) Purify::clean($id));

      return view('admin.backend.users.driver.verify_about.about_driver', compact('adminData', 'id', 'driverData'));
   }

   public function AdminDriverAboutVerifyStore(Request $request)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);

      $id = Purify::clean($request->id);
      $data = User::find((int) $id);

      $incomingFields = $request->validate([
         'vendor_description' => 'required',
      ], [
         'vendor_description.required' => 'لطفا توضیحات شرکت باربری را وارد نمایید.',
      ]);


      $data->vendor_description = ($incomingFields['vendor_description']);
      $data->vendor_description_status = 'active';
      $data->save();

      return redirect()->route('admin.driver.about.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

   public function AdminDriverProfileVerifyAll()
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);

      $driver_id = Driver::where('status', "inactive")->pluck('user_id')->toArray();
      $users = User::whereIn('id', $driver_id)->paginate(10);

      return view('admin.backend.users.driver.profile_field_of_activity.driver_activity_status', compact('adminData', 'users'));
   }

   public function AdminDriverProfileVerifyAllSearch(Request $request)
   {
      $id = Auth::user()->id;
      $adminData = User::find($id);
      $query_string = Purify::clean($request['query']);

      $driver_id = Driver::where('status', "inactive")->pluck('user_id')->toArray();
      $users = User::search($query_string)->whereIn('id', $driver_id)->paginate(10);

      return view('admin.backend.users.driver.profile_field_of_activity.driver_activity_status', compact('adminData', 'users'));
   }

   public function AdminDriverProfileVerify($id)
   {
      $user_id = Auth::user()->id;
      $adminData = User::find($user_id);
      $driverData = User::find((int) Purify::clean($id));

      $driver_sector_arr = explode(",", $driverData->driver->type_temp);

      // category for filter
      $vendor_sector_cat_arr = Category::where('parent', 0)->get();

      $filter_category_array = [];
      foreach ($vendor_sector_cat_arr as $parentCategory) {
         $all_children = Category::find($parentCategory->id)->child;
         $filter_category_array[] = array($parentCategory, $all_children);
      }
      // category for filter

      $vendorsName = User::where('role', 'vendor')->where('status', 'active')->get();

      $category_sector_cat_arr_selected = explode(',', $driverData->driver->category_id_temp);
      $vendor_arr_selected = explode(',', $driverData->driver->vendor_id_temp);

      $loader_type_arr_selected = explode(',', $driverData->driver->freightage_loader_type_temp);

      $driverTypeArray = DriverTypeService::getDriverTypeArray();
      $driverLoaderTypeRoadArray = DriverTypeRoadService::getDriverLoaderTypeRoadArray();

      return view('admin.backend.users.driver.profile_field_of_activity.activity_driver', compact('adminData', 'id', 'driverData', 'driver_sector_arr', 'vendor_sector_cat_arr', 'filter_category_array', 'vendorsName', 'category_sector_cat_arr_selected', 'vendor_arr_selected', 'loader_type_arr_selected', 'driverTypeArray', 'driverLoaderTypeRoadArray'));
   }

   public function AdminDriverProfileVerifyStore(Request $request)
   {
      $incomingFields = $request->validate([
         'type' => 'required',
         'category_id' => 'required',
      ], [
         'type.required' => 'لطفا زمینه فعالیت راننده را انتخاب نمایید.',
         'category_id.required' => 'لطفا حداقل یک دسته بندی مرتبط با راننده را انتخاب نمایید.',
      ]);

      // زمینه فعالیت زمینی
      if (in_array(1, $incomingFields['type'])) {
         if ($request->loader_type == NULL) {
            session()->flashInput($request->input());
            return back()->with('error', 'لطفا نوع بارگیر در حمل جاده ای را مشخص نمایید.');
         }
      }

      $data = User::find(Purify::clean($request->id));

      $data->driver->type = implode(',', Purify::clean($incomingFields['type']));
      $data->driver->category_id = implode(',', Purify::clean($incomingFields['category_id']));
      $data->driver->vendor_id = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
      $data->driver->freightage_loader_type = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;

      $data->driver->type_temp = implode(',', Purify::clean($incomingFields['type']));
      $data->driver->category_id_temp = implode(',', Purify::clean($incomingFields['category_id']));
      $data->driver->vendor_id_temp = $request->vendor_id ? implode(',', Purify::clean($request->vendor_id)) : NULL;
      $data->driver->freightage_loader_type_temp = $request->loader_type ? implode(',', Purify::clean($request->loader_type)) : NULL;

      $data->driver->status = "active";

      $data->driver->save();

      return redirect()->route('admin.driver.profile.verifyAll')->with('success', 'اطلاعات با موفقیت ذخیره و منتشر گردید.');
   }

}
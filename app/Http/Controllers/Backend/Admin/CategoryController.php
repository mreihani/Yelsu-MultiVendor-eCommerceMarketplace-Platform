<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function AllCategory(Request $request)
    {
        $category_id_filter = Purify::clean($request->id);

        $id = Auth::user()->id;
        $adminData = User::find($id);

        $categories = Category::where('parent', 0)->latest()->get();

        if (Purify::clean(request('filter_id'))) {
            $filter_id = Purify::clean(request('filter_id'));
            $categories = Category::where('id', $filter_id)->orderBy('parent', 'DESC')->get();
        }
        return view('admin.backend.category.category_all', compact('categories', 'adminData'));
    }

    public function AddCategory()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        $categories = Category::latest()->get();
        return view('admin.backend.category.category_add', compact('adminData', 'categories'));
    }

    public function StoreCategory(Request $request)
    {

        $incomingFields = $request->validate([
            'category_image' => 'required',
            'category_name' => ['required', Rule::unique('categories', 'category_name')],
        ], [
            'category_image.required' => 'لطفا تصویر دسته بندی را بارگذاری نمایید.',
            'category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
            'category_name.unique' => 'نام دسته بندی قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
        ]);

        $image = Purify::clean($incomingFields['category_image']);
        $name_gen = hexdec(uniqid()) . '.' . 'jpg';
        Image::make($image)->fit(217, 221)->encode('jpg')->save('storage/upload/category/' . $name_gen);

        $save_url = 'storage/upload/category/' . $name_gen;

        Category::insert([
            'category_name' => Purify::clean($incomingFields['category_name']),
            'category_image' => $save_url,
            'category_slug' => strtolower(str_replace('', '-', Purify::clean($incomingFields['category_name']))),
            'category_description' => ($request->category_description),
            'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
        ]);

        return redirect(route('all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditCategory($id)
    {
        $categories_id_array = [];
        $nonselected_category_array = [];

        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);

        $category = Category::findOrFail(Purify::clean($id));
        $categories = Category::latest()->get();

        $parent_id = $category->parent;
        if ($parent_id != NULL) {
            $selected_category = Category::findOrFail($parent_id);
        } else {
            $selected_category = NULL;
        }

        foreach ($categories as $category_item) {
            if ($id != $category_item->id) {
                $categories_id_array[] = $category_item->id;
            }
        }

        foreach ($categories_id_array as $category_item) {
            if ($parent_id !== $category_item) {
                $nonselected_category_array[] = Category::findOrFail($category_item);
            }
        }

        return view('admin.backend.category.category_edit', compact('category', 'categories', 'adminData', 'selected_category', 'nonselected_category_array'));
    }

    public function UpdateCategory(Request $request)
    {

        $incomingFields = $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
        ]);

        $cat_id = Purify::clean($request->id);
        $old_img = Purify::clean($request->old_image);

        if (Purify::clean($request->file('category_image'))) {
            $image = Purify::clean($request->file('category_image'));
            $name_gen = hexdec(uniqid()) . '.' . 'jpg';
            Image::make($image)->fit(217, 221)->encode('jpg')->save('storage/upload/category/' . $name_gen);
            $save_url = 'storage/upload/category/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Category::findOrFail($cat_id)->update([
                'category_name' => Purify::clean($incomingFields['category_name']),
                'category_image' => $save_url,
                'category_slug' => strtolower(str_replace('', '-', Purify::clean($incomingFields['category_name']))),
                'category_description' => ($request->category_description),
                'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            ]);

        } else {
            Category::findOrFail($cat_id)->update([
                'category_name' => Purify::clean($incomingFields['category_name']),
                'category_slug' => strtolower(str_replace('', '-', Purify::clean($incomingFields['category_name']))),
                'category_description' => ($request->category_description),
                'parent' => Purify::clean($request->parent) == 0 ? 0 : Purify::clean($request->parent),
            ]);
        }

        return redirect(route('all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت به‌روزرسانی گردید.');
    }

    public function DeleteCategory($id)
    {

        if (Purify::clean($id) == 1 || Purify::clean($id) == 2 || Purify::clean($id) == 3 || Purify::clean($id) == 4 || Purify::clean($id) == 5 || Purify::clean($id) == 6 || Purify::clean($id) == 7 || Purify::clean($id) == 8) {
            return redirect(route('all.category'))->with('error', 'شما اجازه حذف این دسته بندی را ندارید!');
        }

        $products = Category::with('products')->where('id', Purify::clean($id))->get();
        $products = $products[0]->products;

        foreach ($products as $product) {
            $category_array = explode(',', $product->category_id);
            if (in_array(Purify::clean($id), $category_array)) {
                $category_array = array_diff($category_array, array(Purify::clean($id)));
                $category_string = implode(',', $category_array);
                $product->update(['category_id' => $category_string]);
            }
        }

        $category = Category::findOrFail(Purify::clean($id));
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail(Purify::clean($id))->delete();

        return redirect(route('all.category'))->with('success', 'دسته بندی مورد نظر با موفقیت حذف گردید.');
    }
}
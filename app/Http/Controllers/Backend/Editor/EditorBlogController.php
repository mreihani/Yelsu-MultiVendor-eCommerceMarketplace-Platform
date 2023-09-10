<?php

namespace App\Http\Controllers\Backend\Editor;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

use App\Http\Controllers\Controller;

class EditorBlogController extends Controller
{
    // Start blog category section
    public function AllBlogCategory()
    {
        $editorData = User::find(Auth::user()->id);

        $blogcategories = BlogCategory::latest()->get();
        return view('editor.blog.blogcategory_all', compact('blogcategories', 'editorData'));
    }

    public function AddBlogCategory()
    {
        $editorData = User::find(Auth::user()->id);

        return view('editor.blog.blogcategory_add', compact('editorData'));
    }

    public function StoreBlogCategory(Request $request)
    {
        $incomingFields = $request->validate([
            'blog_category_name' => ['required', Rule::unique('blog_categories', 'blog_category_name')],
        ], [
            'blog_category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
            'blog_category_name.unique' => 'نام دسته بندی قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
        ]);

        BlogCategory::insert([
            'blog_category_name' => Purify::clean($incomingFields['blog_category_name']),
        ]);

        return redirect(route('editor.blog.category'))->with('success', 'دسته بندی مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditBlogCategory($id)
    {
        $editorData = User::find(Auth::user()->id);

        $blogcategories = BlogCategory::findOrFail(Purify::clean($id));

        return view('editor.blog.blogcategory_edit', compact('blogcategories', 'editorData'));
    }

    public function UpdateBlogCategory(Request $request)
    {
        $blog_id = Purify::clean($request->id);

        $incomingFields = $request->validate([
            'blog_category_name' => ['required', Rule::unique('blog_categories', 'blog_category_name')->ignore($blog_id)],
        ], [
            'blog_category_name.required' => 'لطفا نام دسته بندی را وارد نمایید.',
            'blog_category_name.unique' => 'نام دسته بندی قبلا ثبت شده است. لطفا یک نام دیگر وارد کنید.',
        ]);

        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => Purify::clean($incomingFields['blog_category_name']),
        ]);

        return redirect(route('editor.blog.category'))->with('success', 'دسته بندی مورد نظر با موفقیت بروزرسانی گردید.');
    }

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail(Purify::clean($id))->delete();

        return redirect(route('editor.blog.category'))->with('success', 'دسته بندی مورد نظر با موفقیت حذف گردید.');
    }
    // End blog category section

    // Start blog post section
    public function AllBlogPost()
    {
        $editorData = User::find(Auth::user()->id);

        $blogposts = BlogPost::latest()->get();
        return view('editor.blog.blogpost_all', compact('blogposts', 'editorData'));
    }

    public function AddBlogPost()
    {
        $editorData = User::find(Auth::user()->id);
        $blogcategories = BlogCategory::latest()->get();

        return view('editor.blog.blogpost_add', compact('editorData', 'blogcategories'));
    }

    public function StoreBlogPost(Request $request)
    {
        $incomingFields = $request->validate([
            'post_image' => 'required',
            'post_title' => ['required', Rule::unique('blog_posts', 'post_title')],
            'post_slug' => ['required', Rule::unique('blog_posts', 'post_slug')],
            'post_short_description' => 'required',
            'post_long_description' => 'required',
        ], [
            'post_image.required' => 'لطفا تصویر مقاله را بارگذاری نمایید.',
            'post_title.required' => 'لطفا عنوان مقاله را وارد نمایید.',
            'post_title.unique' => 'عنوان مقاله قبلا ثبت شده است. لطفا یک عنوان دیگر وارد کنید.',
            'post_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'post_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'post_short_description.required' => 'لطفا خلاصه مقاله را وارد نمایید.',
            'post_long_description.required' => 'لطفا متن کامل مقاله را وارد نمایید.',
        ]);

        if (Purify::clean($request->category_id) == "0") {
            return back()->with('error', 'لطفا یک دسته بندی مرتبط برای مقاله انتخاب نمایید.')->withInput();
        }

        $image = Purify::clean($incomingFields['post_image']);
        $unique_image_name = hexdec(uniqid());
        $name_gen = $unique_image_name . '.' . 'jpg';
        Image::make($image)->fit(930, 500)->encode('jpg')->save('storage/upload/blog/thumbnail/' . $name_gen);
        $save_url = 'storage/upload/blog/thumbnail/' . $name_gen;

        $post_id = BlogPost::insertGetId([
            'category_id' => Purify::clean($request->category_id),
            'user_id' => Auth::user()->id,
            'post_title' => Purify::clean($incomingFields['post_title']),
            'post_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['post_slug']))),
            'post_short_description' => ($request->post_short_description),
            'post_long_description' => ($request->post_long_description),
            'post_image' => $save_url,
            'status' => Purify::clean($request->status) == 'active' ? 'active' : 'disabled',
            'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
            'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
            'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
        ]);

        return redirect(route('editor.blog.post'))->with('success', 'مقاله مورد نظر با موفقیت ایجاد گردید.');
    }

    public function EditBlogPost($id)
    {
        $editorData = User::find(Auth::user()->id);
        $blogpost = BlogPost::find(Purify::clean($id));
        $blogcategories = BlogCategory::latest()->get();

        return view('editor.blog.blogpost_edit', compact('blogcategories', 'blogpost', 'editorData'));
    }

    public function UpdateBlogPost(Request $request)
    {
        $post_id = Purify::clean($request->id);
        $old_image = Purify::clean($request->old_image);

        $incomingFields = $request->validate([
            'post_title' => ['required', Rule::unique('blog_posts', 'post_title')->ignore($post_id)],
            'post_slug' => ['required', Rule::unique('blog_posts', 'post_slug')->ignore($post_id)],
            'post_short_description' => 'required',
            'post_long_description' => 'required',
        ], [
            'post_title.required' => 'لطفا عنوان مقاله را وارد نمایید.',
            'post_title.unique' => 'عنوان مقاله قبلا ثبت شده است. لطفا یک عنوان دیگر وارد کنید.',
            'post_slug.required' => 'لطفا اسلاگ را وارد نمایید.',
            'post_slug.unique' => 'اسلاگ قبلا ثبت شده است. لطفا یک عبارت دیگر وارد کنید.',
            'post_short_description.required' => 'لطفا خلاصه مقاله را وارد نمایید.',
            'post_long_description.required' => 'لطفا متن کامل مقاله را وارد نمایید.',
        ]);

        if (Purify::clean($request->category_id) == "0") {
            return back()->with('error', 'لطفا یک دسته بندی مرتبط برای مقاله انتخاب نمایید.')->withInput();
        }

        $image = Purify::clean($request->post_image);

        if ($image) {
            $unique_image_name = hexdec(uniqid());
            $name_gen = $unique_image_name . '.' . 'jpg';
            Image::make($image)->fit(930, 500)->encode('jpg')->save('storage/upload/blog/thumbnail/' . $name_gen);
            $save_url = 'storage/upload/blog/thumbnail/' . $name_gen;

            if ($old_image) {
                unlink($old_image);
            }

            BlogPost::findOrFail($post_id)->update([
                'category_id' => Purify::clean($request->category_id),
                'post_title' => Purify::clean($incomingFields['post_title']),
                'post_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['post_slug']))),
                'post_short_description' => ($request->post_short_description),
                'post_long_description' => ($request->post_long_description),
                'post_image' => $save_url,
                'status' => Purify::clean($request->status) == 'active' ? 'active' : 'disabled',
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            ]);
        } else {
            BlogPost::findOrFail($post_id)->update([
                'category_id' => Purify::clean($request->category_id),
                'post_title' => Purify::clean($incomingFields['post_title']),
                'post_slug' => strtolower(str_replace(' ', '-', Purify::clean($incomingFields['post_slug']))),
                'post_short_description' => ($request->post_short_description),
                'post_long_description' => ($request->post_long_description),
                'status' => Purify::clean($request->status) == 'active' ? 'active' : 'disabled',
                'meta_title' => Purify::clean($request['meta_title']) ?? NULL,
                'meta_description' => Purify::clean($request['meta_description']) ?? NULL,
                'meta_keywords' => Purify::clean($request['meta_keywords']) ?? NULL,
            ]);
        }

        return redirect(route('editor.blog.post'))->with('success', 'مقاله مورد نظر با موفقیت به روزرسانی گردید.');
    }

    public function DeleteBlogPost($id)
    {
        $blogpost = BlogPost::findOrFail(Purify::clean($id));
        $img = $blogpost->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        return redirect(route('editor.blog.post'))->with('success', 'مقاله مورد نظر با موفقیت حذف گردید.');
    }
    // End blog post section

}
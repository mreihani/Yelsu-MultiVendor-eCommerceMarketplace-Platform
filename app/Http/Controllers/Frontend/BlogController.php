<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Stevebauman\Purify\Facades\Purify;

class BlogController extends Controller
{
    // Start specific pages section
    public function getFinancingPage()
    {
        return view('frontend.blog.financing');
    }

    public function getEncomGalaxyPage()
    {
        return view('frontend.blog.encomgalaxy');
    }

    public function getGalaxyPetrolPage()
    {
        return view('frontend.blog.galaxypetrol');
    }

    public function getAboutusPage()
    {
        return view('frontend.blog.aboutus');
    }

    public function getContactusPage()
    {
        return view('frontend.blog.contanctus');
    }

    public function getPrivacyPolicyPage()
    {
        return view('frontend.blog.privacypolicy');
    }

    public function getMoneyLaundringPage()
    {
        return view('frontend.blog.moneylaundring');
    }

    public function emailContactusPage(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'message' => 'required',
            'captcha' => ['required', 'captcha'],
        ], [
            'name.required' => 'لطفا نام و نام خانوادگی خود را وارد نمایید.',
            'number.required' => 'لطفا شماره تلفن خود را وارد نمایید.',
            'email.required' => 'لطفا ایمیل خود را وارد نمایید.',
            'message.required' => 'لطفا پیام خود را وارد نمایید.',
            'captcha.required' => 'لطفا عبارت امنیتی را وارد نمایید.',
            'captcha.captcha' => 'لطفا عبارت امنیتی را به درستی وارد نمایید.',
        ]);

        $mailable = new Mailable();

        $mailable
            ->from(Purify::clean($incomingFields['email']))
            ->to('info@yelsu.com')
            ->subject('فرم تماس با ما - یل سو')
            ->html('نام و نام خانوادگی ارسال کننده: <br>' . Purify::clean($incomingFields['name']) . '<br><br>شماره تلفن: <br>' . Purify::clean($incomingFields['number']) . '<br><br>ایمیل ارسال کننده: <br>' . Purify::clean($incomingFields['email']) . '<br><br>پیام: <br>' . Purify::clean($incomingFields['message']));

        $result = Mail::send($mailable);

        return back()->with('success', 'ارسال با موفقیت انجام شد. از تماس شما متشکریم.');

    }

    public function getCreditPurchasePage()
    {
        return view('frontend.blog.creditpurchase');
    }

    public function emailCreditPurchasePage(Request $request)
    {

        $incomingFields = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
        ], [
            'name.required' => 'لطفا نام و نام خانوادگی خود را وارد نمایید.',
            'number.required' => 'لطفا شماره تلفن خود را وارد نمایید.',
            'email.required' => 'لطفا ایمیل خود را وارد نمایید.',
        ]);

        $mailable = new Mailable();

        $mailable
            ->from(Purify::clean($incomingFields['email']))
            ->to('info@yelsu.com')
            ->subject('فرم خرید اعتباری - یل سو')
            ->html('نام و نام خانوادگی ارسال کننده: <br>' . Purify::clean($incomingFields['name']) . '<br><br>شماره تلفن: <br>' . Purify::clean($incomingFields['number']) . '<br><br>ایمیل ارسال کننده: <br>' . Purify::clean($incomingFields['email']) . '<br><br>نوع خرید اعتباری: <br>' . Purify::clean($request->type) . '<br><br>توضیحات: <br>' . Purify::clean($request->message));

        $result = Mail::send($mailable);

        return back()->with('success', 'ارسال با موفقیت انجام شد. از تماس شما متشکریم.');
    }
    // End specific pages section

    // Start Frontend blog All section
    public function getBlogPage()
    {
        $blogcategories = BlogCategory::latest()->get();
        $blogposts = BlogPost::latest()->where('status', 'active')->paginate(5);

        return view('frontend.blog.home_blog', compact('blogcategories', 'blogposts'));
    }

    public function getBlogSinglePage($post_slug)
    {
        $blogcategories = BlogCategory::latest()->get();
        $post = BlogPost::where('status', 'active')->where('post_slug', Purify::clean($post_slug))->get();

        if(!count($post)) {
            redirect()->to('/')->send();
        }

        $post = $post[0];

        $recentposts = BlogPost::latest()->where('status', 'active')->whereNot('id', $post->id)->get();

        if ($post->meta_title != NULL) {
            SEOMeta::setTitle($post->meta_title);
        }

        if ($post->meta_description != NULL) {
            SEOMeta::setDescription($post->meta_description);
        }

        if ($post->meta_keywords != NULL) {
            $meta_keywords = explode('،', $post->meta_keywords);
            SEOMeta::setKeywords($meta_keywords);
        }

        return view('frontend.blog.single_blog', compact('post', 'recentposts', 'blogcategories'));
    }

    public function ViewblogCategoryFiltered($category_id)
    {
        $blogcategories = BlogCategory::latest()->get();
        $blogposts = BlogPost::latest()->where('status', 'active')->where('category_id', Purify::clean($category_id))->paginate(5);

        return view('frontend.blog.home_blog', compact('blogcategories', 'blogposts', 'category_id'));
    }

    public function ViewblogCategorySearch(Request $request)
    {
        $query_string = Purify::clean($request->search);

        $blogcategories = BlogCategory::latest()->get();
        $blogposts = BlogPost::latest()->where('status', 'active')->where('post_title', 'LIKE', "%{$query_string}%")->paginate(5);

        return view('frontend.blog.home_blog', compact('blogcategories', 'blogposts'));
    }
    // End blog frontend All section
}
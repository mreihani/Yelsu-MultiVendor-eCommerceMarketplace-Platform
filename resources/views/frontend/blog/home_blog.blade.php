@extends('frontend.main_theme')
@section('main')

<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">مقالات</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-6">
        <div class="container">
            @if(Route::currentRouteName() == 'blog.category')
                @php
                    $current_blog_category_name = App\Models\BlogCategory::find($category_id)->blog_category_name;
                @endphp
            @endif
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li>
                    مقالات
                    {{ (Route::currentRouteName() == 'blog.category') ? "($current_blog_category_name)" : '' }}
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg mb-10">
                <div class="main-content">
                    @if ($blogposts->count())
                        @foreach ($blogposts as $blogpost)
                            <article class="post post-classic overlay-zoom mb-4">
                                <figure class="post-media br-sm">
                                    <a href="{{route('home.blog.single',$blogpost->post_slug)}}">
                                        <img src="{{asset($blogpost->post_image)}}" width="930"
                                            height="500" alt="blog">
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-cats text-primary">
                                        <a href="{{route('blog.category',$blogpost->blogcategory->id)}}">{{$blogpost->blogcategory->blog_category_name}}</a>
                                    </div>
                                    <h4 class="post-title">
                                        <a href="{{route('home.blog.single',$blogpost->post_slug)}}">{{$blogpost->post_title}}</a>
                                    </h4>
                                    <div class="post-content">
                                        <p>{!! $blogpost->post_short_description !!}</p>
                                        <a href="{{route('home.blog.single',$blogpost->post_slug)}}" class="btn btn-link btn-primary">(ادامه مطلب)</a>
                                    </div>
                                    <div class="post-meta">
                                        توسط <a href="#" class="post-author">
                                            {{-- {{$blogpost->bloguser->firstname . ' ' . $blogpost->bloguser->lastname}} --}}
                                            یلسو
                                        </a>
                                        - <a href="#" class="post-date">{{jdate($blogpost->created_at)->format('Y/m/d')}}</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="post-details text-center">
                            <h2>
                                هیچ مقاله ای یافت نشد!
                            </h2>
                        </div>
                    @endif
                    @if ($blogposts->count())
                        {{$blogposts->links('vendor.pagination.custom')}}
                    @endif
                </div>
                @include('frontend.blog.layouts.blog_sidebar')
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>


@endsection
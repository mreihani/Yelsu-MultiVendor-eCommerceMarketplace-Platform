@extends('frontend.main_theme')
@section('main')

<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{$post->post_title}}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{URL::to('/')}}">خانه </a></li>
                <li><a href="{{route('home.blog')}}">مقالات </a></li>
                <li>{{$post->post_title}}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content mb-8">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content post-single-content">
                    <div class="post post-grid post-single">
                        <figure class="post-media br-sm">
                            <img src="{{asset($post->post_image)}}" alt="Blog" width="930" height="500" />
                        </figure>
                        <div class="post-details">
                            <div class="post-meta">
                                توسط <a href="#" class="post-author">
                                    {{-- {{$post->bloguser->firstname . ' ' . $post->bloguser->lastname}} --}}
                                    یلسو
                                </a>
                                - <a href="#" class="post-date">{{jdate($post->created_at)->format('Y/m/d')}}</a>
                                {{-- <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>0</span>نظرات </a> --}}
                            </div>
                            <h2 class="post-title">{{$post->post_title}}</h2>
                            <div class="post-content">
                                {!! $post->post_long_description !!}
                            </div>
                        </div>
                    </div>
                    <!-- End Post -->
                    
                    {{-- <div class="tags">
                        <label class="text-dark mr-2">برچسب ها: </label>
                        <a href="#" class="tag">مد </a>
                        <a href="#" class="tag">سبک </a>
                        <a href="#" class="tag">مسافرت </a>
                        <a href="#" class="tag">زنانه </a>
                    </div> --}}
                    <!-- End Tag -->
                    {{-- <div class="social-links mb-10">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                        </div>
                    </div> --}}
                    <!-- End Social Links -->
                    {{-- <div class="post-author-detail">
                        <figure class="author-media mr-4">
                            <img src="assets/images/blog/single/1.png" alt="Author" width="105" height="105" />
                        </figure>
                        <div class="author-details">
                            <div class="author-name-wrapper flex-wrap mb-2">
                                <h4 class="author-name font-weight-bold mb-2 pr-4 mr-auto">جعفر خان
                                    <span class="font-weight-normal text-default">(نویسنده)</span>
                                </h4>
                                <a href="#" class="btn btn-primary btn-link btn-icon-right pb-0 text-normal font-weight-normal mb-2">پست های بیشتر توسط ادمین<i class="w-icon-long-arrow-left"></i></a>
                            </div>
                            <p class="mb-0">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. . </p>
                        </div>
                    </div> --}}
                    <!-- End Post Author Detail -->
                    {{-- <div class="post-navigation">
                        <div class="nav nav-prev">
                            <a href="#" class="align-items-start text-left">
                                <span><i class="w-icon-long-arrow-right"></i>پست قبلی</span>
                                <span class="nav-content mb-0 text-normal">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. با تولید سادگی</span>
                            </a>
                        </div>
                        <div class="nav nav-next"> 
                            <a href="#" class="align-items-end text-right">
                                <span>پست بعدی <i class="w-icon-long-arrow-left"></i></span>
                                <span class="nav-content mb-0 text-normal">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</span>
                            </a>
                        </div>
                    </div> --}}
                    <!-- End Post Navigation -->
                    <h4 class="title title-lg font-weight-bold mt-10 pt-1 mb-5">پست های اخیر</h4>
                    <div class="swiper">
                        <div class="post-slider swiper-container swiper-theme nav-top pb-2" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 1,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 2
                                },
                                '1200': {
                                    'slidesPerView': 3
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-xs-2 cols-1">
                                @foreach ($recentposts->take(3) as $recentpost)
                                    <div class="swiper-slide post post-grid">
                                        <figure class="post-media br-sm">
                                            <a href="{{route('home.blog.single',$recentpost->post_slug)}}">
                                                <img src="{{asset($recentpost->post_image)}}" alt="Post" width="296"
                                                    height="190" style="background-color: #bcbcb4;" />
                                            </a>
                                        </figure>
                                        <div class="post-details text-center">
                                            <div class="post-meta">
                                                توسط <a href="#" class="post-author">{{$recentpost->bloguser->firstname . ' ' . $recentpost->bloguser->lastname}}</a>
                                                - <p class="post-date">{{jdate($post->created_at)->format('Y/m/d')}}</p>
                                            </div>
                                            <h4 class="post-title mb-3"><a href="{{route('home.blog.single',$recentpost->post_slug)}}">{{$recentpost->post_title}}</a></h4>
                                            <a href="{{route('home.blog.single',$recentpost->post_slug)}}" class="btn btn-link btn-dark btn-underline font-weight-normal">ادامه مطلب <i class="w-icon-long-arrow-left"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                        </div>
                    </div>
                    <!-- End پست های اخیر -->

                    {{-- @include('frontend.blog.layouts.blog_comment') --}}
                    
                </div>
                <!-- End of Main Content -->
                @include('frontend.blog.layouts.blog_sidebar')
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->

@endsection
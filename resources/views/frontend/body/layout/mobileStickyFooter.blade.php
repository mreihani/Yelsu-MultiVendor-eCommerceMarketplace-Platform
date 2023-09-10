<div class="sticky-footer sticky-content fix-bottom">

    <div class="sticky-footer-container">

        <div class="sticky-footer-container-double">
            <div>
                <a href="{{URL::to('/')}}" class="sticky-link active">
                    <i class="w-icon-home"></i>
                    <p>خانه</p>
                </a>
            </div>
            <div>
                <a href="{{route('shop')}}" class="sticky-link">
                    <i class="w-icon-shopify"></i>
                    <p>فروشگاه </p>
                </a>
            </div>
        </div>
        
        <div id="call_button_sticky_footer">
            <a href="tel:02191692471"><img width="36" height="36" src="{{asset('frontend/assets/images/phone-volume-solid.png')}}" alt=""></a>
        </div>
        <div class="sticky-footer-container-double">
            <div>
                <a href="{{URL::to('/cart')}}" class="sticky-link">
                    <i class="w-icon-cart"></i>
                    <p>سبد خرید</p>
                </a>
            </div>
            
            <div>
                <a href="{{route('dashboard')}}" class="sticky-link">
                    <i class="w-icon-account"></i>
                    <p>حساب کاربری </p>
                </a>
            </div>
        </div>
    
    </div>
</div>
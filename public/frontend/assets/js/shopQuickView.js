$(document).on("click", "#mfp-close", function () {
    $(".mfp-bg").remove();
    $(".mfp-wrap").remove();
});

$(document).on("click", ".main", function (e) {
    if (e.target.classList.contains("mfp-container")) {
        $(".mfp-bg").remove();
        $(".mfp-wrap").remove();
    }
});

$(document).keyup(function (e) {
    if (e.key === "Escape") {
        $(".mfp-bg").remove();
        $(".mfp-wrap").remove();
    }
});

$(".btn-product-icon.btn-cart.w-icon-cart").click(function (e) {
    let product_id = $(e.target)
        .closest("div.product-wrap")
        .children("span")
        .eq(3)
        .html();
    updateCartFunctionSingle(e, product_id);
});

$(".btn-quickview").click(function (e) {
    let imgage_url = $(e.target)
        .closest("div.product-wrap")
        .children(":first")
        .html();

    let product_code = $(e.target)
        .closest("div.product-wrap")
        .children("span")
        .eq(1)
        .html()
        ? $(e.target).closest("div.product-wrap").children("span").eq(1).html()
        : "بدون کد کالا";

    let short_desc = $(e.target)
        .closest("div.product-wrap")
        .children("span")
        .eq(2)
        .html()
        ? $(e.target).closest("div.product-wrap").children("span").eq(2).html()
        : "بدون کد ";

    let product_id = $(e.target)
        .closest("div.product-wrap")
        .children("span")
        .eq(3)
        .html();

    let product_qty = $(e.target)
        .closest("div.product-wrap")
        .children("span")
        .eq(4)
        .html();

    let product_cat = $(e.target)
        .closest("div.product-wrap")
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .html();

    let product_cat_href = $(e.target)
        .closest("div.product-wrap")
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .attr("href");

    let product_name = $(e.target)
        .closest("div.product-wrap")
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .children("h3")
        .eq(0)
        .html();

    let selling_price = $(e.target)
        .closest("div.product-wrap")
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .children("div")
        .eq(1)
        .html();

    let product_min = $(e.target)
        .closest("div.product-wrap")
        .find("input.product_min")
        .val();

    let product_max = $(e.target)
        .closest("div.product-wrap")
        .find("input.product_max")
        .val();
       

        
let html_with_button = `<div class="mfp-bg mfp-product mfp-fade mfp-ready"></div>
<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-product mfp-fade mfp-ready" tabindex="-1" style="overflow: hidden auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-rtl">
                    <div class="swiper-wrapper " id="swiper-wrapper-4e0bd06b6b86e2ea" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4" style="width: 395px;">
                            <figure class="product-image" style="position: relative; overflow: hidden; cursor: pointer;">

                                <img src=${imgage_url} data-zoom-image="${imgage_url}" alt="Water Boil Black Utensil" width="800" height="900">
                            <img role="presentation" alt="Water Boil Black Utensil" src="${imgage_url}" class="zoomImg" style="position: absolute; top: -0.869695px; left: -10.1392px; opacity: 0; width: 484px; height: 543.4px; border: none; max-width: none; max-height: none;"></figure>
                        </div>
                    </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative" style="height: 460px;">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">${product_name}</h2>
                <div class="product-bm-wrapper">
                    <div class="product-meta">
                        <div class="product-categories">
                            دسته بندی: 
                            <span class="product-category"><a href="${product_cat_href}">${product_cat}</a></span>
                        </div>
                        <div class="product-sku">
                           کد:  <span>${product_code}</span>
                        </div>
                    </div>
                </div>
                <hr class="product-divider">
                <div class="product-price">${selling_price}</div>
                <div class="product-short-desc">
                    <div class="list-type-check list-style-none">
                        ${short_desc}
                    </div>
                </div>
                <hr class="product-divider">
                <div class="product-form">
                <div class="product-qty-form">
                    <div class="input-group">
                        <input id="quantityInputvalue" class="quantity form-control" type="number" min="${product_min}" max="${product_max}" value="${product_min}">
                        <button class="quantity-plus w-icon-plus"></button>
                        <button class="quantity-minus w-icon-minus"></button>
                    </div>
                </div>
                    <button onclick="updateCartFunction(event, ${product_id})" class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>افزودن به سبد</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
<button title="Close (Esc)" type="button" id="mfp-close" class="mfp-close">×</button></div></div></div></div>`;

    let html_with_no_button = `<div class="mfp-bg mfp-product mfp-fade mfp-ready"></div>
<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-product mfp-fade mfp-ready" tabindex="-1" style="overflow: hidden auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-rtl">
                    <div class="swiper-wrapper " id="swiper-wrapper-4e0bd06b6b86e2ea" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4" style="width: 395px;">
                            <figure class="product-image" style="position: relative; overflow: hidden; cursor: pointer;">

                                <img src=${imgage_url} data-zoom-image="${imgage_url}" alt="Water Boil Black Utensil" width="800" height="900">
                            <img role="presentation" alt="Water Boil Black Utensil" src="${imgage_url}" class="zoomImg" style="position: absolute; top: -0.869695px; left: -10.1392px; opacity: 0; width: 484px; height: 543.4px; border: none; max-width: none; max-height: none;"></figure>
                        </div>
                    </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative" style="height: 460px;">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">${product_name}</h2>
                <div class="product-bm-wrapper">
                    <div class="product-meta">
                        <div class="product-categories">
                            دسته بندی: 
                            <span class="product-category"><a href="#">${product_cat}</a></span>
                        </div>
                        <div class="product-sku">
                           کد:  <span>${product_code}</span>
                        </div>
                    </div>
                </div>
                <hr class="product-divider">
                <div class="product-price">${selling_price}</div>
                <div class="product-short-desc">
                    <div class="list-type-check list-style-none">
                        ${short_desc}
                    </div>
                </div>
                <hr class="product-divider">
                <div class="">
                    <label class="product-label label-discount">عدم موجودی</label>           
                </div>
            </div>
        </div>
    </div>
<button title="Close (Esc)" type="button" id="mfp-close" class="mfp-close">×</button></div></div></div></div>`;

    if (product_qty == "show_button") {
        $("main").prepend(html_with_button);
    } else {
        $("main").prepend(html_with_no_button);
    }
});

$(document).on("click", ".quantity-plus", function (e) {
    
    let product_max = parseInt($(e.target)
    .closest("div.input-group")
    .find("input#quantityInputvalue")
    .attr("max"));

    let value = $(".quantity").val();

    if(value < product_max) {
        value++;
        $(".quantity").val(value);
    }
});

$(document).on("click", ".quantity-minus", function (e) {

    let product_min = parseInt($(e.target)
    .closest("div.input-group")
    .find("input#quantityInputvalue")
    .attr("min"));

    let value = $(".quantity").val();
    
    if(value > product_min && value > 0) {
        value--;
        $(".quantity").val(value);
    }
});

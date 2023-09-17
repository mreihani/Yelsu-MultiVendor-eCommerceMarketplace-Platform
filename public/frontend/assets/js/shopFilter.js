function filterAjaxFunction(e, id) {
    var request = $.ajax({
        url: `/shop/filter`,
        method: "GET",
        data: { category_id: id },
        success: function (data) {
            let html = "";

            data.forEach((element) => {
                if (element.products.length > 0) {
                    $.each(element.products, function (key, value) {
                        html += `
                        <div class="product-wrap">
                            
                            <span class="product_code d-none"></span>
                            <span class="short_desc d-none"><p>ear</p></span>
                            <span class="product_id d-none">10</span>
                            <span class="product_qty d-none">show_button</span>
                              
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="https://yelsu.com/product/details/10">
                                        <img src="${window.location.origin}/${value.product_thumbnail}" alt="${value.product_name}" width="300" height="338">
                                    </a>
                                    <div class="product-action-horizontal" style="width:90px">
                                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="افزودن به سبد "></a>
                                        
                                        <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="نمایش سریع"></a>
                                    </div>
                                </figure>
                                                                <div class="product-details">
                                    <div class="product-cat">
                                        <a href="">${value.parent_category_name}</a>
                                    </div>
                                    <h3 class="product-name">
                                        <a href="https://yelsu.com/product/details/10">${value.product_name}</a>
                                    </h3>
                                    
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                        ${value.selling_price} تومان
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>`;
                    });
                }
            });
            $(".product-wrapper").html(html);
        },
    });
}

$(document).on("click", ".filterButtonShopPage", function (e) {
    $(e.target).next("div").toggle();

    $(e.target).find("i.fa-plus").toggle();
    $(e.target).find("i.fa-minus").toggle();

    $(e.target).next("div").find(".subCategoryBtn").toggle();

    if (e.target.checked && $(e.target).is("input")) {
        $(e.target)
            .closest("li.filterButtonShopPage")
            .next("div")
            .find("li.filterButtonShopPage")
            .children()
            .each(function (index, element) {
                element.checked = true;
            });

        // $(e.target).parents("div").prev().children().each(function( index, element ) {
        //     element.checked = true;
        // });
    } else if (!e.target.checked && $(e.target).is("input")) {
        $(e.target)
            .closest("li.filterButtonShopPage")
            .next("div")
            .find("li.filterButtonShopPage")
            .children()
            .each(function (index, element) {
                element.checked = false;
            });
    }
});

// این مربوط به عملکرد + و - برای باز و بسته کردن هست
$(document).on("click", ".filterButtonShopPage .fa", function (e) {
    $(e.target).closest("li").next("div").toggle();

    $(e.target).closest("li").find("i.fa-plus").toggle();
    $(e.target).closest("li").find("i.fa-minus").toggle();

    $(e.target).closest("li").next("div").find(".subCategoryBtn").toggle();
});

// برای بسته بودن منوها هنگام بارگذاری اولیه
$(document).ready(function () {
    $("div.subCategoryBtn").hide();
    $("li.filterButtonShopPage").next("div.subCatGroup").hide();
});

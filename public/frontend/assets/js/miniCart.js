function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

$(".cart-toggle").click(function () {
    $.ajax({
        type: "GET",
        url: "/minicart",
        dataType: "json",
        success: function (response) {

            let miniCart = "";
            let shopName = "";
            let miniCartTotalPrice = 0;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            let currency;

            if (response.length > 0) {
                
                $.each(response, function (key, value) {

                    if(value.shop_name) {
                        shopName = `
                        <div>
                            <span class="product-shop-name">${value.shop_name}</span>
                        </div>
                        `;
                    } else {
                        shopName = "";
                    }
                    
                    miniCartTotalPrice +=
                        value.price_with_commission * value.cart.quantity;

                    miniCart += `
                                       
                    <div class="product product-cart">
                        <div class="product-detail">
                            <a href="" class="product-name">${value.products.product_name}</a>
                            <div class="price-box">
                                <span class="product-quantity">${value.cart.quantity}</span>
                                <span class="product-price">${formatNumber(value.price_with_commission)} ${value.currency}</span>
                            </div>
                            ${shopName}
                        </div>
                        <figure class="product-media">
                            <a href="">
                                <img src='${homeURL}/${value.products.product_thumbnail}' alt="product" height="84"
                                    width="94" />
                            </a>
                        </figure>
                        <form method="POST" action="${homeURL}/cart/delete/${value.cart.id}">
                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                        <input type="hidden" name="_method" value="delete"> 
                            <button class="btn btn-link btn-close" aria-label="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>  
                    </div>
                    
                    `;
                });

                $("#minicartRefresh").html(miniCart);
                $("#miniCartTotalPrice").html(formatNumber(miniCartTotalPrice));
                $(".minicart.gotoShop.cart-action").hide();
            } else {
                $("#minicartRefresh").html(
                    "<i style='font-size:100px;' class='w-icon-cart'></i><h4 style='margin-top:20px;'>هیچ محصولی در سبد خرید نیست.</h4>"
                );
                $("#minicartRefresh").css({
                    "text-align": "center",
                    "margin-top": "20px",
                });
                $(".minicart.cart-total").hide();
                $(".minicart.cart-action").hide();
                $(".minicart.gotoShop.cart-action").show();
            }
        },
    });
});

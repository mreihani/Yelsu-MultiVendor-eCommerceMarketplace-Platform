let delayTimer;

function formatNumberCart(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function removeComma(num) {
    return num.replaceAll(',', '');
}

function updateCartFunction(event, id, cartName = null, price, inputType) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        sendAjaxCartItem(event, id, cartName = null, price, inputType);
    }, 1500); 
}

function sendAjaxCartItem(event, id, cartName = null, price, inputType) {
    disableCheckoutBtn();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
    });

    let productInput = event.target.closest("div").firstElementChild;
    let productIputValue = productInput.value;

    // Check if the user is changing the quantity of the product by + and - button, then add and subtract value to avoid calc issues
    if(inputType == 1) {
        if (event.target.classList.contains("add-yelsu")) {
            productIputValue++;
        } else if(event.target.classList.contains("sub-yelsu")) {
            productIputValue--;
        }
    }

    document.getElementById("cart-page-overlay").style.display = "flex";

    var request = $.ajax({
        url: "/cart/quantity/change",
        method: "post",
        data: JSON.stringify({
            id: id,
            quantity: productIputValue <= 0 ? 1 : productIputValue,
            //cart:cartName,
            _method: "patch",
        }),
        success: function (data) {

            if (data.status == "success") {
                $("#continueShopping").prop("disabled", false);
                $("#continueShopping").css({
                    "background-color": "#333",
                    "border-color": "#333",
                });
                $("#continueShopping i").removeClass("fas fa-spinner fa-spin");
                $("#continueShopping i").addClass("w-icon-long-arrow-left");

                let cart_item_quantity = data.cart_item.quantity;
                $(productInput).val(cart_item_quantity);

                calculateTotalPrice(event, price, inputType);

                document.getElementById("cart-page-overlay").style.display = "none";
            }
        },
    });
}

function calculateTotalPrice(event, price, inputType) {
    let input = event.target.closest("div").firstElementChild;
    let itemSumPriceElementByClass = $(".itemSumPrice");
    
    let itemSumPrice = $(event.target).closest("tr").find(".itemSumPrice");

    if (inputType == 1) {

        if (event.target.classList.contains("add-yelsu")) {
            let totalPrice = 0;
            
            itemSumPrice.html(formatNumberCart(input.value * price));
            for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
                totalPrice += parseInt(removeComma(itemSumPriceElementByClass[i].innerHTML));
            }
            $("#totalPrice").html(formatNumberCart(totalPrice));
        } else if (
            event.target.classList.contains("sub-yelsu") &&
            input.value >= 1
        ) {
            let totalPrice = 0;

            itemSumPrice.html(formatNumberCart(input.value * price));
            for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
                totalPrice += parseInt(removeComma(itemSumPriceElementByClass[i].innerHTML));
            }
            $("#totalPrice").html(formatNumberCart(totalPrice));
        }
    } else if (inputType == 2) {
        input = event.target;
        // let value = parseInt(input.value);
        let totalPrice = 0;

        itemSumPrice.html(formatNumberCart(input.value * price));
        //itemSumPrice.innerHTML = formatNumberCart(input.value * price);
        for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
            totalPrice += parseInt(removeComma(itemSumPriceElementByClass[i].innerHTML));
        }
        $("#totalPrice").html(formatNumberCart(totalPrice));
    }
}

function disableCheckoutBtn() {
    //disable continue button
    $("#continueShopping").prop("disabled", true);
    $("#continueShopping").css({
        "background-color": "#ccc",
        "border-color": "#ccc",
    });
    $("#continueShopping i").removeClass("w-icon-long-arrow-left");
    $("#continueShopping i").addClass("fas fa-spinner fa-spin");
}
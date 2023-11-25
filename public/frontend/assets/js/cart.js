let delayTimer;

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

    document.getElementById("cart-page-overlay").style.display = "flex";

    var request = $.ajax({
        url: "/cart/quantity/change",
        method: "post",
        data: JSON.stringify({
            id: id,
            quantity: productInput.value,
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
    let itemSumPrice =
        event.target.parentElement.parentElement.nextElementSibling.children[0]
            .children[0];

    if (inputType == 1) {
        let value = parseInt(input.value);

        if (event.target.classList.contains("add-yelsu")) {
            let totalPrice = 0;
            let product_max = parseInt($(event.target).closest(".input-group").find("input").attr("max"));
            
            if(input.value < product_max) {
                input.value++;
            }
            
            itemSumPrice.innerHTML = input.value * price;
            for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
                totalPrice += parseInt(itemSumPriceElementByClass[i].innerHTML);
            }
            $("#totalPrice").html(totalPrice);
        } else if (
            event.target.classList.contains("sub-yelsu") &&
            input.value > 1
        ) {
            let totalPrice = 0;
            let product_min = parseInt($(event.target).closest(".input-group").find("input").attr("min"));

            if(input.value > product_min) {
                input.value--;
            }

            itemSumPrice.innerHTML = input.value * price;
            for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
                totalPrice += parseInt(itemSumPriceElementByClass[i].innerHTML);
            }
            $("#totalPrice").html(totalPrice);
        }
    } else if (inputType == 2) {
        input = event.target;
        let value = parseInt(input.value);
        let totalPrice = 0;

        itemSumPrice.innerHTML = input.value * price;
        for (let i = 0; i < itemSumPriceElementByClass.length; i++) {
            totalPrice += parseInt(itemSumPriceElementByClass[i].innerHTML);
        }
        $("#totalPrice").html(totalPrice);
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
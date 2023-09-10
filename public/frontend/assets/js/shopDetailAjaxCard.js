function updateCartFunction(event, id) {
    let input = $(event.target)
        .closest("div.product-form")
        .children("div")
        .eq(0)
        .children("div")
        .eq(0)
        .children("input")
        .eq(0);
    let quantity = parseInt(input.val());

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
    });

    var request = $.ajax({
        url: `/cart/add`,
        method: "post",
        data: JSON.stringify({
            id: id,
            quantity: quantity,
        }),
        success: function (data) {
            // if (data.status == "success") {
            //     console.log("success");
            // }
            $(".cart-count").html(data.cartCountProducts);
        },
    });
}

function updateCartFunctionSingle(event, id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
    });

    var request = $.ajax({
        url: `/cart/add`,
        method: "post",
        data: JSON.stringify({
            id: id,
            quantity: 1,
        }),
        success: function (data) {
            // if (data.status == "success") {
            //     console.log("success");
            // }
            $(".cart-count").html(data.cartCountProducts);
        },
    });
}

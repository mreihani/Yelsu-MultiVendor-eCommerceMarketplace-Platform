function updateCartFunction(id) {
    let quantity = $("#quantityInputvalue")[0].value;

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

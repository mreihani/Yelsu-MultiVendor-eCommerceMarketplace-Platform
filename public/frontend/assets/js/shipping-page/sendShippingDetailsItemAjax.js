$(".shipping-page-content").on("click", ".row-save-btn", function () {
    
    // Store the current element in a variable for easier access
    let thisElement = $(this);

    // Hide save btn
    thisElement.addClass('d-none');
    thisElement.removeClass('d-flex');

    // Show pending btn
    thisElement.next('.row-pending-btn').removeClass('d-none');
    thisElement.next('.row-pending-btn').addClass('d-flex');

    // Find the shippingControllerPanel element in the DOM
    let shippingRowObjectJson = thisElement.closest("tr").find('.shipping-row-object-json').val();

    // Find row id
    let selectedRowId = parseInt(thisElement.closest("tr").find(".shipping-row").html());

    // Get order_vproduct_id
    let order_vproduct_id = parseInt($(".order-vproduct-id").val());

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        data:{
            shippingRowObjectJson,
            selectedRowId,
            order_vproduct_id
        },
        url: "/send-shipping-details-item",
        success: function (response) {
            if(response == 1) {
                // hide pending btn after ajax response
                thisElement.next('.row-pending-btn').removeClass('d-flex');
                thisElement.next('.row-pending-btn').addClass('d-none');

                // Show success btn after ajax response
                thisElement.parent().find('.row-save-btn-success').removeClass('d-none');
                thisElement.parent().find('.row-save-btn-success').addClass('d-flex');
            }
        }
    });
});


function deleteRowAjax(selectedRowId) {
    
    let orderVproductId = parseInt($(".order-vproduct-id").val());

    $.ajax({
        type: "GET",
        data: {
            selectedRowId,
            orderVproductId
        },
        url: "/delete-shipping-details-item",
        success: function (response) {
            return response;
        },
        
    });

}
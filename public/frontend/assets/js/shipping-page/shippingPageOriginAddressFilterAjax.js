$(".shipping-page-content").on("click", ".shipping-panel-btn", function () {

    // Store the current element in a variable for easier access
    let thisElement = $(this);

    // Find the shippingControllerPanel element in the DOM
    let shippingControllerPanel = $(".shipping-controller-panel");

    // Get the closest element with the class "number-items-request" relative to 'thisElement'
    let closestNumberItemsRequestElement = thisElement.closest(".number-items-request");
    
    // Find the input element inside the closestNumberItemsRequestElement
    let inputElement = closestNumberItemsRequestElement.find("input");
    
    // Get the value of the input element and parse it as an integer
    let numberItemsRequest = parseInt(inputElement.val());

    // Find the shipping element in the DOM using jQuery
    let shipping_element = $(".shipping-element");
    
    // Find the product ID within the shipping element and get its value
    let product_id = shipping_element.find(".product_id").val();
    
    // Find the order ID within the shipping element and get its value
    let order_id= shipping_element.find(".order_id").val();
    
    // Find the order origin address select element within the shipping element
    let orderOriginAddressSelectElement = shipping_element.find(".order-origin-address select");

    // Find the HTML element with class "order-origin-address-html" within the shipping_element
    let orderOriginAddressHtmlElement = shipping_element.find(".order-origin-address-html");
    
    $.ajax({
        type: "GET",
        data:{
            numberItemsRequest,
            product_id,
            order_id
        },
        url: "/get-origin-addresses-filtered",
        success: function (response) {

            // Remove the class "d-flex" from the shippingControllerPanel
            shippingControllerPanel.removeClass("d-none");

            // Add the class "d-flex" to the shippingControllerPanel
            shippingControllerPanel.addClass("d-flex");

            // Clear the order origin address select element
            orderOriginAddressSelectElement.empty();

            let optionElement = "";

            // Check if the response array has elements
            if (response.length) {
                // Iterate through the response array and build the option elements
                response.forEach((item) => {
                    optionElement += `<option value="${item.id}">${item.shop_name}</option>`;
                });

                // Create the HTML for the origin address information
                let originAddressHTML = `
                <p>
                    <i class="w-icon-map-marker"></i>
                    آدرس:
                    <span class="vendor-address">
                        ${response[0].shop_address}
                    </span>
                </p>`;

                // Clear and append the origin address HTML to the designated element
                orderOriginAddressHtmlElement.empty();
                orderOriginAddressHtmlElement.append(originAddressHTML);
                
            } else {
                // Set optionElement to a default "no address found" option
                optionElement = `<option value="0">هیچ آدرسی یافت نشد</option>`;

                // Clear the origin address HTML element
                orderOriginAddressHtmlElement.empty();
            }
            
            // Append the optionElement to the order origin address select element
            orderOriginAddressSelectElement.append(optionElement);
        }
    });
});
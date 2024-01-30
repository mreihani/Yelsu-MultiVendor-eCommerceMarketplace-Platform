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

    // Validate the number of items requested
    let inputValidationResult = inputValidationOriginAddress(numberItemsRequest);

    // Validate the schedule
    let scheduleInputValidationResult = scheduleInputValidationOriginAddressHandler();

    // If the input validation result is false, return
    if(!inputValidationResult || !scheduleInputValidationResult) {
        disableControlPanelSelectElements();
        return;
    } else {
        enableControlPanelSelectElements();
    }

    // Send an AJAX request to get the origin addresses
    $.ajax({
        type: "GET",
        data:{
            numberItemsRequest,
            product_id,
            order_id
        },
        url: "/get-origin-addresses-filtered",
        success: function (response) {

            // Clear the order origin address select element
            orderOriginAddressSelectElement.empty();

            // Set optionElement to an empty string
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


/**
 * Validates the origin address based on the number of items requested.
 * @param {number} numberItemsRequest - The number of items requested.
 * @returns {boolean} - True if the origin address is valid, false otherwise.
 */
function inputValidationOriginAddress(numberItemsRequest) {

    // Find the HTML element with class "number-items-request-value-alert" within the shipping_element
    let number_items_request_value_alert = $("#number-items-request-value-alert");

    // Get the minimum loader type value from the element with ID "loader_type_min"
    let loader_type_min = parseInt($("#loader_type_min").val());

    // Get the maximum loader type value from the element with ID "loader_type_max"
    let loader_type_max = parseInt($("#loader_type_max").val());

    // Validate the number of items requested
    if (numberItemsRequest < loader_type_min || numberItemsRequest > loader_type_max || numberItemsRequest <= 0 || !numberItemsRequest) {

        // Add the "d-none" class to the number_items_request_value_alert
        number_items_request_value_alert.removeClass("d-none");

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        return false;
    } else {

        // Remove the "d-none" class from the number_items_request_value_alert
        number_items_request_value_alert.addClass("d-none");

        return true;
    }
}

/**
 * Handle input validation for the schedule element
 */
function scheduleInputValidationOriginAddressHandler() {
    // Get the schedule element alert
    let scheduleAlertElement = $("#shedule-alert");

    // Get the deliver date input value
    let deliverDateInputValue = $(".shipping-schedule input").val();

    // Validate the schedule element
    if (!deliverDateInputValue) {
        
        // Remove the hidden class to show the alert
        scheduleAlertElement.removeClass("d-none");

        // Scroll to the top of the screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        return false;
    } else {

        // Add the hidden class to hide the alert
        scheduleAlertElement.addClass("d-none");

        return true;
    }
}

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
    let order_id = shipping_element.find(".order_id").val();

    // Select the element with class "freightage-information-dropdown"
    let freightageInformationDropdownElement = $(".freightage-information-dropdown");
    
    // Call the AJAX function with the product ID and order ID
    $.ajax({
        type: "GET",
        data:{
            numberItemsRequest,
            product_id,
            order_id
        },
        url: "/get-freightage-company-filtered",
        success: function (response) {

            // Clear the content of the freightage information dropdown element
            freightageInformationDropdownElement.empty();

            // Set optionElement to an empty string
            let optionElement = "";

            // Check if the response array has elements
            if (response.length) {

                // Remove the class "d-flex" from the shippingControllerPanel
                //shippingControllerPanel.removeClass("d-none");

                // Add the class "d-flex" to the shippingControllerPanel
                //shippingControllerPanel.addClass("d-flex");

                // Set optionElement to an empty string      
                optionElement = `
                    <option value="0">شرکت باربری را انتخاب نمایید</option>
                `;

                // Iterate through the response array and build the option elements
                response.forEach((item) => {
                    // Add the option element to the optionElement variable
                    optionElement += `
                        <option value="${item.id}">${item.shop_name}</option>
                    `;
                });

            } else {
                // Set optionElement to a default "no address found" option
                optionElement = `<option value="0">
                    هیچ شرکت باربری یافت نشد
                </option>`;
            }
            
            // Append the optionElement to the order origin address select element
            freightageInformationDropdownElement.append(optionElement);
        }
    });
});
$(".shipping-page-content").on("click", ".shipping-panel-btn", function () {

    // Hide remaining alert on panel btn click
    $("#number-items-greater-than-remaining-alert").addClass("d-none");

    // Get the value of the input element and parse it as an integer
    let numberItemsRequest = parseInt($(".number-items-request input").val());

    // Get the value of the element with the ID "loader_type_min" using jQuery and store it in the variable loader_type_min
    let loader_type_min = parseInt($("#loader_type_min").val());

    // Get the value of the element with the ID "loader_type_max" using jQuery and store it in the variable loader_type_max
    let loader_type_max = parseInt($("#loader_type_max").val());

    // Get the remaining values
    let remainingQuantityInputValue = parseInt($(".remaining-quantity-input").val());

    // calculate difference between selectedElementRequestInput and numberItemsRequest
    let numberOfRequestInputDiff = numberItemsRequest - selectedElementRequestInput;

    // Validate the number of items requested
    if((numberItemsRequest < loader_type_min || numberItemsRequest > loader_type_max) && numberItemsRequest <= remainingQuantityInputValue) {

        // Remove the "d-none" class to the number_items_request_value_alert, if the value is less than the minimum or greater than the maximum
        $("#number-items-request-value-alert").removeClass("d-none");

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        // Disable the control panel select elements
        disableControlPanelSelectElements();

    // Validate the number of items requested, if the value is larger than the remaining quantity
    } else if(numberOfRequestInputDiff > remainingQuantityInputValue) {

        // Remove the "d-none" class to the number_items_request_value_alert
        $("#number-items-greater-than-remaining-alert").removeClass("d-none");

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        // Disable the control panel select elements
        disableControlPanelSelectElements();
    } else {

        // Add the "d-none" class to the number_items_request_value_alert
        $("#number-items-request-value-alert").addClass("d-none");

        // Enable the control panel select elements
        enableControlPanelSelectElements();
    }

});
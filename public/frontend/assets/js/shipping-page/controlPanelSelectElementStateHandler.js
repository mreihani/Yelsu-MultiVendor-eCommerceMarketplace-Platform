// set the initial state of the select element to disabled
$(".shipping-controller-panel select").attr("disabled", true);

/**
 * Enables the control panel select element state.
 * @param {jQuery} - The jQuery select element to enable.
 */
function enableControlPanelSelectElements() {

    // get the select element
    let shippingControllerPanelSelectElement = $(".shipping-controller-panel select");

    // enable the select element
    shippingControllerPanelSelectElement.removeAttr("disabled");

    // hide click request btn alert
    $(".request-btn-show-all-forms").addClass("d-none");
}

/**
 * Disables the shipping controller panel select element state.
 * 
 * @param {jQuery} - The jQuery select element to disable.
 */
function disableControlPanelSelectElements() {

    // get the select element
    let shippingControllerPanelSelectElement = $(".shipping-controller-panel select");

    // disable the select element
    shippingControllerPanelSelectElement.attr("disabled", true);
}

// appear calculate btn when loader type is selected
$(".shipping-element").on("change", ".freightage-loader-type-dropdown",function() {

    let thisElement = $(this);
    let shippingPageElement = thisElement.closest(".shipping-page-content");

    // show calc btn
    let calcBtn = shippingPageElement.find('.shipping-calculate-btn');
    calcBtn.removeClass("d-none");
    calcBtn.addClass("d-flex");

    // hide confirm btn
    let confirmBtn = shippingPageElement.find('.shipping-calc-confirm-btn');
    confirmBtn.addClass("d-none");
    confirmBtn.removeClass("d-flex");

    // hide cancel btn
    let cancelBtn = shippingPageElement.find('.shipping-calc-cancel-btn');
    cancelBtn.addClass("d-none");
    cancelBtn.removeClass("d-flex");

    // hide shipping calculation element
    let shippingCalculations = shippingPageElement.find('.shipping-calculations');
    shippingCalculations.addClass("d-none");
});
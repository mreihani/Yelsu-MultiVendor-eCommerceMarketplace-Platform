// reset loader type and loader dropdown form when origin address changes
$(".order-origin-address").on("change", ".vendor-address-information",function() {
    let thisElement = $(this);
    let freightage_company_name_element = thisElement.closest(".shipping-element").find(".freightage-company-name");
    let shippingPageElement = thisElement.closest(".shipping-page-content");

    // this method has been written in shippingPageFreightageInformationAjax.js file
    removePreviousElementsInformationDropdown(freightage_company_name_element);

    // این کد ادامه تابع بالایی است منتها فقط برای دراپ داون آدرس مبدا باید اعمال شود و میاد نام شرکت بابری رو از اول ریست میکنه
    freightage_company_name_element.find(".freightage-information-dropdown").val('0').change();

    // hide verify btn
    let verifIconElem = shippingPageElement.find(".shipping-calc-confirm-btn");
    verifIconElem.addClass("d-none");
    verifIconElem.removeClass("d-flex");

    // hide cancel btn
    let cancelIconElem = shippingPageElement.find(".shipping-calc-cancel-btn");
    cancelIconElem.addClass("d-none");
    cancelIconElem.removeClass("d-flex");

    // hide price calculated element
    $(".shipping-calculations").addClass("d-none");

    // hide calculated distance on origin address change
    $(".calculated-distance").addClass("d-none");
});

// send ajax to retrieve freightage company information
$(".freightage-company-name").on("change", ".freightage-activity-field-dropdown", function () {
    let thisElement = $(this);
    let freightage_activity_field_dropdown_element = thisElement.closest(".freightage-company-name").find(".freightage-activity-field-dropdown");
    let type_id = freightage_activity_field_dropdown_element.val();
    let freightage_loader_type_element = freightage_activity_field_dropdown_element.closest(".freightage-company-name");
    let freightage_id = freightage_loader_type_element.find(".freightage_id").val();
    let product_id = freightage_loader_type_element.find("input.product_id").val();
    let order_id = freightage_loader_type_element.find("input.order_id").val();

    let vendor_address_information_element = thisElement.closest(".shipping-element").find(".vendor-address-information");
    let outlet_id = vendor_address_information_element.val();

    // hide confirm btn
    let confIconElem = thisElement.closest(".shipping-element").find(".shipping-calc-confirm-btn");
    confIconElem.addClass("d-none");
    confIconElem.removeClass("d-flex");

    // hide cancel btn
    let cancelIconElem = thisElement.closest(".shipping-element").find(".shipping-calc-cancel-btn");
    cancelIconElem.addClass("d-none");
    cancelIconElem.removeClass("d-flex");

    let shippingPageElement = thisElement.closest(".shipping-page-content");

    // hide shipping calculation element
    let shippingCalculations = shippingPageElement.find('.shipping-calculations');
    shippingCalculations.addClass("d-none");

    $.ajax({
        type: "GET",
        data:{
            type_id,
            freightage_id,
            product_id,
            order_id,
            outlet_id
        },
        url: "/get-freightage-loader-type",
        success: function (response) {
            removePreviousElementsActivityField(freightage_loader_type_element);
            freightage_loader_type_element.append(createFreightageLoaderTypeHTML(response));
        },
    });
})


function createFreightageLoaderTypeHTML(response) {
    let freightageLoaderType = '';

    $(document).ready(function() {
        $('.freightage-loader-type-dropdown').select2({
            placeholder: 'نوع بارگیر را انتخاب نمایید',
            dir: "rtl",
        });
    });

    $.each(response, function(key,value){
        freightageLoaderType += `
            <option value="${value.id}">${value.description}</option>
        `;
    });
    let html = 
    `<div class="form-group freightage-company-loader-type mt-8">
        <label>انتخاب نوع بارگیر</label>
        <div>
            <select class="form-control form-control-md freightage-loader-type-dropdown">
                <option>نوع بارگیر را انتخاب نمایید</option>
                ${freightageLoaderType}
            </select>
        </div>
    </div>`;

    return html;
}

function removePreviousElementsActivityField(freightage_loader_type_element) {
    let freightage_loader_type_dropdown_element = freightage_loader_type_element.find(".freightage-company-loader-type");
    if(freightage_loader_type_dropdown_element) {
        freightage_loader_type_dropdown_element.remove()
    }
}

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

// reset loader type and loader dropdown form when destination address changes
$(".order-destination-address").on("change", ".user-address-information",function() {
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

    // hide calculated distance on destination address change
    $(".calculated-distance").addClass("d-none");
});


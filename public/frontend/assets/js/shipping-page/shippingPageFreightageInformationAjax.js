// send ajax to retrieve freightage company information
$(".freightage-company-name").on("change", ".freightage-information-dropdown", function () {
    let thisElement = $(this);
    let freightage_id = thisElement.val();
    let freightage_company_name_element = thisElement.closest(".freightage-company-name");
    let product_id = freightage_company_name_element.find("input.product_id").val();
    let shippingPage= thisElement.closest(".shipping-element");

    // hide confirmation btn
    let confIconElem = shippingPage.find(".shipping-calc-confirm-btn");
    confIconElem.addClass("d-none");
    confIconElem.removeClass("d-flex");

    // hide cancel btn
    let cancelIconElem = shippingPage.find(".shipping-calc-cancel-btn");
    cancelIconElem.addClass("d-none");
    cancelIconElem.removeClass("d-flex");

    // hide calc btn
    let calcBtnElement = shippingPage.find(".shipping-calculate-btn");
    calcBtnElement.addClass("d-none");
    calcBtnElement.removeClass("d-flex");

    // hide shipping calculation element
    let shippingCalculations = thisElement.closest(".shipping-page-content").find('.shipping-calculations');
    shippingCalculations.addClass("d-none");

    // Get the closest element with the class "number-items-request" relative to 'thisElement'
    let numberItemsRequest = parseInt(shippingPage.find(".number-items-request input").val());

    $.ajax({
        type: "GET",
        data:{
            freightage_id,
            product_id,
            numberItemsRequest
        },
        url: "/get-freightage-information",
        success: function (response) {
            if(response) {
                removePreviousElementsInformationDropdown(freightage_company_name_element);
                freightage_company_name_element.append(createFreightageActivityFieldHTML(response.freightage_obj_filtered, freightage_id));
            }
        },
    });
});


function createFreightageActivityFieldHTML(response, freightage_id) {
    let html = "";

    $(document).ready(function() {
        $('.freightage-activity-field-dropdown').select2({
            placeholder: 'روش ارسال را انتخاب نمایید'
        });
    });

    let freightageActivityField = '';

    $.each(response, function(key,value){
        freightageActivityField += `
            <option value="${value.id}">${value.value}</option>
        `;
    });
    
    if(response.length > 0) {
        html = 
        `<div class="form-group freightage-company-activity-field" style="margin-top:56px;">
            <label>روش ارسال کالا</label>
            <input type="hidden" value="${freightage_id}" class="freightage_id">
            <div>
                <select class="form-control form-control-md freightage-activity-field-dropdown">
                    <option value="0">روش ارسال را انتخاب نمایید</option>
                    ${freightageActivityField}
                </select>
            </div>
        </div>`;
    } else {
        html = 
        `<div class="form-group freightage-company-activity-field" style="margin-top:56px;">
            <label>روش ارسال کالا</label>
            <input type="hidden" value="${freightage_id}" class="freightage_id">
            <div>
                <select class="form-control form-control-md freightage-activity-field-dropdown">
                    <option value="0">هیچ روش ارسالی یافت نشد</option>
                </select>
            </div>
        </div>`;
    }
    

    return html;
}

function removePreviousElementsInformationDropdown(freightage_company_name_element) {
    let freightage_company_activity_field_element = freightage_company_name_element.find(".freightage-company-activity-field");
    if(freightage_company_activity_field_element) {
        freightage_company_activity_field_element.remove()
    }

    let freightage_loader_type_dropdown_element = freightage_company_name_element.find(".freightage-company-loader-type");
    if(freightage_loader_type_dropdown_element) {
        freightage_loader_type_dropdown_element.remove()
    }
}

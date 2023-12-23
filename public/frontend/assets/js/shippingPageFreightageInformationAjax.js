// send ajax to retrieve freightage company information
$(".freightage-company-name").on("change", ".freightage-information-dropdown", function () {
    let thisElement = $(this);
    let freightage_id = thisElement.val();
    let freightage_company_name_element = thisElement.closest(".freightage-company-name");
    let product_id = freightage_company_name_element.find("input.product_id").val()    ;

    $.ajax({
        type: "GET",
        data:{
            freightage_id,
            product_id
        },
        url: "/get-freightage-information",
        success: function (response) {
            removePreviousElementsInformationDropdown(freightage_company_name_element);
            freightage_company_name_element.append(createFreightageActivityFieldHTML(response.freightage_obj_filtered, freightage_id));
        },
    });
});


function createFreightageActivityFieldHTML(response, freightage_id) {

    let freightageActivityField = '';

    $.each(response, function(key,value){
        freightageActivityField += `
            <option value="${value.id}">${value.value}</option>
        `;
    });

    let html = 
    `<div class="form-group freightage-company-activity-field" style="margin-top:42px;">
        <label>روش ارسال کالا</label>
        <input type="hidden" value="${freightage_id}" class="freightage_id">
        <div>
            <select class="form-control form-control-md freightage-activity-field-dropdown">
                <option value="">روش ارسال را انتخاب نمایید</option>
                ${freightageActivityField}
            </select>
        </div>
    </div>`;

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
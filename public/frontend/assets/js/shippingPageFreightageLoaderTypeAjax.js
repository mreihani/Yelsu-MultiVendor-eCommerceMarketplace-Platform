// send ajax to retrieve freightage company information
$(".freightage-company-name").on("change", ".freightage-activity-field-dropdown", function () {
    let thisElement = $(this);
    let freightage_activity_field_dropdown_element = thisElement.closest(".freightage-company-name").find(".freightage-activity-field-dropdown");
    let type_id = freightage_activity_field_dropdown_element.val();
    let freightage_loader_type_element = freightage_activity_field_dropdown_element.closest(".freightage-company-name");
    let freightage_id = freightage_loader_type_element.find(".freightage_id").val();
    let product_id = freightage_loader_type_element.find("input.product_id").val();

    $.ajax({
        type: "GET",
        data:{
            type_id,
            freightage_id,
            product_id
        },
        url: "/get-freightage-loader-type",
        success: function (response) {
            removePreviousElementsActivityField(freightage_loader_type_element);
            freightage_loader_type_element.append(createFreightageLoaderTypeHTML(response));
        },
    });
})


function createFreightageLoaderTypeHTML(response) {

    $(document).ready(function() {
        $('.freightage-loader-type-dropdown').select2({
            placeholder: 'نوع بارگیر را انتخاب نمایید',
            dir: "rtl",
        });
    });

    let freightageLoaderType = '';

    $.each(response, function(key,value){
        freightageLoaderType += `
            <option value="${value.id}">${value.description}</option>
        `;
    });

    let html = 
    `<div class="form-group freightage-company-loader-type mt-8">
        <label>انتخاب نوع بارگیر</label>
        <div>
            <select class="form-control form-control-md freightage-loader-type-dropdown" multiple="multiple">
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
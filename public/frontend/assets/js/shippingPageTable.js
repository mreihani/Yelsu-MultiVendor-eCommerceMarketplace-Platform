// function to start datatables
function startDataTables() {
    // start datatables
    new DataTable('.yelsuDataTables', {
        responsive: true,
        searching: false,
        "ordering": false,
        "dom": 'rt',
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets: -1
        }],
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        "pageLength": -1 
    });
}
startDataTables();

// data table crud operation
let table_body_elements = $("#table-body");
let table_row_number_card = $("#table-row-number-card");

// add a row in table when confirm btn is clicked
$(".shipping").on("click", ".shipping-calc-confirm-btn", function() {
    let thisElem = $(this);
    let shippingElement = thisElem.closest(".shipping");
    
    // create origin address object
    let order_origin_address_obj_array = [];
    let order_origin_address_obj;
    let order_origin_address = shippingElement.find(".order-origin-address option");
    let order_origin_address_selected = shippingElement.find(".order-origin-address option:selected");
    $.each(order_origin_address, function(index,value) {
        order_origin_address_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == order_origin_address_selected.val() ? true : false
        }
        order_origin_address_obj_array.push(order_origin_address_obj);
    });
    
    // create destination address object
    let order_destination_address_obj_array = [];
    let order_destination_address_obj;
    let order_destination_address = shippingElement.find(".order-destination-address option");
    let order_destination_address_selected = shippingElement.find(".order-destination-address option:selected");
    $.each(order_destination_address, function(index,value) {
        order_destination_address_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == order_destination_address_selected.val() ? true : false
        }
        order_destination_address_obj_array.push(order_destination_address_obj);
    });
    
    // create freightage company object
    let freightage_information_obj_array = [];
    let freightage_information_obj;
    let freightage_information_dropdown = shippingElement.find(".freightage-information-dropdown option");
    let freightage_information_dropdown_selected = shippingElement.find(".freightage-information-dropdown option:selected");
    $.each(freightage_information_dropdown, function(index,value) {
        freightage_information_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_information_dropdown_selected.val() ? true : false
        }
        freightage_information_obj_array.push(freightage_information_obj);
    });
    
    // create freightage activity field object
    let freightage_activity_field_obj_array = [];
    let freightage_activity_field_obj;
    let freightage_activity_field_dropdown = shippingElement.find(".freightage-activity-field-dropdown option");
    let freightage_activity_field_dropdown_selected = shippingElement.find(".freightage-activity-field-dropdown option:selected");
    $.each(freightage_activity_field_dropdown, function(index,value) {
        freightage_activity_field_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_activity_field_dropdown_selected.val() ? true : false
        }
        freightage_activity_field_obj_array.push(freightage_activity_field_obj);
    });
    
    // create freightage loader type object
    let freightage_loader_type_obj_array = [];
    let freightage_loader_type_obj;
    let freightage_loader_type_dropdown = shippingElement.find(".freightage-loader-type-dropdown option");
    let freightage_loader_type_dropdown_selected = shippingElement.find(".freightage-loader-type-dropdown option:selected");
    $.each(freightage_loader_type_dropdown, function(index,value) {
        freightage_loader_type_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_loader_type_dropdown_selected.val() ? true : false
        }
        freightage_loader_type_obj_array.push(freightage_loader_type_obj);
    });
    
    // create deliver date object
    let deliver_date_input = shippingElement.find(".deliver-date-input").val();
    
    // get origin address html
    let order_origin_address_html = shippingElement.find(".order-origin-address-html").html();
    
    // get destination address html
    let order_destination_address_html = shippingElement.find(".order-destination-address-html").html();
    
    // get shipping calculated distance
    let shipping_distance_text = shippingElement.find(".shipping-distance-text").html();
    
    // get shipping calculated price
    let shipping_price_text = shippingElement.find(".shipping-price-text").html();

    // get neshan arc image
    let neshan_arc_image_src = $(".shipping-page-map-div img").attr("src");

    // create row object
    let shipping_row_object = {
        order_origin_address_obj_array,
        order_destination_address_obj_array,
        freightage_information_obj_array,
        freightage_activity_field_obj_array,
        freightage_loader_type_obj_array,
        deliver_date_input,
        order_origin_address_html,
        order_destination_address_html,
        shipping_distance_text,
        shipping_price_text,
        neshan_arc_image_src
    }
    
    let shipping_row_object_json = JSON.stringify(shipping_row_object);

    let tableBody = `
        <div class="col-md-12 pt-5 pb-5">
            <table class="display yelsuDataTables" style="width:100%">
                <thead>
                    <tr>
                        <th class="all text-center">ردیف</th>
                        <th class="text-center">مبدا</th>
                        <th class="text-center">مقصد</th>
                        <th class="text-center">باربری</th>
                        <th class="text-center">نوع بارگیر</th>
                        <th class="text-center">مقدار</th>
                        <th class="text-center">تاریخ</th>
                        <th class="text-center">وضعیت</th>
                        <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="برای رونوشت ردیف مورد نظر، ابتدا تعداد رونوشت را وارد سپس بر روی دکمه رونوشت کلیک کنید.">
                            رونوشت ردیف
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M12 17V11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#ffffff"></circle> </g></svg>
                        </th>
                        <th class="all text-center">ویرایش / حذف</th>
                        <th class="text-center">اطلاعات بیشتر</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>${order_origin_address_selected.html()}</td>
                        <td>${order_destination_address_selected.html()}</td>
                        <td>${freightage_information_dropdown_selected.html()}</td>
                        <td>${freightage_activity_field_dropdown_selected.html()}</td>
                        <td>${freightage_loader_type_dropdown_selected.html()}</td>
                        <td>${deliver_date_input}</td>
                        <td>
                            پرداخت شده و در حال ارسال
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="input-group" style="width: 130px;">
                                    <input name="quantity" class="quantity form-control" type="number" min="1" max="10000000" value="1">
                                    <button type="button" class="quantity-plus w-icon-plus"></button>
                                    <button type="button" class="quantity-minus w-icon-minus"></button>
                                </div>
                                <button type="button" class="btn btn-dark btn-ellipse btn-sm ml-1" data-bs-toggle="tooltip" data-bs-placement="top" title="رونوشت">
                                    <svg width="42px" height="42px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M18.5703 22H14.0003C11.7103 22 10.5703 20.86 10.5703 18.57V11.43C10.5703 9.14 11.7103 8 14.0003 8H18.5703C20.8603 8 22.0003 9.14 22.0003 11.43V18.57C22.0003 20.86 20.8603 22 18.5703 22Z" fill="#292D32"></path> <path d="M13.43 5.43V6.77C10.81 6.98 9.32 8.66 9.32 11.43V16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43Z" fill="#292D32"></path> <path d="M18.1291 14.2501H17.2491V13.3701C17.2491 12.9601 16.9091 12.6201 16.4991 12.6201C16.0891 12.6201 15.7491 12.9601 15.7491 13.3701V14.2501H14.8691C14.4591 14.2501 14.1191 14.5901 14.1191 15.0001C14.1191 15.4101 14.4591 15.7501 14.8691 15.7501H15.7491V16.6301C15.7491 17.0401 16.0891 17.3801 16.4991 17.3801C16.9091 17.3801 17.2491 17.0401 17.2491 16.6301V15.7501H18.1291C18.5391 15.7501 18.8791 15.4101 18.8791 15.0001C18.8791 14.5901 18.5391 14.2501 18.1291 14.2501Z" fill="#292D32"></path> </g></svg>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" value='${shipping_row_object_json}' class="shipping-row-object-json">
                                <button type="button" class="btn btn-dark btn-ellipse btn-sm d-flex align-items-center row-edit-btn">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
                                    ویرایش
                                </button>
                                <button type="button" class="btn btn-warning btn-ellipse btn-sm d-flex align-items-center ml-2">
                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    حذف
                                </button>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>`;

    let schedule_element = shippingElement.find(".shipping-schedule input");
    let number_items_request = shippingElement.find(".number-items-request input");

    if(
        schedule_element.val() 
    && number_items_request.val()
    && number_items_request.val() > 10
    && number_items_request.val() < 1000
) {
        table_body_elements.append(tableBody);
        resetAllForm();
    }

    startDataTables();
});


// duplication input function
$("#table-body").on("click", ".quantity-plus", function(){
    let quantityInput = $(this).closest(".input-group").find(".quantity");
    let addedValue = parseInt(quantityInput.val()) + 1;
    quantityInput.val(addedValue);
});
$("#table-body").on("click", ".quantity-minus", function(){
    let decreasedValue = 1;
    let quantityInput = $(this).closest(".input-group").find(".quantity");
    if(quantityInput.val() > 1) {
        decreasedValue =  parseInt(quantityInput.val()) - 1;
    } 
    quantityInput.val(decreasedValue);
});

$(".shipping").on("click", ".row-edit-btn", function(){
    let thisElement = $(this);
    let shipping_element = $(".shipping-element");
    let inputElmentValue = thisElement.prev(".shipping-row-object-json").val();
    let inputElmentValueObj = JSON.parse(inputElmentValue);

    // set origin address dropdown html
    setOriginAddressHTML(inputElmentValueObj,shipping_element);

    // set destination address dropdown html
    setDestinationAddressHTML(inputElmentValueObj,shipping_element);

    // set freightage information dropdown html
    freightageInformationDropdownHTML(inputElmentValueObj,shipping_element)

    // set freightage activity field dropdown html
    freightageActivityFieldDropdownHTML(inputElmentValueObj,shipping_element)

    // set freightage company loader type
    freightageCompanyLoaderTypeDropdownHTML(inputElmentValueObj,shipping_element)

    // set image when edit btn is clicked
    setBackImageFromRow(inputElmentValueObj,shipping_element)

    // show edit button
    showEditBtn(inputElmentValueObj,shipping_element);

    console.log(inputElmentValueObj);
});

function setBackImageFromRow(inputElmentValueObj,shipping_element) {
    // removing dynamic map element after getting arc image
    let shipping_page_map_container_element = shipping_element.find(".shipping-page-map-container");
    shipping_page_map_container_element.hide();

    // removing previous arc image to avoid image duplication and set a new image
    shipping_element.find("img.shipping-page-map-container-img").remove();

    let shipping_page_map_div_element = shipping_element.find(".shipping-page-map-div");
    let image_arc_src = inputElmentValueObj.neshan_arc_image_src;
    let image = $(`<img src="${image_arc_src}" class="shipping-page-map-container-img">`);
    shipping_page_map_div_element.prepend(image);
}

function setOriginAddressHTML(inputElmentValueObj,shipping_element) {
    // set html
    let order_origin_address_html = inputElmentValueObj.order_origin_address_html;
    let order_origin_address_html_element = shipping_element.find(".order-origin-address-html");
    order_origin_address_html_element.empty();
    order_origin_address_html_element.append(order_origin_address_html);

    // set dropdown element
    let order_origin_address_obj_array = inputElmentValueObj.order_origin_address_obj_array;
    let select_element = shipping_element.find(".vendor-address-information");
    select_element.empty();

    let optionElement = "";
    let selected = "";
    $.each(order_origin_address_obj_array,function(key,value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });
    select_element.append(optionElement);
}

function setDestinationAddressHTML(inputElmentValueObj,shipping_element) {
    // set html
    let order_destination_address_html = inputElmentValueObj.order_destination_address_html;
    let order_destination_address_html_element = shipping_element.find(".order-destination-address-html");
    order_destination_address_html_element.empty();
    order_destination_address_html_element.append(order_destination_address_html);

    // set dropdown element
    let order_destination_address_obj_array = inputElmentValueObj.order_destination_address_obj_array;
    let select_element = shipping_element.find(".user-address-information");
    select_element.empty();

    let optionElement = "";
    let selected = "";
    $.each(order_destination_address_obj_array,function(key,value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });
    select_element.append(optionElement);
}

function freightageInformationDropdownHTML(inputElmentValueObj,shipping_element) {
    // set dropdown element
    let freightage_information_obj_array = inputElmentValueObj.freightage_information_obj_array;
    let select_element = shipping_element.find(".freightage-information-dropdown");
    select_element.empty();

    let optionElement = "";
    let selected = "";
    $.each(freightage_information_obj_array,function(key,value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });
    select_element.append(optionElement);
}

function freightageActivityFieldDropdownHTML(inputElmentValueObj,shipping_element) {
    // set dropdown element
    let freightage_activity_field_obj_array = inputElmentValueObj.freightage_activity_field_obj_array;
    let freightage_company_name_element = shipping_element.find(".freightage-company-name");

    // get freightage_id
    let freightage_id = getSelectedFreightageId(inputElmentValueObj);
    
    // create option element
    let optionElement = "";
    let selected = "";
    $.each(freightage_activity_field_obj_array,function(key,value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });

    let html = 
    `<div class="form-group freightage-company-activity-field" style="margin-top:56px;">
        <label>روش ارسال کالا</label>
        <input type="hidden" value="${freightage_id}" class="freightage_id">
        <div>
            <select class="form-control form-control-md freightage-activity-field-dropdown">
                ${optionElement}
            </select>
        </div>
    </div>`;

    $(document).ready(function() {
        $('.freightage-activity-field-dropdown').select2({
            placeholder: 'روش ارسال را انتخاب نمایید'
        });
    });

    freightage_company_name_element.find('.freightage-company-activity-field').remove();
    freightage_company_name_element.append(html);
}

// function to get selected freightage id
function getSelectedFreightageId(inputElmentValueObj) {
    let freightage_id;
    let freightage_information_obj_array = inputElmentValueObj.freightage_information_obj_array;
    $.each(freightage_information_obj_array, function(key,value) {
        if(value.selected == true) {
            freightage_id = value.id;
        }
    });
    return freightage_id;
}

function freightageCompanyLoaderTypeDropdownHTML(inputElmentValueObj,shipping_element) {
    // set dropdown element
    let freightage_loader_type_obj_array = inputElmentValueObj.freightage_loader_type_obj_array;
    let freightage_company_name_element = shipping_element.find(".freightage-company-name");

    // create option element
    let optionElement = "";
    let selected = "";
    $.each(freightage_loader_type_obj_array,function(key,value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });

    let html = 
    `<div class="form-group freightage-company-loader-type mt-8">
        <label>انتخاب نوع بارگیر</label>
        <div>
            <select class="form-control form-control-md freightage-loader-type-dropdown">
                ${optionElement}
            </select>
        </div>
    </div>`;

    $(document).ready(function() {
        $('.freightage-loader-type-dropdown').select2({
            placeholder: 'نوع بارگیر را انتخاب نمایید',
            dir: "rtl",
        });
    });

    freightage_company_name_element.find('.freightage-company-loader-type').remove();
    freightage_company_name_element.append(html);
}

function showEditBtn(inputElmentValueObj,shipping_element) {
    let shippingCalcElement = shipping_element.find(".shipping-calculate-btn");
    shippingCalcElement.addClass("d-none");
    shippingCalcElement.removeClass("d-flex");
    
    // show price calculation
    let shippingCalculationElement = shipping_element.find(".shipping-calculations");
    shippingCalculationElement.removeClass("d-none");

    // insert calculated shipping price
    let shippingPriceText = shipping_element.find(".shipping-price-text");
    shippingPriceText.html(inputElmentValueObj.shipping_price_text);

    // show confirm btn
    let shippingCalcConfirmBtn = shipping_element.find(".shipping-calc-confirm-btn");
    shippingCalcConfirmBtn.removeClass("d-none");
    shippingCalcConfirmBtn.addClass("d-flex");

    // show cancel btn
    let shippingCalcCancelBtn = shipping_element.find(".shipping-calc-cancel-btn");
    shippingCalcCancelBtn.removeClass("d-none");
    shippingCalcCancelBtn.addClass("d-flex");
}

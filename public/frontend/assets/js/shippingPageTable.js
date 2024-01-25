/**
 * Initialize DataTables for elements with class 'yelsuDataTables'
 * @returns {void}
 */
function startDataTables() {
    new DataTable('.yelsuDataTables', {
        responsive: true, // Enable responsive design
        searching: false, // Disable search feature
        "ordering": false, // Disable column ordering
        "dom": 'rt', // Set the order of DataTables elements
        columnDefs: [ {
            className: 'dtr-control', // Set class for responsive control column
            orderable: false, // Disable ordering for the control column
            targets: -1 // Apply to the last column
        }],
        responsive: {
            details: {
                type: 'column', // Set the type of details to display
                target: 'tr' // Apply to table rows
            }
        },
        "pageLength": -1 // Show all rows on a single page
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

    // Get the value of the element with the ID "loader_type_min" using jQuery and store it in the variable loader_type_min
    let loader_type_min = parseInt($("#loader_type_min").val());

    // Get the value of the element with the ID "loader_type_max" using jQuery and store it in the variable loader_type_max
    let loader_type_max = parseInt($("#loader_type_max").val());

    if(
        schedule_element.val() 
    && parseInt(number_items_request.val())
    && parseInt(number_items_request.val()) >= loader_type_min
    && parseInt(number_items_request.val()) <= loader_type_max
) {
        table_body_elements.append(tableBody);
        resetAllForm();
    }

    startDataTables();
});


// Attach a click event handler to the table-body element for any element with class quantity-plus
$("#table-body").on("click", ".quantity-plus", function(){
    // Find the closest element with class input-group and then find the element with class quantity within it
    let quantityInput = $(this).closest(".input-group").find(".quantity");
    // Increment the value of quantityInput by 1 and update the input value
    let addedValue = parseInt(quantityInput.val()) + 1;
    quantityInput.val(addedValue);
});

// Attach a click event handler to the table-body element for any element with class quantity-minus
$("#table-body").on("click", ".quantity-minus", function(){
    // Set the initial value of decreasedValue to 1
    let decreasedValue = 1;
    // Find the closest element with class input-group and then find the element with class quantity within it
    let quantityInput = $(this).closest(".input-group").find(".quantity");
    // Check if the value of quantityInput is greater than 1, if so, decrement the value by 1 and update the input value
    if(quantityInput.val() > 1) {
        decreasedValue =  parseInt(quantityInput.val()) - 1;
    } 
    quantityInput.val(decreasedValue);
});

// Event listener for shipping element click
$(".shipping").on("click", ".row-edit-btn", function(){
    // Get the clicked element
    let thisElement = $(this);
    // Get the shipping element
    let shipping_element = $(".shipping-element");
    // Get the value of the previous shipping-row-object-json element
    let inputElmentValue = thisElement.prev(".shipping-row-object-json").val();
    // Parse the input element value to an object
    let inputElmentValueObj = JSON.parse(inputElmentValue);

    // Set origin address dropdown HTML
    setOriginAddressHTML(inputElmentValueObj, shipping_element);

    // Set destination address dropdown HTML
    setDestinationAddressHTML(inputElmentValueObj, shipping_element);

    // Set freightage information dropdown HTML
    updateFreightageDropdown(inputElmentValueObj, shipping_element);

    // Set freightage activity field dropdown HTML
    generateFreightageActivityFieldDropdownHTML(inputElmentValueObj, shipping_element);

    // Set freightage company loader type
    loadFreightageLoaderTypeDropdown(inputElmentValueObj, shipping_element);

    // Set image when edit button is clicked
    setBackImageFromRow(inputElmentValueObj, shipping_element);

    // Show edit button
    updateShippingDetails(inputElmentValueObj, shipping_element);

    // Log the input element value object
    console.log(inputElmentValueObj);
});

/**
 * Set the background image from the input element's value object
 * @param {Object} inputElementValueObj - The input element's value object
 * @param {jQuery} shippingElement - The shipping element
 */
function setBackImageFromRow(inputElementValueObj, shippingElement) {
    // Hide the dynamic map container element
    let shippingPageMapContainerElement = shippingElement.find(".shipping-page-map-container");
    shippingPageMapContainerElement.hide();

    // Remove the previous arc image to avoid duplication and set a new image
    shippingElement.find("img.shipping-page-map-container-img").remove();

    // Get the map div element and set the new image
    let shippingPageMapDivElement = shippingElement.find(".shipping-page-map-div");
    let imageArcSrc = inputElementValueObj.neshan_arc_image_src;
    let image = $(`<img src="${imageArcSrc}" class="shipping-page-map-container-img">`);
    shippingPageMapDivElement.prepend(image);
}

/**
 * Set HTML and dropdown elements for order origin address
 * @param {object} inputElementValueObj - Object containing order origin address HTML and array
 * @param {jQuery} shippingElement - jQuery object representing the shipping element
 */
function setOriginAddressHTML(inputElementValueObj, shippingElement) {
    // Set HTML for order origin address
    const orderOriginAddressHtml = inputElementValueObj.order_origin_address_html;
    const orderOriginAddressHtmlElement = shippingElement.find(".order-origin-address-html");
    orderOriginAddressHtmlElement.empty();
    orderOriginAddressHtmlElement.append(orderOriginAddressHtml);

    // Set dropdown element for order origin address
    const orderOriginAddressObjArray = inputElementValueObj.order_origin_address_obj_array;
    const selectElement = shippingElement.find(".vendor-address-information");
    selectElement.empty();

    let optionElement = "";
    let selected = "";
    // Populate dropdown options
    $.each(orderOriginAddressObjArray, function(key, value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });
    selectElement.append(optionElement);
}

/**
 * Sets the destination address HTML and dropdown element for order destination address.
 * @param {Object} inputElmentValueObj - Object containing the HTML and options for the destination address
 * @param {jQuery} shipping_element - jQuery element representing the shipping container
 */
function setDestinationAddressHTML(inputElmentValueObj, shipping_element) {
    // Set HTML for order destination address
    const order_destination_address_html = inputElmentValueObj.order_destination_address_html;
    const order_destination_address_html_element = shipping_element.find(".order-destination-address-html");
    order_destination_address_html_element.empty();
    order_destination_address_html_element.append(order_destination_address_html);

    // Set dropdown element for order destination address
    const order_destination_address_obj_array = inputElmentValueObj.order_destination_address_obj_array;
    const select_element = shipping_element.find(".user-address-information");
    select_element.empty();

    let optionElement = "";
    let selected = "";
    // Iterate over order destination address object array to create dropdown options
    $.each(order_destination_address_obj_array, function (key, value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });
    select_element.append(optionElement);
}

/**
 * Update the dropdown with freightage information options
 * 
 * @param {object} inputElementValueObj - Object containing the freightage information options
 * @param {jQuery element} shippingElement - jQuery element where the dropdown will be updated
 */
function updateFreightageDropdown(inputElementValueObj, shippingElement) {
    // Get the array of freightage information objects
    let freightageInformationArray = inputElementValueObj.freightage_information_obj_array;

    // Find the select element within the shipping element and empty it
    let selectElement = shippingElement.find(".freightage-information-dropdown");
    selectElement.empty();

    // Generate the option elements based on the freightage information array
    let optionElements = "";
    let selected = "";
    $.each(freightageInformationArray, function(key, value) {
        selected = value.selected ? 'selected' : '';
        optionElements += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });

    // Append the generated option elements to the select element
    selectElement.append(optionElements);
}

/**
 * This function generates HTML for a dropdown field based on the inputObj values and appends it to the shipping element.
 * 
 * @param {object} inputElmentValueObj - Object containing values for dropdown generation
 * @param {jQuery} shipping_element - jQuery object representing the shipping element
 */
function generateFreightageActivityFieldDropdownHTML(inputElmentValueObj, shipping_element) {
    // Extract the freightage activity field array from the input object
    let freightage_activity_field_obj_array = inputElmentValueObj.freightage_activity_field_obj_array;
    
    // Find the company name element within the shipping element
    let freightage_company_name_element = shipping_element.find(".freightage-company-name");

    // Get the selected freightage ID
    let freightage_id = getSelectedFreightageId(inputElmentValueObj);
    
    // Generate options for the dropdown
    let optionElement = "";
    let selected = "";
    $.each(freightage_activity_field_obj_array, function(key, value) {
        selected = value.selected ? 'selected' : '';
        optionElement += `
            <option ${selected} value="${value.id}">
                ${value.value}
            </option>
        `;
    });

    // Generate the HTML for the dropdown and assign it to the 'html' variable
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

    // Initialize the select2 plugin for the dropdown
    $(function() {
        $('.freightage-activity-field-dropdown').select2({
            placeholder: 'روش ارسال را انتخاب نمایید'
        });
    });

    // Remove any existing freightage company activity field and append the new HTML to the company name element
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

/**
 * Generates and loads the HTML dropdown for the freightage loader types.
 * 
 * @param {Object} inputElementValueObj - The input element value object
 * @param {jQuery} shippingElement - The jQuery element for the shipping container
 */
function loadFreightageLoaderTypeDropdown(inputElementValueObj, shippingElement) {
    // Extract freightage loader type objects array and company name element
    const freightageLoaderTypeObjArray = inputElementValueObj.freightage_loader_type_obj_array;
    const freightageCompanyNameElement = shippingElement.find(".freightage-company-name");
    
    // Generate option elements for the dropdown
    let optionElement = "";
    let selected = "";
    freightageLoaderTypeObjArray.forEach((value) => {
        selected = value.selected ? 'selected' : '';
        optionElement += `<option ${selected} value="${value.id}">${value.value}</option>`;
    });

    // Generate HTML for the dropdown and append it to the company name element
    const html = `
        <div class="form-group freightage-company-loader-type mt-8">
            <label>انتخاب نوع بارگیر</label>
            <div>
                <select class="form-control form-control-md freightage-loader-type-dropdown">
                    ${optionElement}
                </select>
            </div>
        </div>`;
    freightageCompanyNameElement.find('.freightage-company-loader-type').remove();
    freightageCompanyNameElement.append(html);

    // Initialize the select2 plugin for the dropdown
    $(function() {
        $('.freightage-loader-type-dropdown').select2({
            placeholder: 'نوع بارگیر را انتخاب نمایید',
            dir: "rtl",
        });
    });
}

/**
 * Update the shipping element to show the calculated shipping details and buttons
 * @param {Object} inputElementValueObj - Object containing the shipping price text
 * @param {jQuery} shippingElement - jQuery element representing the shipping container
 */
function updateShippingDetails(inputElementValueObj, shippingElement) {
    // Hide the shipping calculate button
    const shippingCalcElement = shippingElement.find(".shipping-calculate-btn");
    shippingCalcElement.addClass("d-none").removeClass("d-flex");

    // Show the shipping calculations
    const shippingCalculationElement = shippingElement.find(".shipping-calculations");
    shippingCalculationElement.removeClass("d-none");

    // Insert the calculated shipping price
    const shippingPriceText = shippingElement.find(".shipping-price-text");
    shippingPriceText.html(inputElementValueObj.shipping_price_text);

    // Show the confirm button
    const shippingCalcConfirmBtn = shippingElement.find(".shipping-calc-confirm-btn");
    shippingCalcConfirmBtn.removeClass("d-none").addClass("d-flex");

    // Show the cancel button
    const shippingCalcCancelBtn = shippingElement.find(".shipping-calc-cancel-btn");
    shippingCalcCancelBtn.removeClass("d-none").addClass("d-flex");
}

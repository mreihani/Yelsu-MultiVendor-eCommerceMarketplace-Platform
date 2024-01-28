window.selectedElementRequestInput = 0;

// Event listener for shipping element click
$(".shipping").on("click", ".row-edit-btn", function(){

    // Get the clicked element
    let thisElement = $(this);

    // Get the selected row id
    selectedRowId = thisElement.closest("tr").find(".shipping-row").html();

    // Get the shipping element
    let shipping_element = $(".shipping-element");

    // Get the value of the previous shipping-row-object-json element
    let inputElmentValue = thisElement.prev(".shipping-row-object-json").val();

    // Parse the input element value to an object
    let inputElmentValueObj = JSON.parse(inputElmentValue);

    // Set the value of the input element and use it in shippingTableCrud file to calculate the remaining quantity
    selectedElementRequestInput = inputElmentValueObj.numberOfRequestInput;

    // Set origin address dropdown HTML
    setOriginAddressHTML(inputElmentValueObj, shipping_element);

    // Set destination address dropdown HTML
    setDestinationAddressHTML(inputElmentValueObj, shipping_element);

    // Set shipping distance
    setShippingDistanceHTML(inputElmentValueObj, shipping_element);

    // Set freightage information dropdown HTML
    updateFreightageDropdown(inputElmentValueObj, shipping_element);

    // Set freightage activity field dropdown HTML
    generateFreightageActivityFieldDropdownHTML(inputElmentValueObj, shipping_element);

    // Set freightage company loader type
    loadFreightageLoaderTypeDropdown(inputElmentValueObj, shipping_element);

    // Set image when edit button is clicked
    setBackImageFromRow(inputElmentValueObj, shipping_element);

    // Update the shipping element to show the calculated shipping details and buttons
    updateShippingDetails(inputElmentValueObj, shipping_element);

    // Set date
    setDate(inputElmentValueObj, shipping_element);

    // Set request input
    setRequestInputValue(inputElmentValueObj, shipping_element);
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
 * Sets the shipping distance HTML based on the input element value object.
 * 
 * @param {object} inputElementValueObj - The object containing input element values.
 * @param {HTMLElement} shippingElement - The HTML element to update with shipping distance.
 */
function setShippingDistanceHTML(inputElementValueObj, shippingElement) {

    // Add code here to set the shipping distance HTML based on the input element value object
    let shippingDistanceElment = `
    <div class="shipping-page-distance-box d-flex">
        <svg width="25px" height="25px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#9d9d9d" fill="none"><path d="M17.94,54.81a.1.1,0,0,1-.14,0c-1-1.11-11.69-13.23-11.69-21.26,0-9.94,6.5-12.24,11.76-12.24,4.84,0,11.06,2.6,11.06,12.24C28.93,41.84,18.87,53.72,17.94,54.81Z"></path><circle cx="17.52" cy="31.38" r="4.75"></circle><path d="M49.58,34.77a.11.11,0,0,1-.15,0c-.87-1-9.19-10.45-9.19-16.74,0-7.84,5.12-9.65,9.27-9.65,3.81,0,8.71,2,8.71,9.65C58.22,24.52,50.4,33.81,49.58,34.77Z"></path><circle cx="49.23" cy="17.32" r="3.75"></circle><path d="M17.87,54.89a28.73,28.73,0,0,0,3.9.89"></path><path d="M24.68,56.07c2.79.12,5.85-.28,7.9-2.08,5.8-5.09,2.89-11.25,6.75-14.71a16.72,16.72,0,0,1,4.93-3" stroke-dasharray="7.8 2.92"></path><path d="M45.63,35.8a23,23,0,0,1,3.88-.95"></path></svg>
        &nbsp;فاصله:&nbsp;<strong class="shipping-distance-text">${inputElementValueObj.shipping_distance_text}</strong>
    </div>`;

    // Append the shipping distance HTML
    let calculatedDistanceElement = shippingElement.find(".calculated-distance");
    calculatedDistanceElement.removeClass("d-none");
    calculatedDistanceElement.empty();
    calculatedDistanceElement.append(shippingDistanceElment);    
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

/**
 * Set the date value of an input element based on the value of a shipping element.
 * 
 * @param {Object} inputElementValueObj - The input element value object to update.
 * @param {Element} shippingElement - The shipping element to get the date value from.
 */
function setDate(inputElementValueObj, shippingElement) {

  // Get the date value from the shipping element
  let deliverDateInputValue = inputElementValueObj.deliverDateInputValue;
  
  // Set the date value of the input element
  $(".deliver-date-input").val(deliverDateInputValue);
}

/**
 * Set the value of the input element based on the provided object
 * @param {Object} inputElementValueObj - The object containing the input element values
 * @param {Element} shippingElement - The shipping element to set the value on
 */
function setRequestInputValue(inputElementValueObj, shippingElement) {
    
    // Set the value of the input element
    let numberOfRequestInput = inputElementValueObj.numberOfRequestInput;

    // Set the value of the input element
    $(".number-items-request input").val(numberOfRequestInput);
}

// send ajax to retrieve vendor address
$(".shipping-element").on("click", ".shipping-calculate-btn", function () {
    
    let thisElement = $(this);
    let vendor_address_information_element = thisElement.closest(".shipping-element").find(".vendor-address-information");
    let user_address_information_element = thisElement.closest(".shipping-element").find(".user-address-information");
    let shipping_element = vendor_address_information_element.closest(".shipping-element");
    let outlet_id = vendor_address_information_element.val();
    let user_outlet_id = shipping_element.find(".user-address-information :selected").val();

    enableOverlayVendor(thisElement);

    // get value of the first selected freightage loader type id
    let selected_loader_type_id = $(".freightage-company-loader-type").find("select option:selected").val();
    
    $.ajax({
        type: "GET",
        data:{
            outlet_id,
            user_outlet_id,
            selected_loader_type_id
        },
        url: "/get-users-address-shipping",
        success: function (response) {
            
            // removing dynamic map element after getting arc image
            let shipping_page_map_container_element = shipping_element.find(".shipping-page-map-container");
            shipping_page_map_container_element.hide();

            // removing previous arc image to avoid image duplication and set a new image
            shipping_element.find("img.shipping-page-map-container-img").remove();
            setArcImage(response, shipping_element);

            // update calculated address in shipping page
            let distanceObject = getDistanceObject(response);
            let calculated_distance_element = shipping_element.find(".calculated-distance");
            calculated_distance_element.html(setDistanceHTMLVendor(distanceObject));

            // update shipping calculations in shipping page
            let calculated_calculations_element = shipping_element.find(".shipping-calculations");
            calculated_calculations_element.html(setShippingCalculationsHTMLVendor(response));
            
            // update vendor address in shipping page
            let vendorAddressSpan = vendor_address_information_element.closest(".order-origin-address").find(".vendor-address");
            vendorAddressSpan.html(response.vendor_outlet.shop_address);

            // update user address in shipping page
            let userAddressSpan = user_address_information_element.closest(".order-destination-address").find(".user-address");
            userAddressSpan.html(response.user_outlet.address);

            disabledOverlayVendor(thisElement);
        },
    });
});

// function to set art image
function setArcImage(response, shipping_element) {
    let shipping_page_map_div_element = shipping_element.find(".shipping-page-map-div");
    let image_arc_src = response.image_arc_src;
    let image = $(`<img src="${image_arc_src}" class="shipping-page-map-container-img">`);
    shipping_page_map_div_element.prepend(image);
}

// function to get distance
function getDistanceObject(response) {
    let distanceObject = JSON.parse(response.neshan_response).rows[0].elements[0].distance;
    return distanceObject;
}

function enableOverlayVendor(thisElement) {
    let overlayElement = thisElement.closest(".shipping-element").find(".shipping-details-page-overlay");
    overlayElement.addClass("d-flex");
}

function disabledOverlayVendor(thisElement) {
    let overlayElement = thisElement.closest(".shipping-element").find(".shipping-details-page-overlay");
    overlayElement.removeClass("d-flex");
}

function setDistanceHTMLVendor(distanceObject) {
    let distanceHTML = 
    `
        <div class="shipping-page-distance-box">
        <svg width="25px" height="25px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#9d9d9d" fill="none"><path d="M17.94,54.81a.1.1,0,0,1-.14,0c-1-1.11-11.69-13.23-11.69-21.26,0-9.94,6.5-12.24,11.76-12.24,4.84,0,11.06,2.6,11.06,12.24C28.93,41.84,18.87,53.72,17.94,54.81Z"/><circle cx="17.52" cy="31.38" r="4.75"/><path d="M49.58,34.77a.11.11,0,0,1-.15,0c-.87-1-9.19-10.45-9.19-16.74,0-7.84,5.12-9.65,9.27-9.65,3.81,0,8.71,2,8.71,9.65C58.22,24.52,50.4,33.81,49.58,34.77Z"/><circle cx="49.23" cy="17.32" r="3.75"/><path d="M17.87,54.89a28.73,28.73,0,0,0,3.9.89"/><path d="M24.68,56.07c2.79.12,5.85-.28,7.9-2.08,5.8-5.09,2.89-11.25,6.75-14.71a16.72,16.72,0,0,1,4.93-3" stroke-dasharray="7.8 2.92"/><path d="M45.63,35.8a23,23,0,0,1,3.88-.95"/></svg>
            فاصله بین مبدا و مقصد: <strong>${distanceObject.text}</strong>
        </div>
    `;

    return distanceHTML;
}

function setShippingCalculationsHTMLVendor(response) {

    let currency = "";
    let currency_english = response.shipping_calculations.currency;

    if(currency_english == "toman") {
        currency = "تومان";
    } else if(currency_english == "dollar") {
        currency = "دلار";
    } else if(currency_english == "euro") {
        currency = "یورو";
    }

    let price = response.shipping_calculations.price;
    price = formatNumber(price);

    let distanceHTML = 
    `
        <div class="shipping-page-distance-box d-flex">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9d9d9d"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 14H17M14 10H17M9 9.5V8.5M9 9.5H11.0001M9 9.5C7.20116 9.49996 7.00185 9.93222 7.0001 10.8325C6.99834 11.7328 7.00009 12 9.00009 12C11.0001 12 11.0001 12.2055 11.0001 13.1667C11.0001 13.889 11.0001 14.5 9.00009 14.5M9.00009 14.5L9 15.5M9.00009 14.5H7.0001M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z" stroke="#9d9d9d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g>
            </svg>
            &nbsp;
            هزینه حمل: &nbsp;<strong>${price} ${currency}</strong>
        </div>
    `;

    return distanceHTML;
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


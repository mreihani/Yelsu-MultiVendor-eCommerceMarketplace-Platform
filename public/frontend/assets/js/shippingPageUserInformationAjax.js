// send ajax to retrieve user address
$(".shipping-element").on("click", ".shipping-calculate-btn", function () {

    let thisElement = $(this);
    let user_address_information_element = thisElement.closest(".shipping-element").find(".user-address-information");

    let shipping_element = user_address_information_element.closest(".shipping-element");
    let outlet_id = shipping_element.find(".vendor-address-information :selected").val();
    let user_outlet_id = user_address_information_element.val();
    
    enableOverlayUser(thisElement);

    $.ajax({
        type: "GET",
        data:{
            outlet_id,
            user_outlet_id
        },
        url: "/get-user-address",
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
            calculated_distance_element.html(setDistanceHTMLUser(distanceObject));
            
            // update address in shipping page
            let userAddressSpan = user_address_information_element.closest(".order-destination-address").find(".user-address");
            userAddressSpan.html(response.user_outlet.address);

            disabledOverlayUser(thisElement);
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

function enableOverlayUser(thisElement) {
    let overlayElement = thisElement.closest(".shipping-element").find(".shipping-details-page-overlay");
    overlayElement.addClass("d-flex");
}

function disabledOverlayUser(thisElement) {
    let overlayElement = thisElement.closest(".shipping-element").find(".shipping-details-page-overlay");
    overlayElement.removeClass("d-flex");
}

function setDistanceHTMLUser(distanceObject) {
    let distanceHTML = 
    `
        <div class="shipping-page-distance-box">
        <svg width="25px" height="25px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#9d9d9d" fill="none"><path d="M17.94,54.81a.1.1,0,0,1-.14,0c-1-1.11-11.69-13.23-11.69-21.26,0-9.94,6.5-12.24,11.76-12.24,4.84,0,11.06,2.6,11.06,12.24C28.93,41.84,18.87,53.72,17.94,54.81Z"/><circle cx="17.52" cy="31.38" r="4.75"/><path d="M49.58,34.77a.11.11,0,0,1-.15,0c-.87-1-9.19-10.45-9.19-16.74,0-7.84,5.12-9.65,9.27-9.65,3.81,0,8.71,2,8.71,9.65C58.22,24.52,50.4,33.81,49.58,34.77Z"/><circle cx="49.23" cy="17.32" r="3.75"/><path d="M17.87,54.89a28.73,28.73,0,0,0,3.9.89"/><path d="M24.68,56.07c2.79.12,5.85-.28,7.9-2.08,5.8-5.09,2.89-11.25,6.75-14.71a16.72,16.72,0,0,1,4.93-3" stroke-dasharray="7.8 2.92"/><path d="M45.63,35.8a23,23,0,0,1,3.88-.95"/></svg>
            فاصله بین مبدا و مقصد: <strong>${distanceObject.text}</strong>
        </div>
    `;

    return distanceHTML;
}
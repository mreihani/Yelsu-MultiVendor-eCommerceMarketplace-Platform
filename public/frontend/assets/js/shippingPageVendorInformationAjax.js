// send ajax to retrieve vendor address
$(".vendor-address-information").change(function () {
    let thisElement = $(this);

    let shipping_element = thisElement.closest(".shipping-element");
    let outlet_id = thisElement.val();
    let user_outlet_id = shipping_element.find(".user-address-information :selected").val();
    
    $.ajax({
        type: "GET",
        data:{
            outlet_id,
            user_outlet_id
        },
        url: "/get-vendor-address",
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
            calculated_distance_element.html(distanceObject.text);
            
            // update address in shipping page
            let vendorAddressSpan = thisElement.closest(".order-origin-address").find(".vendor-address");
            vendorAddressSpan.html(response.vendor_outlet.shop_address);
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
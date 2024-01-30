
// reset all form
function resetAllForm() {
    // let thisElem = $(this);
    let thisElem = $(".shipping-calc-cancel-btn");

    // hide cancel btn on click
    thisElem.addClass("d-none");
    thisElem.removeClass("d-flex");

    // مخفی کردن دکمه تایید و ذخیره
    let confBtn = thisElem.prev();
    confBtn.addClass("d-none");
    confBtn.removeClass("d-flex");

    let shippingElement = thisElem.closest(".shipping-element");
    
    // ریست کردن فیلد نام شرکت باربری
    let freightage_company_name_element = shippingElement.find(".freightage-company-name");
    freightage_company_name_element.find(".freightage-information-dropdown").val('0').change();

    // مخفی کردن روش ارسال کالا
    let freightage_company_activity_field = shippingElement.find(".freightage-company-activity-field");
    freightage_company_activity_field.addClass("d-none");

    // مخفی کردن انتخاب نوع بارگیر
    let freightage_company_loader_type = shippingElement.find(".freightage-company-loader-type");
    freightage_company_loader_type.addClass("d-none");

    // مخفی کردن باکس محاسبه فاصله حمل
    let calculated_distance = shippingElement.find(".calculated-distance");
    calculated_distance.addClass("d-none");

    // نمایش مجدد نقشه OSM
    let shipping_page_map_container_element = shippingElement.find(".shipping-page-map-container");
    shipping_page_map_container_element.show();

    // مخفی کردن تصویر ARC
    shippingElement.find("img.shipping-page-map-container-img").remove();

    // پاک کردن انتخاب تاریخ تحویل
    $(".deliver-date-input").val("");

    // پاک کردن فیلد درخواست 
    $(".number-items-request input").val("");
}
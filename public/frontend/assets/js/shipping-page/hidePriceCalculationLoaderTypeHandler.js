// Hide shipping page distance box element when freightage-company-loader-type is changed
$(".freightage-company-name").on("change", ".freightage-company-loader-type", function () {
    const shippingPageDistanceElement = $(".shipping-page-distance-box");
    shippingPageDistanceElement.removeClass("d-flex").addClass("d-none");
});
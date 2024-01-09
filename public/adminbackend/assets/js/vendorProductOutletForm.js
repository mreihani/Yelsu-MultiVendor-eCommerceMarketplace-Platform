$("#product-outlet-body").on("click", ".product_outlet_checkbox", function() {
    let thisElem = $(this);
    let outlet_address_text_elem = thisElem.closest(".outlet-row").find(".outlet-address");
    let disabled_input_elem = thisElem.closest(".outlet-row").find(".product_outlet_selling_price");

    if(this.checked) {
        outlet_address_text_elem.removeClass("text-muted");
        disabled_input_elem.attr("disabled", false);
    } else {
        outlet_address_text_elem.addClass("text-muted");
        disabled_input_elem.attr("disabled", true);
    }

});
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
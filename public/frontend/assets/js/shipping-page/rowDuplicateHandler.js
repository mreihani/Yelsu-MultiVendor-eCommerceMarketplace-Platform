// duplicate a row in table when duplicate btn is clicked
$(".shipping").on("click", ".row-duplicate-btn", function(){

    // Get the clicked element
    let thisElement = $(this);

    // Get the selected row element
    selectedRowElementDuplicated = thisElement.closest("tr");

    // Get quantity value
    let quantity = parseInt(selectedRowElementDuplicated.find(".quantity").val());

    // Calculate remaining quantity
    let shippingRowElement = selectedRowElementDuplicated.find(".shipping-row-object-json").val();
    let shippingRowObject = JSON.parse(shippingRowElement);
    let calculatedRemainingQuantity = calculateRemainingQuantity(shippingRowObject.numberOfRequestInput * quantity);

    // check if remaining quantity is not greater than 0
    if(!calculatedRemainingQuantity) {
        return;
    }

    // Clone the selected row according to quantity
    for (let index = 0; index < quantity; index++) {

        // Clone the selected row
        let clonedRow = selectedRowElementDuplicated.clone();

        // Set the row quantity to 1
        clonedRow.find(".quantity").val(1);

        // Insert the cloned row after the selected row
        clonedRow.insertAfter(selectedRowElementDuplicated);
    }

    // Get the parent tbody element
    let tbodyElement = thisElement.closest("tbody");

    // reset classes
    resetRowClasses(tbodyElement);

    // reset row numbers
    resetRowNumber(tbodyElement);
});

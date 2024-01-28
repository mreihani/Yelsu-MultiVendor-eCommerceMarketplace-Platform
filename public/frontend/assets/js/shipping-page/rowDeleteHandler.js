// delete a row in table when delete btn is clicked
$(".shipping").on("click", ".row-delete-btn", function(){

    // Get the clicked element
    let thisElement = $(this);

    // Get the selected row element
    selectedRowId = thisElement.closest("tr");

    // Get the parent tbody element
    let tbodyElement = thisElement.closest("tbody");

    // calculate remaining quantity
    let shippingRowElement = selectedRowId.find(".shipping-row-object-json").val();
    let shippingRowObject = JSON.parse(shippingRowElement);

    // Confirmation
    if(confirm('آیا برای انجام این کار اطمینان دارید؟')) {
        calculateRemainingQuantity(-shippingRowObject.numberOfRequestInput);

        // Remove the selected row
        selectedRowId.remove();

        // reset classes
        resetRowClasses(tbodyElement);

        // reset row numbers
        resetRowNumber(tbodyElement);

        // set null to rowId global variable
        selectedRowId = null;
    }
});



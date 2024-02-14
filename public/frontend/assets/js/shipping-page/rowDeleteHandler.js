// delete a row in table when delete btn is clicked
$(".shipping").on("click", ".row-delete-btn", function(){

    // Get the clicked element
    let thisElement = $(this);

    // Get the selected row element
    selectedRowElement = thisElement.closest("tr");

    // Get the parent tbody element
    let tbodyElement = thisElement.closest("tbody");

    // calculate remaining quantity
    let shippingRowElement = selectedRowElement.find(".shipping-row-object-json").val();
    let shippingRowObject = JSON.parse(shippingRowElement);

    // Confirmation
    if(confirm('آیا برای انجام این کار اطمینان دارید؟')) {
        calculateRemainingQuantity(-shippingRowObject.numberOfRequestInput);

        // Delete the row from database
        let selectedRowIdFromCurrentElement = parseInt(selectedRowElement.find(".shipping-row").html());
        deleteRowAjax(selectedRowIdFromCurrentElement);

        // Remove the selected row
        selectedRowElement.remove();

        // reset classes
        resetRowClasses(tbodyElement);

        // reset row numbers
        resetRowNumber(tbodyElement);

        // set null to rowId global variable
        selectedRowId = null;
    }
});



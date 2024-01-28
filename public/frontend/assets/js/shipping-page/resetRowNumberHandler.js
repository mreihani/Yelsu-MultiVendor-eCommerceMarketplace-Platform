/**
 * Reset the row numbers deleting a row
 * @param {HTMLElement} tbodyElement - The element that triggered the row deletion
 */
function resetRowNumber(tbodyElement) {
    
    // Get all row elements in the tbody
    let tbodyElementRowElements = tbodyElement.find("tr");

    // If there are rows, update row numbers and classes
    if (tbodyElementRowElements.length > 0) {
        // Update row numbers and odd/even classes
        $.each(tbodyElementRowElements, function(index, element) {
            $(element).find(".shipping-row").html(index + 1);
        });
    }
}
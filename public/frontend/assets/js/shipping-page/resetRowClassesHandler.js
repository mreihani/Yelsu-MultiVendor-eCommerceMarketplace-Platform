/**
 * Reset the row classes after deleting a row
 * @param {HTMLElement} tbodyElement - The element that triggered the row deletion
 */
function resetRowClasses(tbodyElement) {
    
    // Get all row elements in the tbody
    let tbodyElementRowElements = tbodyElement.find("tr");

    // If there are rows, update row numbers and classes
    if (tbodyElementRowElements.length > 0) {
        // Update row numbers and odd/even classes
        $.each(tbodyElementRowElements, function(index, element) {
            if (index % 2 === 0) {
                $(element).removeAttr("class").addClass("odd");
            } else {
                $(element).removeAttr("class").addClass("even");
            }
        });
    }
}
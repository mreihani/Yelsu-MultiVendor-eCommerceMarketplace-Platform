/**
 * Calculates the remaining quantity based on the number of requests.
 * @param {number} numberOfRequests - The number of requests.
 */
function calculateRemainingQuantity(numberOfRequests) {
    // Get remaining quantity input element
    let remainingQuantityInput = $(".remaining-quantity-input");

    // Calculate remaining quantity
    let remainingQuantityValue = remainingQuantityInput.val() - numberOfRequests;

    if(remainingQuantityValue < 0) {

        // Add number-items-greater-than-remaining-alert
        $("#number-items-greater-than-remaining-alert").removeClass("d-none");

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");
        
        return false;
    }

    // Set remaining quantity value to HTML
    $(".remaining-quantity").html(formatNumber(remainingQuantityValue));

    // Set remaining quantity value to input
    remainingQuantityInput.val(remainingQuantityValue);

    // Remove number-items-greater-than-remaining-alert
    $("#number-items-greater-than-remaining-alert").addClass("d-none");

    return true;
}


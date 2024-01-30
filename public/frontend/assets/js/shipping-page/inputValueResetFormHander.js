let numberItemsRequestElement = $(".number-items-request input");
let intervalValue;

$(".shipping-page-content").on("keyup", numberItemsRequestElement, function () {
   // Reset all the control panel forms
   resetAllControlPanelForms();

   // Disabled all the control panel select elements
   disableControlPanelSelectElements();

   // show click request btn alert
   $(".request-btn-show-all-forms").removeClass("d-none");
});


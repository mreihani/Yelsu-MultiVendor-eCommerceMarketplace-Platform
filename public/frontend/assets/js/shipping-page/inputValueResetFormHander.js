let numberItemsRequestElement = $(".number-items-request input");
let intervalValue;

$(".shipping-page-content").on("keyup", numberItemsRequestElement, function (e) {
   var key = e.which;
   if(key != 13)  // the enter key code
   {
      $// Reset all the control panel forms
      resetAllControlPanelForms();

      // Disabled all the control panel select elements
      disableControlPanelSelectElements();

      // show click request btn alert
      $(".request-btn-show-all-forms").removeClass("d-none");
   }
});


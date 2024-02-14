let requestInputElement = $(".number-items-request input");
requestInputElement.keypress(function (e) {
var key = e.which;
    if(key == 13)  // the enter key code
    {
        $('.shipping-panel-btn').trigger('click');
    }
});
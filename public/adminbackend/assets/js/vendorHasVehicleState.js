
let transportation_section = $("#transportation_section");
let userHasVehicle = $("#userHasVehicle");
let yelsu_freightage = $("#yelsu_freightage");

transportation_section.on("change", userHasVehicle, function(e) {
    let checkedStatus = e.target.checked;
    
    if(checkedStatus) {
        yelsu_freightage.slideUp();
    } else {
        yelsu_freightage.slideDown();
    }
});

$(document).ready(function(){
    let checkedStatus = userHasVehicle.is(':checked');

    if(checkedStatus) {
        yelsu_freightage.hide();
    } else {
        yelsu_freightage.show();
    }
});
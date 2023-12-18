$(document).ready(function(){
    let lastChildIsChecked = $("#lastChild").is(":checked");

    if(lastChildIsChecked) {
        $(".last-child").removeClass("d-none");
    } else {
        $(".last-child").addClass("d-none");
    }
});

$("#kt_app_content_container").on("change", "#lastChild", function(){
    let thisElement = this;

    if(thisElement.checked) {
        $(".last-child").removeClass("d-none");
    } else {
        $(".last-child").addClass("d-none");
    }
});



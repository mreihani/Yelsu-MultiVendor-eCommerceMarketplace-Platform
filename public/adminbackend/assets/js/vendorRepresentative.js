// start select2 countries dropdown
$(document).ready(function() {
    $('.export-countries-dropdown').select2();
});

// repeater form function
$('.repeater-body').on('click', '.add-repeater-btn', function(e) {
    e.preventDefault();
    
    $this = $(this);

    $repeater = $this.closest(".repeater-body").find('[data-repeatable]').last();
    $clone = $repeater.first().clone();

    $clone.find(".ir-city").html("");
    
    $clone.insertAfter($repeater);
});

$(".repeater").click(function(e) {
    if($(e.target).hasClass("del-repeater-btn") && $(e.target).closest(".repeater-body").find($("[data-repeatable]")).length > 1) {
        $(e.target).closest('[data-repeatable]').remove();
    }
});

// product specific geolocation checkbox function
$("#product_specific_geolocation").on('click', $("#product_specific_geolocation"), (function(e){
    let product_specific_geolocation_body = $(".product_specific_geolocation_body");
   
    if(e.target.checked) {
        product_specific_geolocation_body.slideDown();
    } else {
        product_specific_geolocation_body.slideUp();
    }
}));


// person type     
let person_type = null;
if(person_type == null) {
    $(".hoghoghi").hide();
} else if(person_type == 'haghighi') {
    $(".hoghoghi").hide();
} else if(person_type == 'hoghoghi') {
    $(".haghighi").hide();
}

$("#person").on("change", function () {
    if (this.value == "hoghoghi") {
        $(".haghighi").hide();
        $(".hoghoghi").show();
    } else if ("haghighi") {
        $(".haghighi").show();
        $(".hoghoghi").hide();
    }
});
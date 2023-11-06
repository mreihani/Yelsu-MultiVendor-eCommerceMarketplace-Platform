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
$(".repeater-product").click(function(e) {
    if($(e.target).hasClass("del-repeater-btn") && $(e.target).closest(".repeater-body").find($("[data-repeatable]")).length > 1) {
        $(e.target).closest('[data-repeatable]').remove();
    }
});

// specific geolocation checkbox function
$("#specific_geolocation_internal").on('click', $("#specific_geolocation_internal"), (function(e){
    let specific_geolocation_internal_body = $(".specific_geolocation_internal_body");
   
    if(e.target.checked) {
        specific_geolocation_internal_body.slideDown();
    } else {
        specific_geolocation_internal_body.slideUp();
    }
}));
$("#specific_geolocation_external").on('click', $("#specific_geolocation_external"), (function(e){
    let specific_geolocation_external_body = $(".specific_geolocation_external_body");
   
    if(e.target.checked) {
        specific_geolocation_external_body.slideDown();
    } else {
        specific_geolocation_external_body.slideUp();
    }
}));

// product specific geolocation checkbox function
$("#product_specific_geolocation_internal").on('click', $("#product_specific_geolocation_internal"), (function(e){
    let product_specific_geolocation_internal_body = $(".product_specific_geolocation_internal_body");
   
    if(e.target.checked) {
        product_specific_geolocation_internal_body.slideDown();
    } else {
        product_specific_geolocation_internal_body.slideUp();
    }
}));
$("#product_specific_geolocation_external").on('click', $("#product_specific_geolocation_external"), (function(e){
    let product_specific_geolocation_external_body = $(".product_specific_geolocation_external_body");
   
    if(e.target.checked) {
        product_specific_geolocation_external_body.slideDown();
    } else {
        product_specific_geolocation_external_body.slideUp();
    }
}));


// person type     
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
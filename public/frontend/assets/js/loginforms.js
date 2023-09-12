$(document).on("click", "#check-customer", function () {
    $("#check-customer").addClass("active");

    $("#check-seller").removeClass("active");
    $("#check-merchant").removeClass("active");
    $("#check-retailer").removeClass("active");
    $("#check-freightage").removeClass("active");
    $("#check-driver").removeClass("active");

    $("#shop_address").slideUp();
});

$(document).on("click", "#check-seller", function () {
    $("#check-seller").addClass("active");

    $("#check-customer").removeClass("active");
    $("#check-merchant").removeClass("active");
    $("#check-retailer").removeClass("active");
    $("#check-freightage").removeClass("active");
    $("#check-driver").removeClass("active");

    $("#shop_address").slideDown();
});

$(document).on("click", "#check-merchant", function () {
    $("#check-merchant").addClass("active");

    $("#check-seller").removeClass("active");
    $("#check-customer").removeClass("active");
    $("#check-retailer").removeClass("active");
    $("#check-freightage").removeClass("active");
    $("#check-driver").removeClass("active");

    $(".login-vendor").slideUp();
    $("#shop_address").slideDown();
});

$(document).on("click", "#check-retailer", function () {
    $("#check-retailer").addClass("active");

    $("#check-seller").removeClass("active");
    $("#check-customer").removeClass("active");
    $("#check-merchant").removeClass("active");
    $("#check-freightage").removeClass("active");
    $("#check-driver").removeClass("active");

    $(".login-vendor").slideDown();
    $("#shop_address").slideDown();
});

$(document).on("click", "#check-freightage", function () {
    $("#check-freightage").addClass("active");

    $("#check-seller").removeClass("active");
    $("#check-merchant").removeClass("active");
    $("#check-retailer").removeClass("active");
    $("#check-customer").removeClass("active");
    $("#check-driver").removeClass("active");

    $(".login-vendor").slideDown();
    $("#shop_address").slideDown();
});

$(document).on("click", "#check-driver", function () {
    $("#check-driver").addClass("active");

    $("#check-seller").removeClass("active");
    $("#check-merchant").removeClass("active");
    $("#check-retailer").removeClass("active");
    $("#check-customer").removeClass("active");
    $("#check-freightage").removeClass("active");

    $("#shop_address").slideDown();
});

// recaptcha reload ajax function
$(".reload").click(function () {
    $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: function (data) {
            $(".captcha").html(data.captcha);
        },
    });
});

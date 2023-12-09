// send ajax to retrieve freightage company information
$(".freightage-information-dropdown").change(function () {
    let thisElement = $(this);
    let freightage_id = thisElement.val();
    
    $.ajax({
        type: "GET",
        data:{
            freightage_id,
        },
        url: "/get-freightage-information",
        success: function (response) {
            console.log(response);
           
        },
    });
});


let descriptionBody = $("#category_description_full p");
let category_description_full_btn = $("#category_description_full_btn");
let category_description_short_btn = $("#category_description_short_btn");

if (descriptionBody.length > 3) {
    descriptionBody.each(function (index, element) {
        if (index > 3) {
            $(this).toggle();
        }
    });
    category_description_full_btn.show();
}
category_description_full_btn.click(function () {
    descriptionBody.each(function (index, element) {
        $(this).show();
    });
    category_description_full_btn.hide();
    category_description_short_btn.show();
});
category_description_short_btn.click(function () {
    descriptionBody.each(function (index, element) {
        if (index > 3) {
            $(this).toggle([0]);
        }
    });
    category_description_full_btn.show();
    category_description_short_btn.hide();
});

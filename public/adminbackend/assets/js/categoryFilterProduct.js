$(document).on("click", ".filterButtonShopPage", function (e) {
    $(e.target).next("div").toggle();

    $(e.target).find("i.fa-plus").toggle();
    $(e.target).find("i.fa-minus").toggle();

    $(e.target).next("div").find(".subCategoryBtn").toggle();

    if (e.target.checked && $(e.target).is("input")) {
        if (e.target.checked && $(e.target).is("input")) {
            $(".filterButtonShopPage input").each(function (index, element) {
                element.checked = false;
            });
            $(e.target)[0].checked = true;
        }

        $(e.target)
            .parents("div")
            .prev()
            .children()
            .each(function (index, element) {
                element.checked = true;
            });
            
    } else if (!e.target.checked && $(e.target).is("input")) {
        $(e.target)
            .closest("li.filterButtonShopPage")
            .next("div")
            .find("li.filterButtonShopPage")
            .children()
            .each(function (index, element) {
                element.checked = false;
            });
    }
});


// این مربوط به عملکرد + و - برای باز و بسته کردن هست
$(document).on("click", ".filterButtonShopPage .fa", function (e) {
    $(e.target).closest("li").next("div").toggle();

    $(e.target).closest("li").find("i.fa-plus").toggle();
    $(e.target).closest("li").find("i.fa-minus").toggle();

    $(e.target).closest("li").next("div").find(".subCategoryBtn").toggle();
});

// برای بسته بودن منوها هنگام بارگذاری اولیه
$(document).ready(function () {
    $("div.subCategoryBtn").hide();
    $("li.filterButtonShopPage").next("div.subCatGroup").hide();
});

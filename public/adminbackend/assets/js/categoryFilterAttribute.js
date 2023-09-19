$(document).on("click", ".filterButtonShopPage", function (e) {
    $(e.target).next("div").toggle();

    $(e.target).find("i.fa-plus").toggle();
    $(e.target).find("i.fa-minus").toggle();

    $(e.target).next("div").find(".subCategoryBtn").toggle();

    if (e.target.checked && $(e.target).is("input")) {
        $(e.target)
            .closest("li.filterButtonShopPage")
            .next("div")
            .find("li.filterButtonShopPage")
            .children()
            .each(function (index, element) {
                element.checked = true;
            });

        $(e.target)
            .parents("div")
            .prev()
            .children()
            .each(function (index, element) {
                element.checked = false;
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

        //این مورد رو برای چک باکس های ویژگی درست کردم که پایین ترین رو اگر زده بشه، تا بالا رو برمیداره
        $(e.target)
            .parents("div")
            .prev()
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
$("div.subCategoryBtn").hide();
$("li.filterButtonShopPage").next("div.subCatGroup").hide();
// برای باز شدن منوهای تیک خورده
$("li.showChecked").parents("div.subCatGroup").show();
$("li.showChecked").parents("div.subCategoryBtn").show();

// برای چک باکس های باز شده نزدیک مورد
$("li.showChecked")
    .parents("div.subCatGroup")
    .prev("li.filterButtonShopPage")
    .find(".fa.fa-plus")
    .hide();
$("li.showChecked")
    .parents("div.subCatGroup")
    .prev("li.filterButtonShopPage")
    .find(".fa.fa-minus")
    .show();

// برای چک باکس های باز شده روت
$("li.showChecked")
    .parents("div.subCatGroup")
    .prev("li.filterButtonShopPage")
    .closest(".subCategoryBtn")
    .prev("li.filterButtonShopPage")
    .find(".fa.fa-plus")
    .hide();
$("li.showChecked")
    .parents("div.subCatGroup")
    .prev("li.filterButtonShopPage")
    .closest(".subCategoryBtn")
    .prev("li.filterButtonShopPage")
    .find(".fa.fa-minus")
    .show();

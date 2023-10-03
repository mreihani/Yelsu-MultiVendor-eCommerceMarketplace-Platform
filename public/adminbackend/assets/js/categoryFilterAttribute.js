$(document).on("click", ".filterButtonShopPage", function (e) {
    $(e.target).next("div").toggle();

    $(e.target).find("i.fa-plus").toggle();
    $(e.target).find("i.fa-minus").toggle();

    $(e.target).next("div").find(".subCategoryBtn").toggle();

    // این بخش رفتار چک باکس رو مثل رادیو می کنه
    if (e.target.checked && $(e.target).is("input")) {
        $(".filterButtonShopPage input").each(function (index, element) {
            element.checked = false;
        });
        $(e.target)[0].checked = true;

        $('input[name="attribute_category_name"]').val($(e.target).next('span')[0].innerHTML);
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

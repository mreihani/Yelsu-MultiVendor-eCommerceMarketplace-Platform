// repeater form function
$('.repeater-body').on('click', '.add-repeater-btn', function(e) {
    e.preventDefault();
    
    $this = $(this);

    $repeater = $this.closest(".repeater-body").find('[data-repeatable]').last();
    $clone = $repeater.first().clone();

    let freightagetype_selection_cloned_element = $clone.find(".freightagetype_selection select option[value='0']");
    freightagetype_selection_cloned_element.attr("selected", "selected");

    let freightageLoaderTypeOption = $clone.find(".freightageloadertype_selection select option");
    freightageLoaderTypeOption.remove();
    $clone.find(".freightageloadertype_selection select").append(`<option value="0">نوع بارگیر را انتخاب نمایید</option>`);
    
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

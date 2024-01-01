// repeater form function
$('.repeater-body').on('click', '.add-repeater-btn', function(e) {
    e.preventDefault();
    
    $this = $(this);

    $repeater = $this.closest(".repeater-body").find('[data-repeatable]').last();
    $clone = $repeater.first().clone();

    let input_element = $clone.find("input");
    input_element.val("");

    $clone.insertAfter($repeater);
});

// remove repeater function
$(".repeater-product").click(function(e) {
    if($(e.target).hasClass("del-repeater-btn") && $(e.target).closest(".repeater-body").find($("[data-repeatable]")).length > 1) {
        $(e.target).closest('[data-repeatable]').remove();
    }
});

// start datatables
new DataTable('.yelsuDataTables', {
    responsive: true,
    searching: false,
    "ordering": false,
    "dom": 'rt',
    columnDefs: [ {
        className: 'dtr-control',
        orderable: false,
        targets: -1
    }],
    responsive: {
        details: {
            type: 'column',
            target: 'tr'
        }
    },
    "pageLength": -1 
});

// added value tax button functions
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

// value added button function
$(".value_added_tax_btn").click(function(e){
    let price_before_value_added_tax_input_elements_array = $(e.target).closest(".yelsuDataTablesHead").next('div').find(".price_before_value_added_tax");
    let price_after_value_added_tax_input_elements_array = $(e.target).closest(".yelsuDataTablesHead").next('div').find(".price_after_value_added_tax");

    if(e.target.checked) {
        for (let index_after = 0; index_after < price_after_value_added_tax_input_elements_array.length; index_after++) {
            let input_element_after = price_after_value_added_tax_input_elements_array[index_after];
            $(input_element_after).nextAll().find("span.price_tag").html(formatNumber(input_element_after.value));
        }  
    } else {
        for (let index_before = 0; index_before < price_before_value_added_tax_input_elements_array.length; index_before++) {
            let input_element_before = price_before_value_added_tax_input_elements_array[index_before];
            $(input_element_before).nextAll().find("span.price_tag").html(formatNumber(input_element_before.value));
        }  
    }
});

// discard button function
$("#list-btn-discard-changes").on("click", $(this), function(){
    $("#product-edit-specification-section").hide();
});

// edit button function
$(".edit-button-specification").on("click", $(this), function() {

    // show specification section when click on edit button
    $("#product-edit-specification-section").show();
    let product_deliver_capacity_body = $("#product-capacity-body");

    window.product_obj_global = $(this).next();
    let product_obj = JSON.parse($(this).next().val());

    // create repeater html based on user input
    let repeater_product_html = '';
    if(product_obj.product_deliver_capacity) {
        $.each(product_obj.specific_deliver_date, function(key,value) {
            repeater_product_html += `
            <div data-repeatable="" class="my-5">
                <fieldset class="row">
                    <!--begin::Row-->
                    <div class="row col-md-10">
                        <div class="row gutter-sm">        
                            <!--begin::Input group-->
                            <div class="row d-flex justify-content-end">
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <input value="${value}" name="specific_deliver_date[]" type="text" data-jdp="" data-jdp-min-date="today" data-jdp-only-date="" class="form-control form-control-solid" placeholder="تاریخ مورد نظر را انتخاب نمایید">
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <input value="${product_obj.specific_deliver_capacity[key]}" name="specific_deliver_capacity[]" type="number" class="form-control form-control-solid" placeholder="ظرفیت تحویل محصول را وارد نمایید">
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                            حذف
                            <i class="bi bi-patch-minus-fill"></i>
                        </button>
                    </div>
                </fieldset>
            </div>
            `;
        });
    } else {
        repeater_product_html = `
        <div data-repeatable="" class="my-5">
            <fieldset class="row">
                <!--begin::Row-->
                <div class="row col-md-10">
                    <div class="row gutter-sm">        
                        <!--begin::Input group-->
                        <div class="row d-flex justify-content-end">
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <input name="specific_deliver_date[]" type="text" data-jdp="" data-jdp-min-date="today" data-jdp-only-date="" class="form-control form-control-solid" placeholder="تاریخ مورد نظر را انتخاب نمایید">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <input name="specific_deliver_capacity[]" type="number" class="form-control form-control-solid" placeholder="ظرفیت تحویل محصول را وارد نمایید">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                        حذف
                        <i class="bi bi-patch-minus-fill"></i>
                    </button>
                </div>
            </fieldset>
        </div>
        `;
    }
    
    // first remove repeater element then append the newly created repeater
    $('[data-repeatable]').remove();
    $(".repeater-product").append(repeater_product_html);

    // check if product delivery capacity check box is selected or not, then hide or appear repeater form body
    if(product_obj.product_deliver_capacity) {
        $("#product-deliver-capacity").prop("checked", true);
        product_deliver_capacity_body.removeClass("d-none");
    } else {
        $("#product-deliver-capacity").prop("checked", false);
        product_deliver_capacity_body.addClass("d-none");
    }

    // set daily deliver input value
    $('input[name="daily_deliver_capacity"]').val(product_obj.daily_deliver_capacity);

    // scroll to bottom after clicking on edit
    $('html, body').animate({
        scrollTop: $("#product-edit-specification-section").offset().top
    }, 1);
});

// sage button function
$("#list-btn-save-changes").click(function(){
    let specific_deliver_date_flag = "";
    let specific_deliver_capacity_flag = "";

    // product deliver capacity checkbox status
    product_deliver_capacity = $("#product-deliver-capacity").prop("checked");

    // create an array of specific deliver date
    let specific_deliver_date_array = [];
    $.each($('input[name="specific_deliver_date[]"]'), function(specific_deliver_date_key, specific_deliver_date_value) {  

        // set flag to null if no value in input
        if(!specific_deliver_date_value.value) {
            specific_deliver_date_flag = null;
        }

        specific_deliver_date_array.push(specific_deliver_date_value.value);
    });

    // create an array of specific deliver capacity
    let specific_deliver_capacity_array = [];
    $.each($('input[name="specific_deliver_capacity[]"]'), function(specific_deliver_capacity_key, specific_deliver_capacity_value) {  

        // set flag to null if no value in input
        if(!specific_deliver_capacity_value.value) {
            specific_deliver_capacity_flag = null;
        }

        specific_deliver_capacity_array.push(specific_deliver_capacity_value.value);
    });

    // check if date and capacity number are not blank, if blank null both
    if(product_deliver_capacity && (specific_deliver_date_flag == null || specific_deliver_capacity_flag == null)) {
        specific_deliver_date_array = [''];
        specific_deliver_capacity_array = [''];
    }

    // ایجاد یک شیء از کل ورودی های کاربر
    let object_product = {
        product_id: JSON.parse(product_obj_global.val()).product_id,
        product_deliver_capacity: product_deliver_capacity,
        daily_deliver_capacity: product_deliver_capacity ? $('input[name="daily_deliver_capacity"]').val() : null,
        specific_deliver_date: product_deliver_capacity ? specific_deliver_date_array : null,
        specific_deliver_capacity: product_deliver_capacity ? specific_deliver_capacity_array : null,
    };
    product_obj_global.val(JSON.stringify(object_product));

    $("#product-edit-specification-section").hide();
});

// product deliver capacity show function
$("#product-deliver-capacity").on('change', $("#product-deliver-capacity"), (function(e){
    let product_deliver_capacity_body = $("#product-capacity-body");
   
    if(e.target.checked) {
        product_deliver_capacity_body.removeClass("d-none");
    } else {
        product_deliver_capacity_body.addClass("d-none");
    }
}));
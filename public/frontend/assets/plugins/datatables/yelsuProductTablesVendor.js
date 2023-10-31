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

// bulk actions checkbox
$(".product-bulk-action").click(function(e) {
    let input_elements_obj = $(e.target).closest("thead").next().find("input.form-check-input");
    
    // اگر دکمه کلی کلیک بخورد همه زیر مجموعه ها انتخاب گردد
    if(e.target.checked) {
        $.each(input_elements_obj, function( key, value ) {
            value.checked = true;
            
            $(this).closest("tr").find("button.edit-button-specification").prop('disabled', false);
            $(this).closest("tr").find("input.hidden-input-information").prop('disabled', false);
        });
    } else {
        $.each(input_elements_obj, function( key, value ) {
            value.checked = false;

            $(this).closest("tr").find("button.edit-button-specification").prop('disabled', true);
            $(this).closest("tr").find("input.hidden-input-information").prop('disabled', true);
        });
    }

    
});

// single checkbox function
$("tbody input").click(function(e) {
    if(e.target.checked) {
        $(this).closest("tr").find("button.edit-button-specification").prop('disabled', false);
        $(this).closest("tr").find("input.hidden-input-information").prop('disabled', false);
    } else {
        $(this).closest("tr").find("button.edit-button-specification").prop('disabled', true);
        $(this).closest("tr").find("input.hidden-input-information").prop('disabled', true);
    }
});

$(".edit-button-specification").on("click", $(this), function(){
    $("#product-edit-specification-section").show();

    window.product_obj_global = $(this).next();
    let product_obj = JSON.parse($(this).next().val());

    if(product_obj.product_in_stock == "نامحدود") {
        $("#product_in_stock").val("");
    } else {
        $("#product_in_stock").val(product_obj.product_in_stock);
    }

    if(product_obj.change_price_permission) {
        $("#change-price-permission").prop("checked", true);
    } else {
        $("#change-price-permission").prop("checked", false);
    }

    if(product_obj.product_specific_geolocation) {
        $("#product_specific_geolocation").prop("checked", true);
    } else {
        $("#product_specific_geolocation").prop("checked", false);
    }
    
    if(product_obj.product_geolocation_permission_province && product_obj.product_geolocation_permission_city) {
        
        let repeater_html = "";
        let province_repeater_html_items = "";
        let city_repeater_html_items = "";
        let selected;

        $.each(product_obj.product_geolocation_permission_province, function(province_item_key, province_item_value) {
            
            // ایجاد المان مربوط به استان
            $.each(product_obj.product_geolocation_permission_province[province_item_key], function(province_key, province_item) {
                selected = province_item.selected ? "selected" : "";

                province_repeater_html_items += `
                    <option ${selected} value="${province_item.value}">
                        ${province_item.value}
                    </option>`;
            });
    
            // ایجاد المان مربوط به شهر
            $.each(product_obj.product_geolocation_permission_city[province_item_key], function(city_key, city_item) {
                let city_value_html = city_item.value == "all" ? "همه شهر های استان" : city_item.value;
                selected = city_item.selected ? "selected" : "";

                city_repeater_html_items += `
                    <option ${selected} value="${city_value_html}">
                        ${city_value_html}
                    </option>`;
            });

            repeater_html += `
            <div data-repeatable="" class="my-2">
                <fieldset class="row">
                    <!--begin::Row-->
                    <div class="row col-md-10">
                        <div class="row gutter-sm ir-select">        
                            <label class="col-md-2  d-flex align-items-center">استان</label>                  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="select-box">
                                        <select name="product_geolocation_permission_province[]" class="ir-province form-control form-control-md">
                                            ${province_repeater_html_items}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label class="col-md-2 d-flex align-items-center">شهر</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="product_geolocation_permission_city[]" class="ir-city form-control form-control-md">
                                        ${city_repeater_html_items}
                                    </select>
                                </div>
                            </div>
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
            </div>`;

            province_repeater_html_items = "";
            city_repeater_html_items = "";
        });

        $(".repeater").html(repeater_html);

        
    }

    // if(product_obj.product_geolocation_permission_export_country) {

    // }
});


$("#list-btn-save-changes").click(function(){
    
    // ایجاد یک آرایه از کل استان ها
    let province_collection = [];
    let province_obj = "";
    let province_object_array = [];
    $.each($('select[name="product_geolocation_permission_province[]"]'), function(permission_province_key, permission_province_value) {  
        $.each((permission_province_value), function(key, value) {
            province_obj = {
                selected: value.selected,
                value: $(this).val()
            };  
            province_object_array.push(province_obj);
        });
        province_collection.push(province_object_array);
        province_object_array = [];
    });

    // ایجاد یک آرایه از کل شهر ها
    let city_collection = [];
    let city_obj = "";
    let city_object_array = [];
    $.each($('select[name="product_geolocation_permission_city[]"]'), function(permission_city_key, permission_city_value) {  
        $.each((permission_city_value), function(key, value) {
            city_obj = {
                selected: value.selected,
                value: $(this).val()
            };  
            city_object_array.push(city_obj);
        });
        city_collection.push(city_object_array);
        city_object_array = [];
    });

    // ایجاد یک آرایه از کل کشور ها
    let export_country_collection = [];
    let export_country_obj = "";
    $.each($('select[name="product_geolocation_permission_export_country[]"] option'), function(permission_export_country_key, permission_export_country_value) {    
        export_country_obj = {
            selected: permission_export_country_value.selected,
            value: $(this).val()
        };      
        export_country_collection.push(export_country_obj);
    });
    
    // ایجاد یک شیء از کل ورودی های کاربر
    let object_product = {
        product_in_stock: ($("#product_in_stock").val() && $("#product_in_stock").val() % 1 === 0 && $("#product_in_stock").val() > 0) ? $("#product_in_stock").val() : "",
        change_price_permission: $("#change-price-permission").prop("checked"),
        product_specific_geolocation: $("#product_specific_geolocation").prop("checked"),
        product_geolocation_permission_province: province_collection,
        product_geolocation_permission_city: city_collection,
        product_geolocation_permission_export_country: export_country_collection
    };

    product_obj_global.val(JSON.stringify(object_product));

    $("#product-edit-specification-section").hide();

   
});

// $(document).click(function(){
//     console.log($('select[name="product_geolocation_permission_province[]"]'));
// });

$("#list-btn-discard-changes").on("click", $(this), function(){
    $("#product-edit-specification-section").hide();
});



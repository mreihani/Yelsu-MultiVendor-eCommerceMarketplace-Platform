// تابع کلیک روی اضافه کردن ویژگی
$(document).on('click', '#repeater-btn', function(e) {
    e.preventDefault();
    let repeater_tr = $('.repeater tr');
    count = repeater_tr.length;
    
    // stringify function
    let attribute_item_name = $('input[name="attribute_item_name"]').val();
    let attribute_item_description = $('input[name="attribute_item_description"]').val();
    let attribute_item_keyword = $('input[name="attribute_item_keyword"]').val();
    let specification = $('input[name="kt_docs_repeater_basic[0][value]"]').val();
    let specification_input_array = $('#kt_docs_repeater_basic input');
    let attribute_item_required = $('input[name="attribute_item_required"]')[0].checked;
    let disabled_attribute = $('input[name="disabled_attribute"]')[0].checked;
    let show_in_product_page = $('input[name="show_in_product_page"]')[0].checked;
    let show_in_table_page = $('input[name="show_in_table_page"]')[0].checked;
    let multiple_selection_attribute = $('input[name="multiple_selection_attribute"]')[0].checked;
    let attribute_item_type_array = $('input[name="attribute_item_type"]');
    attribute_item_type_array.each((index, element) => {
        if(element.value == "dropdown" && element.checked) {
            attribute_item_type = "dropdown";
        } 
        if (element.value == "input_field" && element.checked) {
            attribute_item_type = "input_field";
        } 
    });
    
    // اینجا داده های ورودی جزئیات ویژگی رو مپ می کنی مقادیر اش رو خروجی میگیری
    var objMap = new Map(Object.entries(specification_input_array));
    let specification_input_mapped = new Array();
    objMap.forEach((item, key) => {
        if(item.value) {
            specification_input_mapped.push(item.value)
        }
    });

    if(attribute_item_type == "input_field") {
        specification_input_mapped = null;
    }

    // اینجا از مشخصات ویژگی ها میاد یک رشته درمیاره که داخل ورودی مخفی ذخیره میشه برای ارسال به سرور
    let attribute_list_array = new Array();
    attribute_list_array.push({
        'attribute_item_name': attribute_item_name, 
        'attribute_item_description': attribute_item_description, 
        'attribute_item_keyword': attribute_item_keyword, 
        'value': specification_input_mapped, 
        'attribute_item_required': attribute_item_required, 
        'disabled_attribute': disabled_attribute, 
        'show_in_product_page': show_in_product_page, 
        'show_in_table_page': show_in_table_page,
        'multiple_selection_attribute': multiple_selection_attribute,
        'attribute_item_type': attribute_item_type
    })

    let attribute_list_stringified = JSON.stringify(attribute_list_array);
    // end of - stringify function
    
    // بخش اعتبار سنجی
    if (!attribute_item_name.length) {
        $("#attribute-item-name-empty-warning").show()
    } else {
        $("#attribute-item-name-empty-warning").hide()
    }
    if (!attribute_item_description.length) {
        $("#attribute-item-description-empty-warning").show()
    } else {
        $("#attribute-item-description-empty-warning").hide()
    }
    if (attribute_item_type == "dropdown" && !specification.length) {
        $("#attribute-item-specification-empty-warning").show()
    } else {
        $("#attribute-item-specification-empty-warning").hide()
    }

    let trCloneElement = `
        <tr data-repeatable class="repeater-tr">
            <!--begin::Checkbox-->
            <td>
                <div class="fw-bold">
                    ${count + 1}
                </div>
            </td>
            <!--end::Checkbox-->

            <!--begin::دسته بندی=-->
            <td>
                <div class="ms-5 text-center fw-bold">
                    <!--begin::Title-->
                    ${attribute_item_name}
                    <!--end::Title-->
                </div>
            </td>
            <!--end::دسته بندی=-->

            <!--begin::دسته بندی=-->
            <td>
                <div class="ms-5 text-center fw-bold">
                    <!--begin::Title-->
                    ${specification_input_mapped ? specification_input_mapped.join('، ') : "ورودی دلخواه"}
                    <!--end::Title-->
                </div>
            </td>
            <!--end::دسته بندی=-->

            <!--begin::عملیات=-->
            <td class="text-center">
                <div class="menu-item px-3">
                    <button type="button" class="btn btn-sm btn-info m-1 edit-button-attribute">
                        <i class="bi bi-pencil-fill"></i>
                        ویرایش
                    </button>
                    <button type="button" class="btn btn-sm btn-danger m-1 delete-button-attribute" onclick="return confirm('آیا برای انجام این کار اطمینان دارید؟')">
                        <i class="bi bi-trash-fill"></i>
                        حذف
                    </button>
                </div>
            </td>
            <!--end::عملیات=-->

            <!--begin::فرم مخفی=-->
            <input type="hidden" value='${attribute_list_stringified}' name="attribute_list_array[]">
            <!--end::فرم مخفی=-->
        </tr>
    `;

    if(attribute_item_name.length && attribute_item_description.length && ((attribute_item_type == "dropdown" ? specification.length : true))) {
        $('.repeater').append(trCloneElement);

        $('#repeater-btn').show();
        $('#kt_docs_repeater_basic').show();

        $("#attribute-item-name-empty-warning").hide()
        $("#attribute-item-description-empty-warning").hide()
        $("#attribute-item-specification-empty-warning").hide()

        // تابع مربوط به پاک کردن فرم ها
        clear_input_forms();
    }
});

// توابع دکمه ویرایش ویژگی که تمام اطلاعات رو از آیتم داخل سطر ویژگی میاد برداشت و روی جدول اصلی جایگذاری می کند
$("#kt_ecommerce_category_table").on('click',".edit-button-attribute", function(e) {
    window.clicked_target = $(e.target);
    
    let attribute_list_array = clicked_target.closest('.repeater-tr').find('input')[0].value;
    let attribute_list_obj = JSON.parse(attribute_list_array);
    
    $('#repeater-btn').hide();
    $('#repeater-btn-save-changes').show();
    $('#repeater-btn-discard-changes').show();

    $('input[name="attribute_item_name"]').val(attribute_list_obj[0].attribute_item_name);
    $('input[name="attribute_item_description"]').val(attribute_list_obj[0].attribute_item_description);
    $('input[name="attribute_item_keyword"]').val(attribute_list_obj[0].attribute_item_keyword);

    if(attribute_list_obj[0].attribute_item_required) {
        $('input[name="attribute_item_required"]')[0].checked = true;
    } else {
        $('input[name="attribute_item_required"]')[0].checked = false;
    }

    if(attribute_list_obj[0].attribute_item_type == "dropdown") {
        let repeater_html_items = "";
        for (const key in attribute_list_obj[0].value) {
            repeater_html_items += `
            <div data-repeater-item="" style="">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <input value="${attribute_list_obj[0].value[key]}" type="text" name="kt_docs_repeater_basic[${key}][value]" class="form-control mb-2 mb-md-0" placeholder="مشخصات ویژگی مورد نظر">
                    </div>
                    <div class="col-md-4 d-flex justify-content-end align-items-center">
                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm btn-light-danger">
                            <i class="bi bi-patch-minus-fill"></i>
                            حذف
                        </a>
                    </div>
                </div>
            </div>`
        }

        let repeater_html = `
            <!--begin::Form group-->
            <div class="form-group card-body">
                <label class="required">لطفا جزئیات ویژگی را مشخص نمایید. به عنوان مثال اگر رنگ را مد نظر دارید، به ترتیب آبی، قرمز، زرد و ... را از طریق دکمه افزودن جزئیات ویژگی وارد کنید.</label>
                <div class="row">
                    <div class="col-md-8">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            ${repeater_html_items}
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center mt-5">
                        <div class="form-group" style="direction: ltr;">
                            <a href="javascript:;" data-repeater-create="" class="btn btn-sm btn-light-primary">
                            افزودن جزئیات ویژگی
                            <i class="bi bi-patch-plus-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form group-->
        `;

        $("#attribute_type_dropdown")[0].checked = true;
        $("#attribute_type_input_field")[0].checked = false;

        $("#kt_docs_repeater_basic").html(repeater_html);

        // برای جلوگیری از خراب شدن فرم ریپیتر
        KTFormRepeaterBasic.init();

        $("#kt_docs_repeater_basic").show();
    } else {
        $("#attribute_type_input_field")[0].checked = true;
        $("#attribute_type_dropdown")[0].checked = false;
        $("#kt_docs_repeater_basic").hide();
    }

    if(attribute_list_obj[0].disabled_attribute) {
        $('input[name="disabled_attribute"]')[0].checked = true;
    } else {
        $('input[name="disabled_attribute"]')[0].checked = false;
    }

    if(attribute_list_obj[0].show_in_product_page) {
        $('input[name="show_in_product_page"]')[0].checked = true;
    } else {
        $('input[name="show_in_product_page"]')[0].checked = false;
    }

    if(attribute_list_obj[0].show_in_table_page) {
        $('input[name="show_in_table_page"]')[0].checked = true;
    } else {
        $('input[name="show_in_table_page"]')[0].checked = false;
    }
    
    if(attribute_list_obj[0].multiple_selection_attribute) {
        $('input[name="multiple_selection_attribute"]')[0].checked = true;
    } else {
        $('input[name="multiple_selection_attribute"]')[0].checked = false;
    }

});

// تابع حذف آیتم ویژگی از لیست ویژگی های انتخاب شده
$("#kt_ecommerce_category_table").on('click',".delete-button-attribute", function(e) {
    let attribute_list_item = $(e.target).closest('.repeater-tr');
    attribute_list_item.remove();
});
    
// مربوط به دکمه ذخیره تغییرات
$("#kt_app_content_container").on('click',"#repeater-btn-save-changes", function() {

    // stringify function
    let attribute_item_name = $('input[name="attribute_item_name"]').val();
    let attribute_item_description = $('input[name="attribute_item_description"]').val();
    let attribute_item_keyword = $('input[name="attribute_item_keyword"]').val();
    let specification = $('input[name="kt_docs_repeater_basic[0][value]"]').val();
    let specification_input_array = $('#kt_docs_repeater_basic input');
    let attribute_item_required = $('input[name="attribute_item_required"]')[0].checked;
    let disabled_attribute = $('input[name="disabled_attribute"]')[0].checked;
    let show_in_product_page = $('input[name="show_in_product_page"]')[0].checked;
    let show_in_table_page = $('input[name="show_in_table_page"]')[0].checked;
    let multiple_selection_attribute = $('input[name="multiple_selection_attribute"]')[0].checked;
    let attribute_item_type_array = $('input[name="attribute_item_type"]');
    attribute_item_type_array.each((index, element) => {
        if(element.value == "dropdown" && element.checked) {
            attribute_item_type = "dropdown";
        } 
        if (element.value == "input_field" && element.checked) {
            attribute_item_type = "input_field";
        } 
    });
    
    // اینجا داده های ورودی جزئیات ویژگی رو مپ می کنی مقادیر اش رو خروجی میگیری
    var objMap = new Map(Object.entries(specification_input_array));
    let specification_input_mapped = new Array();
    objMap.forEach((item, key) => {
        if(item.value) {
            specification_input_mapped.push(item.value)
        }
    });

    if(attribute_item_type == "input_field") {
        specification_input_mapped = null;
    }

    // بخش اعتبار سنجی
    if (!attribute_item_name.length) {
        $("#attribute-item-name-empty-warning").show()
    } else {
        $("#attribute-item-name-empty-warning").hide()
    }
    if (!attribute_item_description.length) {
        $("#attribute-item-description-empty-warning").show()
    } else {
        $("#attribute-item-description-empty-warning").hide()
    }
    if (attribute_item_type == "dropdown" && !specification.length) {
        $("#attribute-item-specification-empty-warning").show()
    } else {
        $("#attribute-item-specification-empty-warning").hide()
    }

    // اینجا از مشخصات ویژگی ها میاد یک رشته درمیاره که داخل ورودی مخفی ذخیره میشه برای ارسال به سرور
    let attribute_list_array = new Array();
    attribute_list_array.push({
        'attribute_item_name': attribute_item_name, 
        'attribute_item_description': attribute_item_description, 
        'attribute_item_keyword': attribute_item_keyword, 
        'value': specification_input_mapped, 
        'attribute_item_required': attribute_item_required, 
        'disabled_attribute': disabled_attribute, 
        'show_in_product_page': show_in_product_page, 
        'show_in_table_page': show_in_table_page,
        'multiple_selection_attribute': multiple_selection_attribute,
        'attribute_item_type': attribute_item_type
    })


    if(attribute_item_name.length && attribute_item_description.length && ((attribute_item_type == "dropdown" ? specification.length : true))) {

        let attribute_list_stringified = JSON.stringify(attribute_list_array);
        let attribute_list_array_input = clicked_target.closest('td').next('input');
        clicked_target.closest('td').prev('td').find('div')[0].innerHTML = specification_input_mapped ? specification_input_mapped.join('، ') : "ورودی دلخواه";
        clicked_target.closest('td').prev('td').prev('td').find('div')[0].innerHTML = attribute_item_name;
        
        attribute_list_array_input.val(attribute_list_stringified);

        // نمایش و مخفی کردن خطاهای اعتبار سنجی
        $("#attribute-item-name-empty-warning").hide()
        $("#attribute-item-description-empty-warning").hide()
        $("#attribute-item-specification-empty-warning").hide()

        // نمایش و مخفی کردن 3 دکمه اصلی
        $('#repeater-btn').show();
        $('#kt_docs_repeater_basic').show();
        $('#repeater-btn-save-changes').hide();
        $('#repeater-btn-discard-changes').hide();

        // تابع مربوط به پاک کردن فرم ها
        clear_input_forms();
    }
    // end of - stringify function

});

// مربوط به دکمه انصراف
$("#kt_app_content_container").on('click',"#repeater-btn-discard-changes", function() {
    $('#repeater-btn').show();
    $('#kt_docs_repeater_basic').show();
    $('#repeater-btn-save-changes').hide();
    $('#repeater-btn-discard-changes').hide();

    // تابع مربوط به پاک کردن فرم ها
    clear_input_forms();
});

//  تابع برای نمایش یا مخفی کردن فرم ریپیتر برای دو حالت ویژگی دراپ داون یا فرم آزاد
$("input[name='attribute_item_type']").on('change', function(e) {
    if(e.target.value == "dropdown") {
        $("#kt_docs_repeater_basic").show();
    } else {
        $("#kt_docs_repeater_basic").hide();
    }
});

// تابع مربوط به پاک کردن فرم ها
function clear_input_forms() {
    $('input[name="attribute_item_name"]').val("");
    $('input[name="attribute_item_description"]').val("");
    $('input[name="attribute_item_keyword"]').val("");
    $('#kt_docs_repeater_basic input').val("");
    $('input[name="attribute_item_required"]')[0].checked = false;
    $('input[name="disabled_attribute"]')[0].checked = false;
    $('input[name="show_in_product_page"]')[0].checked = false;
    $('input[name="show_in_table_page"]')[0].checked = false;
    $('input[name="multiple_selection_attribute"]')[0].checked = false;
    $('input[name="attribute_item_type"]')[0].checked = true;
    $('input[name="attribute_item_type"]')[1].checked = false;
}

// توابع درگ اند دراپ
$( function() {
    $( "#sortable" ).sortable();
});
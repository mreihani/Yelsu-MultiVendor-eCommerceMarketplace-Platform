let category_id_input = $('input[name="category_id[]"]');

category_id_input.on('click', function(e) {

    let spinnerButton = $(".spinner");
    let attributeButton = $('#update-attributes');
    let selected_categories_id = e.target.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    $("#attribute-loop").html("");

    spinnerButton.toggle();    
    attributeButton.toggle();    

    $.ajax({
        url: `/${$('#user-role').val()}/load-attributes`,
        method: "post",
        data: ({
            id: selected_categories_id,
            product_id: $("#product_id").val(),
            role: $('#product-user-role').val()
        }),
        success: function (data) {
            spinnerButton.toggle();    
            attributeButton.toggle();   
        
            if(!data.duplicated_parent) {
                updateDOM(data);
            } else {
                $('.duplicated-category-warning').show();
            }
        },
    });

});

function updateDOM(data) {
    let attributeBodyElement = "";

    if(data.attributes != null) {
        data.attributes.forEach(function(attributeItem) {
            
            let attributeRequired = attributeItem.attribute_item_required == 1 ? 'required' : '';
            let attributeName = attributeItem.attribute_item_name;
            let attributeType = attributeItem.attribute_item_type;
            let attributeDescription = attributeItem.attribute_item_description;
            let attributeId = attributeItem.attribute_id;
            let attributeItemId = attributeItem.id;
            let multiple_selection_attribute = attributeItem.multiple_selection_attribute;
            let attributeValueLoop = "";
            let nonOfThem = "";
            let attributeSelectDropdown = "";
            let attributeMultipleSelection = "";
            let selected_attribute_value;
            
            if(attributeType == "dropdown") {
                
                if(attributeRequired != "required") {
                    nonOfThem = `
                        <option value="none" selected="selected">هیچ کدام</option>
                    `;
                }
                
                attributeItem.values.forEach(function(attributeValueItem) {
                    let attributeValueId = attributeValueItem.id;
                    let attributeValue = attributeValueItem.value;
                    selected_attribute_value = data.product_selected_attribute_value_id_array.includes(attributeValueId) ? "selected" : "";
                    
                    attributeValueLoop += `
                        <option ${selected_attribute_value} value="${attributeValueId}">${attributeValue}</option>
                    `;
                });
    
                attributeSelectDropdown = `
                <select class="form-select mb-2" data-control="select2" name="attribute[${attributeId}][${attributeItemId}][attribute_value_id]" data-hide-search="true" data-placeholder="انتخاب" >
                    ${nonOfThem}
                    ${attributeValueLoop}
                </select>
                `;
            } else {
                let attributeValue0 = attributeItem.values[0].id;

                // This is the part I had error
                let custom_field_value = data.product_selected_attribute_array[attributeItemId] ? data.product_selected_attribute_array[attributeItemId]['attribute_value'] : "";

                attributeSelectDropdown = `
                    <input type="text" name="attribute[${attributeId}][${attributeItemId}][attribute_value]" value="${custom_field_value}" class="form-control mb-2" placeholder="مقدار ویژگی مورد نظر را وارد نمایید"/>
                    <input type="hidden" name="attribute[${attributeId}][${attributeItemId}][attribute_value_id]" value="${attributeValue0}">
                `;
            }

            if(multiple_selection_attribute && attributeType == "dropdown") {
                attributeItem.values.forEach(function(attributeValueItem) {
                    let attributeValueId = attributeValueItem.id;
                    let attributeValue = attributeValueItem.value;

                    selected_attribute_value = data.product_selected_attribute_value_id_array.includes(attributeValueId) ? "checked" : "";

                    attributeMultipleSelection += `
                    <li class="list-style-none mt-4">
                        <input ${selected_attribute_value} class="form-check-input" type="checkbox" name="attribute[${attributeId}][${attributeItemId}][attribute_value_id][]" value="${attributeValueId}"> ${attributeValue} 
                    </li>
                    `; 
                });
            }
    
            if(multiple_selection_attribute && attributeType == "dropdown") {
                attributeBodyElement += ` 
                <div class="card card-flush mt-10">
                    <!--begin::کارت header-->
                    <div class="card-header">
                        <!--begin::کارت title-->
                        <div class="card-title ${attributeRequired}">
                            <h2>${attributeName}</h2>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body pt-0">
                        <div>
                            <!--begin::Input group-->
                            <!--begin::انتخاب2-->
                            <ul>
                            <input type="hidden" name="attribute[${attributeId}][${attributeItemId}][attribute_value_id][]" value="none" checked="true">
                            ${attributeMultipleSelection}
                            </ul>
                            <!--end::انتخاب2-->
                            <!--begin::توضیحات-->
                            <div class="text-muted fs-7 mt-5">${attributeDescription}</div>
                            <!--end::توضیحات-->
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--end::کارت body-->
                </div>  
                `;
            } else {
                attributeBodyElement += `
                <div class="card card-flush mt-10">
                    <!--begin::کارت header-->
                    <div class="card-header">
                        <!--begin::کارت title-->
                        <div class="card-title ${attributeRequired}">
                            <h2>${attributeName}</h2>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body pt-0">
                        <div>
                            <!--begin::Input group-->
                            <!--begin::انتخاب2-->
                            ${attributeSelectDropdown}
                            <!--end::انتخاب2-->
                            <!--begin::توضیحات-->
                            <div class="text-muted fs-7 mt-5">${attributeDescription}</div>
                            <!--end::توضیحات-->
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--end::کارت body-->
                </div>    
            `;
            }
            
    
            $("#attribute-loop").html(attributeBodyElement);
    
            $('.no-category-warning').hide();
            $('.duplicated-category-warning').hide();
        });
    }
}




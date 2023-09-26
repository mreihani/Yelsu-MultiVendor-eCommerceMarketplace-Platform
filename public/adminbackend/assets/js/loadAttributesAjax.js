$('#update-attributes').on('click', function(e) {
    let category_id_input = $('input[name="category_id[]"]');
    let selected_categories_arr = [];
    let spinnerButton = $(".spinner");
    let attributeButton = $('#update-attributes');

    category_id_input.each(function(index, element) {
        if(element.checked) {
            selected_categories_arr.push(element.value);
        }
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    if(selected_categories_arr.length) {

        $("#attribute-loop").html("");

        spinnerButton.toggle();    
        attributeButton.toggle();    

        $.ajax({
            url: `/${$('#user-role').val()}/load-attributes`,
            method: "post",
            data: ({
                id: selected_categories_arr,
            }),
            success: function (data) {
                let attributeBodyElement = "";
                spinnerButton.toggle();    
                attributeButton.toggle();    
    
                data.attributes.forEach(function(attributeItem) {
    
                    let attributeRequired = attributeItem.required == "true" ? 'required' : '';
                    let attributeName = attributeItem.name;
                    let attributeType = attributeItem.attribute_type;
                    let attributeDescription = attributeItem.description;
                    let attributeId = attributeItem.id;
                    let attributeValueLoop = "";
                    let nonOfThem = "";
                    let attributeSelectDropdown = "";
    
                    if(attributeType == "dropdown") {
                        
                        if(attributeRequired != "required") {
                            nonOfThem = `
                                <option value="none" selected="selected">هیچ کدام</option>
                            `;
                        }
                        
                        attributeItem.values.forEach(function(attributeValueItem) {
                            let attributeValueId = attributeValueItem.id;
                            let attributeValue = attributeValueItem.value;
    
                            attributeValueLoop += `
                                <option value="${attributeValueId}">${attributeValue}</option>
                            `;
                        });
    
                        attributeSelectDropdown = `
                        <select class="form-select mb-2" data-control="select2" name="attribute[${attributeId}][value_id]" data-hide-search="true" data-placeholder="انتخاب" >
                            ${nonOfThem}
                            ${attributeValueLoop}
                        </select>
                        `;
                    } else {
                        let attributeValue0 = attributeItem.values[0].id;
    
                        attributeSelectDropdown = `
                            <input type="text" name="attribute[${attributeId}][value]" class="form-control mb-2" placeholder="مقدار ویژگی مورد نظر را وارد نمایید"/>
                            <input type="hidden" name="attribute[${attributeId}][value_id]" value="${attributeValue0}">
                        `;
                    }
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
                                    <div class="text-muted fs-7 mb-7">${attributeDescription}</div>
                                    <!--end::توضیحات-->
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <!--end::کارت body-->
                        </div>    
                    `;
                    
                });
                $('.no-category-warning').hide();
                $("#attribute-loop").html(attributeBodyElement);
            },
        });
    } else {
        $('.no-category-warning').show();
    }
    
});


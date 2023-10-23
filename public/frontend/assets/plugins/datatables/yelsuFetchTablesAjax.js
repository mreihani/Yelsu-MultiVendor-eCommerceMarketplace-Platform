$.ajax({
    method: "GET",
    url: "/shop/category/fetch-price-tables",
    data: { category_id: $("#page_category_id").val()}
}).done(function( response ) {
    
    let tableHeadImage = "";
    let theadElement = "";
    let theadArr = "";
    let tableBody = "";
    let productRowElement = "";
    let productAttributeArray = "";
    let priceElement = "";

    if (response) {

        $.each(response.thead_arr, function(theadKey, theadItem) {
            theadArr += `
                <th class="text-center">${theadItem}</th>
            `;
        });

        theadElement = `<tr>
                            <th class="text-center">ردیف</th>
                            <th class="all text-center">نام محصول</th>
                            ${theadArr}
                            <th class="all text-center">قیمت</th>
                            <th class="text-center">اطلاعات بیشتر</th>
                        </tr>`;
        
        
        $.each(response.table, function( vendorId, tableItem ) {

            productRowElement = "";

            tableHeadImage = `
                <a href="${tableItem.table_header_arr.anchor_link}">
                    <img alt="Logo" src="${tableItem.table_header_arr.img_src_url}"/>
                </a>
                <a href="${tableItem.table_header_arr.anchor_link}">${tableItem.table_header_arr.shop_name} - قیمت ${tableItem.table_header_arr.category_name}</a>
            `;
            
            $.each(tableItem.products_array, function(productKey, productItem) {

                productAttributeArray = "";

                $.each(productItem.attribute_value_array, function(attribute_value_key, attribute_value_item) {
                    productAttributeArray += `
                        <td>
                            ${attribute_value_item}
                        </td>    
                    `;
                });
                
                if(productItem.selling_price != "0") {
                    priceElement = `
                        <input type="hidden" value="${productItem.selling_price}" class="price_before_value_added_tax">
                        <input type="hidden" value="${productItem.product_value_added_tax_by_percent}" class="price_after_value_added_tax">
                        <td>
                            <span class="price_tag">${productItem.selling_price_formatted}</span> ${productItem.product_currency}
                        </td>    
                    `;
                } else {
                    priceElement = `
                        <td>
                            <a href="tel:02191692471">
                                تماس بگیرید
                            </a>
                        </td>
                    `;
                }
                
                productRowElement +=    `<tr>
                                            <td>${productKey + 1}</td>
                                            <td>
                                                <a href="${productItem.anchor_link}">
                                                    ${productItem.product_name}
                                                </a>
                                            </td>
                                            ${productAttributeArray}
                                            ${priceElement}
                                            <td></td>
                                        </tr>`;
            });

            tableBody +=    `<div style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                                <div class="yelsuDataTablesHead d-flex align-items-center">
                                    <div class="vendor-image-div">
                                        ${tableHeadImage}
                                    </div>
                                    <div class="value-added-tax-div">
                                        <input type="checkbox" class="value_added_tax_btn">
                                        <label for="value_added_tax">نمایش قیمت با ارزش افزوده</label>
                                    </div>
                                </div>
                                <div class="product-wrapper row">
                                    <div class="product-wrap">
                                        <div class="product text-center">
                                            <table class="display yelsuDataTables" style="width:100%">
                                                <thead>
                                                    ${theadElement}
                                                </thead>
                                                <tbody>
                                                    ${productRowElement}
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>   
                            </div>
            `;
        });
    }

    $("#yelsuProductPriceTables").html(tableBody);

    startDataTables();
});



function startDataTables() {
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
}
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
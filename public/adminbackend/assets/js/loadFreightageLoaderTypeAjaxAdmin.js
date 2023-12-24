$("#yelsu_freightage").on("change", ".freightagetype_selection", function() {
    let thisElement = $(this);

    let selectElement = thisElement.find("select");
    let freightagetype_id = selectElement.val();

    if(freightagetype_id != 0) {
        
        $.ajax({
            url: "/admin/all/freightage-loader-type-ajax",
            method: "get",
            data: ({
                freightagetype_id
            }),
            success: function (data) {
                let option_element = "";
              
                let freightageloadertype_selection_element = thisElement.closest(".freightage-loader-repeater").find(".freightageloadertype_selection select");
                
                freightageloadertype_selection_element.html("");

                data.forEach(element => {
                    option_element += `
                        <option value="${element.id}">${element.description}</option>
                    `;
                    
                });
               
                freightageloadertype_selection_element.append(option_element);
            },
        });

    }
});
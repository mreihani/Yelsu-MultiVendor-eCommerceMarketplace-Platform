$("#freightagetype_selection").change(function(){
    let thisElement = $(this);

    let selectElement = thisElement.find("select");
    let freightagetype_id = selectElement.val();

    if(freightagetype_id != 0) {
        
        $.ajax({
            url: "/admin/all/freightage-loader-type-all-ajax",
            method: "get",
            data: ({
                freightagetype_id
            }),
            success: function (data) {
                let option_element = "";
                let freightageloadertype_selection_element = $("#freightageloadertype_selection select");
                freightageloadertype_selection_element.html("");

                data.forEach(element => {
                    option_element += `
                        <option value="${element.id}">${element.description}</option>
                    `;
                });

                let parent_option_element = `<option value="0">بارگیر والد</option>`;
                freightageloadertype_selection_element.append(parent_option_element + option_element);
            },
        });

    }
});
// data table crud operation
let table_body_elements = $("#table-body");
let table_row_number_card = $("#table-row-number-card");

window.selectedRowId = null;

// add a row in table when confirm btn is clicked
$(".shipping").on("click", ".shipping-calc-confirm-btn", function() {

    // get this element
    let thisElem = $(this);
    let shippingElement = thisElem.closest(".shipping");

    // get table body
    let tableBody = "";

    // get table body length
    let tableBodyLength = table_body_elements.find("tbody").length;

    // find the selected row
    let selectedRowElement = table_body_elements.find("tbody tr").filter(function(){
        return parseInt($(this).find(".shipping-row").html()) == selectedRowId
    });
    
    let bodyClass;
    if(selectedRowId) {
        // return the same class, bacause it's going to be edited.
        bodyClass = selectedRowElement.attr("class");
    } else {
        // get table body class, then get last tr element, if even set next row to odd and vice versa
        let isOdd = table_body_elements.find("tbody tr").last().hasClass("odd");
        bodyClass = isOdd ? "even" : "odd";
    }

    // get previous row id, set to zero if not exist
    let prevRowId = parseInt(table_body_elements.find(".shipping-row").last().html()) ? parseInt(table_body_elements.find(".shipping-row").last().html()) : 0;

    // get row id and add extra 1
    let rowId = selectedRowId ? selectedRowId : prevRowId + 1;
    
    // create origin address object
    let order_origin_address_obj_array = [];
    let order_origin_address_obj;
    let order_origin_address = shippingElement.find(".order-origin-address option");
    let order_origin_address_selected = shippingElement.find(".order-origin-address option:selected");
    $.each(order_origin_address, function(index,value) {
        order_origin_address_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == order_origin_address_selected.val() ? true : false
        }
        order_origin_address_obj_array.push(order_origin_address_obj);
    });
    
    // create destination address object
    let order_destination_address_obj_array = [];
    let order_destination_address_obj;
    let order_destination_address = shippingElement.find(".order-destination-address option");
    let order_destination_address_selected = shippingElement.find(".order-destination-address option:selected");
    $.each(order_destination_address, function(index,value) {
        order_destination_address_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == order_destination_address_selected.val() ? true : false
        }
        order_destination_address_obj_array.push(order_destination_address_obj);
    });
    
    // create freightage company object
    let freightage_information_obj_array = [];
    let freightage_information_obj;
    let freightage_information_dropdown = shippingElement.find(".freightage-information-dropdown option");
    let freightage_information_dropdown_selected = shippingElement.find(".freightage-information-dropdown option:selected");
    $.each(freightage_information_dropdown, function(index,value) {
        freightage_information_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_information_dropdown_selected.val() ? true : false
        }
        freightage_information_obj_array.push(freightage_information_obj);
    });
    
    // create freightage activity field object
    let freightage_activity_field_obj_array = [];
    let freightage_activity_field_obj;
    let freightage_activity_field_dropdown = shippingElement.find(".freightage-activity-field-dropdown option");
    let freightage_activity_field_dropdown_selected = shippingElement.find(".freightage-activity-field-dropdown option:selected");
    $.each(freightage_activity_field_dropdown, function(index,value) {
        freightage_activity_field_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_activity_field_dropdown_selected.val() ? true : false
        }
        freightage_activity_field_obj_array.push(freightage_activity_field_obj);
    });
    
    // create freightage loader type object
    let freightage_loader_type_obj_array = [];
    let freightage_loader_type_obj;
    let freightage_loader_type_dropdown = shippingElement.find(".freightage-loader-type-dropdown option");
    let freightage_loader_type_dropdown_selected = shippingElement.find(".freightage-loader-type-dropdown option:selected");
    $.each(freightage_loader_type_dropdown, function(index,value) {
        freightage_loader_type_obj = {
            id: value.value,
            value:value.innerHTML,
            selected: value.value == freightage_loader_type_dropdown_selected.val() ? true : false
        }
        freightage_loader_type_obj_array.push(freightage_loader_type_obj);
    });
    
    // get origin address html
    let order_origin_address_html = shippingElement.find(".order-origin-address-html").html();
    
    // get destination address html
    let order_destination_address_html = shippingElement.find(".order-destination-address-html").html();
    
    // get shipping calculated distance
    let shipping_distance_text = shippingElement.find(".shipping-distance-text").html();
    
    // get shipping calculated price
    let shipping_price_text = shippingElement.find(".shipping-price-text").html();

    // get neshan arc image
    let neshan_arc_image_src = $(".shipping-page-map-div img").attr("src");

    // get deliver date
    let deliverDateInputValue = $(".deliver-date-input").val();

    // get number of request
    let numberOfRequestInput = $(".number-items-request input").val();

    // create row object
    let shipping_row_object = {
        order_origin_address_obj_array,
        order_destination_address_obj_array,
        freightage_information_obj_array,
        freightage_activity_field_obj_array,
        freightage_loader_type_obj_array,
        order_origin_address_html,
        order_destination_address_html,
        shipping_distance_text,
        shipping_price_text,
        neshan_arc_image_src,
        deliverDateInputValue,
        numberOfRequestInput,
    }
    
    let shipping_row_object_json = JSON.stringify(shipping_row_object);
    
    if(tableBodyLength) {
        tableBody = `
            <tr class="${bodyClass}">
                <td class="shipping-row">${rowId}</td>
                <td>${order_origin_address_selected.html()}</td>
                <td>${order_destination_address_selected.html()}</td>
                <td>${freightage_information_dropdown_selected.html()}</td>
                <td>${freightage_activity_field_dropdown_selected.html()}</td>
                <td>${freightage_loader_type_dropdown_selected.html()}</td>
                <td>${deliverDateInputValue}</td>
                <td>${numberOfRequestInput}</td>
                <td>
                    پرداخت شده و در حال ارسال
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="input-group" style="width: 130px; height: 33px;">
                            <input name="quantity" class="quantity form-control" type="number" min="1" max="10000000" value="1">
                            <button type="button" class="quantity-plus w-icon-plus"></button>
                            <button type="button" class="quantity-minus w-icon-minus"></button>
                        </div>
                        <button type="button" class="btn btn-dark btn-ellipse btn-sm ml-1 row-duplicate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="رونوشت">
                            <svg width="42px" height="42px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M18.5703 22H14.0003C11.7103 22 10.5703 20.86 10.5703 18.57V11.43C10.5703 9.14 11.7103 8 14.0003 8H18.5703C20.8603 8 22.0003 9.14 22.0003 11.43V18.57C22.0003 20.86 20.8603 22 18.5703 22Z" fill="#292D32"></path> <path d="M13.43 5.43V6.77C10.81 6.98 9.32 8.66 9.32 11.43V16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43Z" fill="#292D32"></path> <path d="M18.1291 14.2501H17.2491V13.3701C17.2491 12.9601 16.9091 12.6201 16.4991 12.6201C16.0891 12.6201 15.7491 12.9601 15.7491 13.3701V14.2501H14.8691C14.4591 14.2501 14.1191 14.5901 14.1191 15.0001C14.1191 15.4101 14.4591 15.7501 14.8691 15.7501H15.7491V16.6301C15.7491 17.0401 16.0891 17.3801 16.4991 17.3801C16.9091 17.3801 17.2491 17.0401 17.2491 16.6301V15.7501H18.1291C18.5391 15.7501 18.8791 15.4101 18.8791 15.0001C18.8791 14.5901 18.5391 14.2501 18.1291 14.2501Z" fill="#292D32"></path> </g></svg>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <input type="hidden" value='${shipping_row_object_json}' class="shipping-row-object-json">
                        <button type="button" class="btn btn-dark btn-ellipse btn-sm d-flex align-items-center row-edit-btn">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
                            ویرایش
                        </button>
                        <button style="height: 15px;" type="button" class="btn btn-warning btn-ellipse btn-sm d-flex align-items-center ml-2 row-delete-btn">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            حذف
                        </button>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-ellipse btn-sm align-items-center row-save-btn d-flex">
                            <svg width="64px" height="64px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>save-floppy</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-154.000000, -517.000000)" fill="#ffffff"> <path d="M172,522 C172,521.447 172.448,521 173,521 C173.552,521 174,521.447 174,522 L174,526 C174,526.553 173.552,527 173,527 C172.448,527 172,526.553 172,526 L172,522 L172,522 Z M163,529 L177,529 C177.552,529 178,528.553 178,528 L178,517 L162,517 L162,528 C162,528.553 162.448,529 163,529 L163,529 Z M182,517 L180,517 L180,529 C180,530.104 179.104,531 178,531 L162,531 C160.896,531 160,530.104 160,529 L160,517 L158,517 C155.791,517 154,518.791 154,521 L154,545 C154,547.209 155.791,549 158,549 L182,549 C184.209,549 186,547.209 186,545 L186,521 C186,518.791 184.209,517 182,517 L182,517 Z" id="save-floppy" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                            ذخیره
                        </button>
                        <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-pending-btn d-none">
                            <span class="pending-loader"></span>
                            در حال ذخیره
                        </button>
                        <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-save-btn-success d-none">
                            <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M437.016,74.984c-99.979-99.979-262.075-99.979-362.033,0.002c-99.978,99.978-99.978,262.073,0.004,362.031 c99.954,99.978,262.05,99.978,362.029-0.002C536.995,337.059,536.995,174.964,437.016,74.984z M406.848,406.844 c-83.318,83.318-218.396,83.318-301.691,0.004c-83.318-83.299-83.318-218.377-0.002-301.693 c83.297-83.317,218.375-83.317,301.691,0S490.162,323.549,406.848,406.844z"></path> <path d="M368.911,155.586L234.663,289.834l-70.248-70.248c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17 l85.333,85.333c8.331,8.331,21.839,8.331,30.17,0l149.333-149.333c8.331-8.331,8.331-21.839,0-30.17 S377.242,147.255,368.911,155.586z"></path> </g> </g> </g> </g></svg>
                            ذخیره شد!
                        </button>
                    </div>
                </td>
                <td class="dtr-control dtr-hidden" style="display: none;"></td>
            </tr>`;
    } else {
        tableBody = `
        <div class="col-md-12 pt-5 pb-5">
            <table class="display yelsuDataTables" style="width:100%">
                <thead>
                    <tr>
                        <th class="all text-center">ردیف</th>
                        <th class="all text-center">مبدا</th>
                        <th class="all text-center">مقصد</th>
                        <th class="all text-center">نام شرکت باربری</th>
                        <th class="all text-center">روش ارسال</th>
                        <th class="all text-center">نوع بارگیر</th>
                        <th class="all text-center">تاریخ</th>
                        <th class="all text-center">مقدار درخواستی</th>
                        <th class="all text-center">وضعیت</th>
                        <th class="all text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="برای رونوشت ردیف مورد نظر، ابتدا تعداد رونوشت را وارد سپس بر روی دکمه رونوشت کلیک کنید.">
                            رونوشت ردیف
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#ffffff" stroke-width="1.5"></circle> <path d="M12 17V11" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" fill="#ffffff"></circle> </g></svg>
                        </th>
                        <th class="all text-center">ویرایش / حذف</th>
                        <th class="all text-center">عملیات</th>
                        <th class="text-center">اطلاعات بیشتر</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="shipping-row">1</td>
                        <td>${order_origin_address_selected.html()}</td>
                        <td>${order_destination_address_selected.html()}</td>
                        <td>${freightage_information_dropdown_selected.html()}</td>
                        <td>${freightage_activity_field_dropdown_selected.html()}</td>
                        <td>${freightage_loader_type_dropdown_selected.html()}</td>
                        <td>${deliverDateInputValue}</td>
                        <td>${numberOfRequestInput}</td>
                        <td>
                            پرداخت شده و در حال ارسال
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="input-group" style="width: 130px; height: 33px;">
                                    <input name="quantity" class="quantity form-control" type="number" min="1" max="10000000" value="1">
                                    <button type="button" class="quantity-plus w-icon-plus"></button>
                                    <button type="button" class="quantity-minus w-icon-minus"></button>
                                </div>
                                <button style="height: 15px;" type="button" class="btn btn-dark btn-ellipse btn-sm ml-1 row-duplicate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="رونوشت">
                                    <svg width="42px" height="42px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M18.5703 22H14.0003C11.7103 22 10.5703 20.86 10.5703 18.57V11.43C10.5703 9.14 11.7103 8 14.0003 8H18.5703C20.8603 8 22.0003 9.14 22.0003 11.43V18.57C22.0003 20.86 20.8603 22 18.5703 22Z" fill="#292D32"></path> <path d="M13.43 5.43V6.77C10.81 6.98 9.32 8.66 9.32 11.43V16H5.43C3.14 16 2 14.86 2 12.57V5.43C2 3.14 3.14 2 5.43 2H10C12.29 2 13.43 3.14 13.43 5.43Z" fill="#292D32"></path> <path d="M18.1291 14.2501H17.2491V13.3701C17.2491 12.9601 16.9091 12.6201 16.4991 12.6201C16.0891 12.6201 15.7491 12.9601 15.7491 13.3701V14.2501H14.8691C14.4591 14.2501 14.1191 14.5901 14.1191 15.0001C14.1191 15.4101 14.4591 15.7501 14.8691 15.7501H15.7491V16.6301C15.7491 17.0401 16.0891 17.3801 16.4991 17.3801C16.9091 17.3801 17.2491 17.0401 17.2491 16.6301V15.7501H18.1291C18.5391 15.7501 18.8791 15.4101 18.8791 15.0001C18.8791 14.5901 18.5391 14.2501 18.1291 14.2501Z" fill="#292D32"></path> </g></svg>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" value='${shipping_row_object_json}' class="shipping-row-object-json">
                                <button type="button" class="btn btn-dark btn-ellipse btn-sm d-flex align-items-center row-edit-btn">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
                                    ویرایش
                                </button>
                                <button type="button" class="btn btn-warning btn-ellipse btn-sm d-flex align-items-center ml-2 row-delete-btn">
                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    حذف
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary btn-ellipse btn-sm align-items-center row-save-btn d-flex">
                                    <svg width="64px" height="64px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>save-floppy</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-154.000000, -517.000000)" fill="#ffffff"> <path d="M172,522 C172,521.447 172.448,521 173,521 C173.552,521 174,521.447 174,522 L174,526 C174,526.553 173.552,527 173,527 C172.448,527 172,526.553 172,526 L172,522 L172,522 Z M163,529 L177,529 C177.552,529 178,528.553 178,528 L178,517 L162,517 L162,528 C162,528.553 162.448,529 163,529 L163,529 Z M182,517 L180,517 L180,529 C180,530.104 179.104,531 178,531 L162,531 C160.896,531 160,530.104 160,529 L160,517 L158,517 C155.791,517 154,518.791 154,521 L154,545 C154,547.209 155.791,549 158,549 L182,549 C184.209,549 186,547.209 186,545 L186,521 C186,518.791 184.209,517 182,517 L182,517 Z" id="save-floppy" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                    ذخیره
                                </button>
                                <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-pending-btn d-none">
                                    <span class="pending-loader"></span>
                                    در حال ذخیره
                                </button>
                                <button type="button" class="btn btn-dark btn-ellipse btn-sm align-items-center row-save-btn-success d-none">
                                    <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M437.016,74.984c-99.979-99.979-262.075-99.979-362.033,0.002c-99.978,99.978-99.978,262.073,0.004,362.031 c99.954,99.978,262.05,99.978,362.029-0.002C536.995,337.059,536.995,174.964,437.016,74.984z M406.848,406.844 c-83.318,83.318-218.396,83.318-301.691,0.004c-83.318-83.299-83.318-218.377-0.002-301.693 c83.297-83.317,218.375-83.317,301.691,0S490.162,323.549,406.848,406.844z"></path> <path d="M368.911,155.586L234.663,289.834l-70.248-70.248c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17 l85.333,85.333c8.331,8.331,21.839,8.331,30.17,0l149.333-149.333c8.331-8.331,8.331-21.839,0-30.17 S377.242,147.255,368.911,155.586z"></path> </g> </g> </g> </g></svg>
                                    ذخیره شد!
                                </button>
                            </div>
                        </td>
                        <td class="dtr-control dtr-hidden" style="display: none;"></td>
                    </tr>
                </tbody>
            </table>
        </div>`;
    }

    // get shipping-schedule input
    let schedule_element = shippingElement.find(".shipping-schedule input");

    // Get the value of the element with the ID "loader_type_min" using jQuery and store it in the variable loader_type_min
    let loader_type_min = parseInt($("#loader_type_min").val());

    // Get the value of the element with the ID "loader_type_max" using jQuery and store it in the variable loader_type_max
    let loader_type_max = parseInt($("#loader_type_max").val());

    // validation section
    shippingValidationHandler(thisElem,loader_type_min,loader_type_max);

    if(
        schedule_element.val() 
    && parseInt(numberOfRequestInput)
    && parseInt(numberOfRequestInput) >= loader_type_min
    && parseInt(numberOfRequestInput) <= loader_type_max
    ) {
        // append table body, table rows already exist
        if (tableBodyLength) {
            // EDITING - here check if user is editing or creating, if editing then replace the selected row, else append new row
            if(selectedRowId) {
                // calculate difference between selectedElementRequestInput and numberOfRequestInput
                // selectedElementRequestInput is the number of requests before editing, it comes from rowEditHandler.js line 20
                let numberOfRequestInputDiff = parseInt(numberOfRequestInput) - selectedElementRequestInput;
               
                // calculate remaining quantity
                let calculatedRemainingQuantity = calculateRemainingQuantity(numberOfRequestInputDiff);

                // check if remaining quantity is not greater than 0
                if(!calculatedRemainingQuantity) {
                    resetAllForm();
                    return;
                }

                // replace the selected row
                selectedRowElement.replaceWith(tableBody);
            } else {
                // CREATING - calculate remaining quantity
                let calculatedRemainingQuantity = calculateRemainingQuantity(numberOfRequestInput);

                // check if remaining quantity is not greater than 0
                if(!calculatedRemainingQuantity) {
                    resetAllForm();
                    return;
                }

                // append new row
                table_body_elements.find("tbody").append(tableBody);

                resetRowSaveBtnClasses(selectedRowElement);
            }
        // first time user creates a row, then append new row
        } else {
            // calculate remaining quantity
            let calculatedRemainingQuantity = calculateRemainingQuantity(numberOfRequestInput);

            // check if remaining quantity is not greater than 0
            if(!calculatedRemainingQuantity) {
                resetAllForm();
                return;
            }

            table_body_elements.append(tableBody);
            startDataTables();
        }

        // set null to rowId global variable
        selectedRowId = null;

        // reset all form from shippingPageCancelBtn.js file
        resetAllForm();
    }
});


/**
 * Validates shipping information
 * 
 * @param {object} thisElem - The jQuery element triggering the validation
 */
function shippingValidationHandler(thisElem,loader_type_min,loader_type_max) {
    // Find the closest parent element with class "shipping-element"
    let shipping_element = thisElem.closest(".shipping-element");

    // Find the schedule input element and the schedule alert element
    let schedule_element = shipping_element.find(".shipping-schedule input");
    let schedule_element_alert = $("#shedule-alert");

    // Find the number of items input element and the related alert elements
    let number_items_request = shipping_element.find(".number-items-request input");
    let number_items_request_empty_alert = $("#number-items-request-empty-alert");
    let number_items_request_min_alert = $("#number-items-request-min-alert");
    let number_items_request_max_alert = $("#number-items-request-max-alert");
    
    // Validate schedule element
    if(!schedule_element.val()) {

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        schedule_element_alert.removeClass("d-none");
    } else {
        schedule_element_alert.addClass("d-none");
    }

    // Validate number of items input
    if(!number_items_request.val()) {

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        number_items_request_empty_alert.removeClass("d-none");
    } else {
        number_items_request_empty_alert.addClass("d-none");
    }

    // Validate minimum number of items
    if(parseInt(number_items_request.val()) && parseInt(number_items_request.val()) < parseInt(loader_type_min)) {
        number_items_request_min_alert.find("span").html(parseInt(loader_type_min));

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        number_items_request_min_alert.removeClass("d-none");
    } else {
        number_items_request_min_alert.addClass("d-none");
    }

    // Validate maximum number of items
    if(parseInt(number_items_request.val()) && parseInt(number_items_request.val()) > parseInt(loader_type_max)) {
        number_items_request_max_alert.find("span").html(parseInt(loader_type_max));

        // move to top of screen
        $("html, body").animate({ scrollTop: 0 }, "slow");

        number_items_request_max_alert.removeClass("d-none");
    } else {
        number_items_request_max_alert.addClass("d-none");
    }
    
    // Final validation and actions
    if(
        schedule_element.val()
    && parseInt(number_items_request.val())
    && parseInt(number_items_request.val()) >= parseInt(loader_type_min)
    && parseInt(number_items_request.val()) <= parseInt(loader_type_max)
    ) {
        thisElem.addClass("d-none");  // Hide verify button
        thisElem.removeClass("d-flex");

        let cancelBtnElem = thisElem.next();
        cancelBtnElem.addClass("d-none");  // Hide cancel button
        cancelBtnElem.removeClass("d-flex");
    }
}

function resetRowSaveBtnClasses(selectedRowElement) {
    // Show save btn
    selectedRowElement.find('.row-save-btn').removeClass('d-none');
    selectedRowElement.find('.row-save-btn').addClass('d-flex');

    // Hide success btn
    selectedRowElement.find('.row-save-btn-success').addClass('d-none');
    selectedRowElement.find('.row-save-btn-success').removeClass('d-flex');
}


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
            $(this).closest("tr").find("input.hidden-input-information-server").prop('disabled', false);
        });
    } else {
        $.each(input_elements_obj, function( key, value ) {
            value.checked = false;

            $(this).closest("tr").find("button.edit-button-specification").prop('disabled', true);
            $(this).closest("tr").find("input.hidden-input-information").prop('disabled', true);
            $(this).closest("tr").find("input.hidden-input-information-server").prop('disabled', true);
        });
    }

    
});

// single checkbox function
$("tbody input").click(function(e) {
    if(e.target.checked) {
        $(this).closest("tr").find("button.edit-button-specification").prop('disabled', false);
        $(this).closest("tr").find("input.hidden-input-information").prop('disabled', false);
        $(this).closest("tr").find("input.hidden-input-information-server").prop('disabled', false);
    } else {
        $(this).closest("tr").find("button.edit-button-specification").prop('disabled', true);
        $(this).closest("tr").find("input.hidden-input-information").prop('disabled', true);
        $(this).closest("tr").find("input.hidden-input-information-server").prop('disabled', true);
    }
});

$(".edit-button-specification").on("click", $(this), function() {
    $("#product-edit-specification-section").show();

    window.product_obj_global = $(this).next();
    window.product_obj_server_global = $(this).next().next();
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

    if(product_obj.product_specific_geolocation_internal) {
        $("#product_specific_geolocation_internal").prop("checked", true);
    } else {
        $("#product_specific_geolocation_internal").prop("checked", false);
    }

    if(product_obj.product_specific_geolocation_external) {
        $("#product_specific_geolocation_external").prop("checked", true);
    } else {
        $("#product_specific_geolocation_external").prop("checked", false);
    }

    let selected;
    let repeater_html = "";

    if(product_obj.product_geolocation_permission_province.length && product_obj.product_geolocation_permission_city.length) {

        let province_repeater_html_items = "";
        let city_repeater_html_items = "";

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
                
                let city_value_html = city_item.value;
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

        $(".repeater-product").html(repeater_html);
        
    } else {
       
        repeater_html = `
            <div data-repeatable class="my-2">
                <fieldset class="row">
                    <!--begin::Row-->
                    <div class="row col-md-10">
                        <div class="row gutter-sm ir-select">        
                            <label class="col-md-2 d-flex align-items-center">استان</label>                  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="select-box">
                                        <select name="product_geolocation_permission_province[]" class="ir-province form-control form-control-md">
                                        <option value="همه استان ها">همه استان ها</option><option value="آذربايجان شرقي">آذربايجان شرقي</option><option value="آذربايجان غربي">آذربايجان غربي</option><option value="اردبيل">اردبيل</option><option value="اصفهان">اصفهان</option><option value="ايلام">ايلام</option><option value="بوشهر">بوشهر</option><option value="تهران">تهران</option><option value="چهارمحال بختياري">چهارمحال بختياري</option><option value="خراسان جنوبي">خراسان جنوبي</option><option value="خراسان رضوي">خراسان رضوي</option><option value="خراسان شمالي">خراسان شمالي</option><option value="خوزستان">خوزستان</option><option value="زنجان">زنجان</option><option value="سمنان">سمنان</option><option value="سيستان و بلوچستان">سيستان و بلوچستان</option><option value="فارس">فارس</option><option value="قزوين">قزوين</option><option value="قم">قم</option><option value="کرج">کرج</option><option value="كردستان">كردستان</option><option value="كرمان">كرمان</option><option value="كرمانشاه">كرمانشاه</option><option value="كهكيلويه و بويراحمد">كهكيلويه و بويراحمد</option><option value="گلستان">گلستان</option><option value="گيلان">گيلان</option><option value="لرستان">لرستان</option><option value="مازندران">مازندران</option><option value="مركزي">مركزي</option><option value="هرمزگان">هرمزگان</option><option value="همدان">همدان</option><option value="يزد">يزد</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label class="col-md-2 d-flex align-items-center">شهر</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="product_geolocation_permission_city[]" class="ir-city form-control form-control-md">
                                        <option value="همه شهرها"> 
                                            همه شهرها                                                                                
                                        </option>
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

        $(".repeater-product").html(repeater_html);
        
    }

    let product_export_countries_dropdown_element = $(".product-export-countries-dropdown");
    let product_export_countries_dropdown_html = "";
    let product_export_countries_dropdown_option_html = "";

    if(product_obj.product_geolocation_permission_export_country.length) {
        
        $.each(product_obj.product_geolocation_permission_export_country, function(export_country_item_key, export_country_item_value) {
            selected = export_country_item_value.selected ? "selected" : "";

            product_export_countries_dropdown_option_html +=  `<option ${selected} value="${export_country_item_value.value}">
                                                                    ${export_country_item_value.value}
                                                                </option>`;
        });

        product_export_countries_dropdown_html = `
        <select class="form-select product-export-countries-dropdown" name="product_geolocation_permission_export_country[]" multiple aria-label="multiple select example" dir="ltr">
                ${product_export_countries_dropdown_option_html}
        </select>
        `;

        product_export_countries_dropdown_element.html(product_export_countries_dropdown_html);
    } else {
        product_export_countries_dropdown_html = `
        <select class="form-select product-export-countries-dropdown" name="product_geolocation_permission_export_country[]" multiple="" aria-label="multiple select example" dir="ltr">
            <option value="Worldwide">Worldwide</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Åland Islands">Åland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cote D'ivoire">Cote D'ivoire</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Territories">French Southern Territories</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guernsey">Guernsey</option>
            <option value="Guinea">Guinea</option>
            <option value="Guinea-bissau">Guinea-bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Isle of Man">Isle of Man</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jersey">Jersey</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
            <option value="Korea, Republic of">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macao">Macao</option>
            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
            <option value="Moldova, Republic of">Moldova, Republic of</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montenegro">Montenegro</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Namibia">Namibia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands">Netherlands</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russian Federation">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint Helena">Saint Helena</option>
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
            <option value="Saint Lucia">Saint Lucia</option>
            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Serbia">Serbia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
            <option value="Taiwan">Taiwan</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Timor-leste">Timor-leste</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Viet Nam">Viet Nam</option>
            <option value="Virgin Islands, British">Virgin Islands, British</option>
            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
            <option value="Wallis and Futuna">Wallis and Futuna</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
        </select>`;

        product_export_countries_dropdown_element.html(product_export_countries_dropdown_html);
    }

    // نمایش یا عدم نمایش فرم فروش داخل یا خارج با توجه مقدار انتخاب شده آن
    if(!product_obj.product_specific_geolocation_internal) {
        $(".product_specific_geolocation_internal_body").hide();
    } else {
        $(".product_specific_geolocation_internal_body").show();
    }

    if(!product_obj.product_specific_geolocation_external) {
        $(".product_specific_geolocation_external_body").hide();
    } else {
        $(".product_specific_geolocation_external_body").show();
    }

    $('html, body').animate({
        scrollTop: $("#product-edit-specification-section").offset().top
    }, 1);
    
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

    //  ایجاد یک آرایه از کل استان ها برای سرور
    let province_collection_server = [];
    $.each($('select[name="product_geolocation_permission_province[]"] option:selected'), function(permission_province_key, permission_province_value) {  
        if(permission_province_value.value != '') {
            province_collection_server.push(permission_province_value.value);
        }
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

    //  ایجاد یک آرایه از کل شهرها برای سرور
    let city_collection_server = [];
    $.each($('select[name="product_geolocation_permission_city[]"] option:selected'), function(permission_city_key, permission_city_value) {  
        if(permission_city_value.value != '') {
            city_collection_server.push(permission_city_value.value);
        }
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

    // ایجاد یک آرایه از کل کشور ها برای سرور
    let export_country_collection_server = [];
    $.each($('select[name="product_geolocation_permission_export_country[]"] option:selected'), function(permission_export_country_key, permission_export_country_value) {    
        export_country_collection_server.push(permission_export_country_value.value);
    });
    
    // ایجاد یک شیء از کل ورودی های کاربر
    let object_product = {
        product_id: JSON.parse(product_obj_global.val()).product_id,
        product_in_stock: ($("#product_in_stock").val() && $("#product_in_stock").val() % 1 === 0 && $("#product_in_stock").val() > 0) ? $("#product_in_stock").val() : "",
        change_price_permission: $("#change-price-permission").prop("checked"),
        product_specific_geolocation_internal: $("#product_specific_geolocation_internal").prop("checked"),
        product_specific_geolocation_external: $("#product_specific_geolocation_external").prop("checked"),
        product_geolocation_permission_province: province_collection,
        product_geolocation_permission_city: city_collection,
        product_geolocation_permission_export_country: export_country_collection
    };
    product_obj_global.val(JSON.stringify(object_product));

    // ایجاد یک شیء از کل ورودی های کاربر برای ارسال به سرور
    let object_product_server = {
        product_id: JSON.parse(product_obj_global.val()).product_id,
        product_in_stock: ($("#product_in_stock").val() && $("#product_in_stock").val() % 1 === 0 && $("#product_in_stock").val() > 0) ? $("#product_in_stock").val() : "",
        change_price_permission: $("#change-price-permission").prop("checked"),
        product_specific_geolocation_internal: $("#product_specific_geolocation_internal").prop("checked"),
        product_specific_geolocation_external: $("#product_specific_geolocation_external").prop("checked"),
        product_geolocation_permission_province: province_collection_server,
        product_geolocation_permission_city: city_collection_server,
        product_geolocation_permission_export_country: export_country_collection_server
    };
    product_obj_server_global.val(JSON.stringify(object_product_server));

    // update product information in table row - product in stock number
    if(object_product.product_in_stock > 0) {
        product_obj_global.closest("tr").find(".product-stock-number-table").html(object_product.product_in_stock);
        product_obj_global.closest("tr").find(".product-stock-number-table").removeClass("badge badge-info");
    } else {
        product_obj_global.closest("tr").find(".product-stock-number-table").html("نامحدود");
        product_obj_global.closest("tr").find(".product-stock-number-table").addClass("badge badge-info");
    }

    // update product information in table row - product change price permission
    if(object_product.change_price_permission) {
        product_obj_global.closest("tr").find(".change-price-permission-table").html("بله");
        product_obj_global.closest("tr").find(".change-price-permission-table").removeClass("badge-secondary");
        product_obj_global.closest("tr").find(".change-price-permission-table").addClass("badge-primary");
    } else {
        product_obj_global.closest("tr").find(".change-price-permission-table").html("خیر");
        product_obj_global.closest("tr").find(".change-price-permission-table").addClass("badge-secondary");
        product_obj_global.closest("tr").find(".change-price-permission-table").removeClass("badge-primary");
    }
    
    // update product information in table row - product specific geolocation internal 
    if(object_product.product_specific_geolocation_internal) {
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").html("بله");
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").removeClass("badge-secondary");
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").addClass("badge-primary");
    } else {
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").html("خیر");
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").addClass("badge-secondary");
        product_obj_global.closest("tr").find(".product-specific-geolocation-internal-table").removeClass("badge-primary");
    }

    // update product information in table row - product specific geolocation external 
    if(object_product.product_specific_geolocation_external) {
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").html("بله");
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").removeClass("badge-secondary");
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").addClass("badge-primary");
    } else {
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").html("خیر");
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").addClass("badge-secondary");
        product_obj_global.closest("tr").find(".product-specific-geolocation-external-table").removeClass("badge-primary");
    }

    $("#product-edit-specification-section").hide();
});

$("#list-btn-discard-changes").on("click", $(this), function(){
    $("#product-edit-specification-section").hide();
});



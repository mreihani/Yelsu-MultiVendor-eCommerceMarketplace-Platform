// repeater form function
$('.repeater-body').on('click', '.add-repeater-btn', function(e) {
    e.preventDefault();
    let freightageTypesLoop = '';
    let freightageTypeObject = JSON.parse($("#freightage-type-object").val());
    $this = $(this);

    $.each(freightageTypeObject, function(key, value){
        freightageTypesLoop += `
            <option value="${value.id}">${value.value}</option>
        `; 
    });

    let repeaterBody = `
        <div data-repeatable="">
            <fieldset class="row">
                <!--begin::Row-->
                <div class="row col-md-10 freightage-loader-repeater">
                    <div class="col-md-6">
                        <!--begin::کارت body-->
                        <div class="mb-10 fv-row freightagetype_selection">
                            <!--begin::Tags-->
                            <label class="form-label">تعیین روش ارسال </label>
                            <!--end::Tags-->
                            <!--begin::Input-->
                            <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightagetype_id[]">
                                <option value="0">روش ارسال را انتخاب نمایید</option>
                                ${freightageTypesLoop}
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-md-6">
                        <div class="mb-10 fv-row freightageloadertype_selection">
                            <!--begin::Tags-->
                            <label class="form-label">تعیین نوع بارگیر </label>
                            <!--end::Tags-->
                            <!--begin::Input-->
                            <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightageloadertype_id[]" >
                                <option value="0">نوع بارگیر را انتخاب نمایید</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
                <!--end::Row-->

                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-light-danger del-repeater-btn">
                        حذف
                        <i class="bi bi-patch-minus-fill"></i>
                    </button>
                </div>
            </fieldset>
        </div>
    `;

    let repeaterRoot = $this.closest(".repeater-body").find(".repeater");
    repeaterRoot.append(repeaterBody);

    $('.yelsu-select2-basic-single').select2();
});

$(".repeater-body").click(function(e) {
    if($(e.target).hasClass("del-repeater-btn") && $(e.target).closest(".repeater-body").find($("[data-repeatable]")).length > 1) {
        $(e.target).closest("[data-repeatable]").remove();
    }
});

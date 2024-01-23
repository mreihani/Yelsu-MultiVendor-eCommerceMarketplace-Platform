// repeater form function
$('.repeater-body').on('click', '.add-repeater-btn', function(e) {
    $this = $(this);
    e.preventDefault();

    let freightageTypesLoop = '';
    let freightageTypeObject = JSON.parse($("#freightage-type-object").val());
    
    let originLoaderTypeLoop = '';
    let originLoaderTypeObject = JSON.parse($("#origin-loadertype-outlet").val());

    $.each(originLoaderTypeObject, function(key, value) {
        originLoaderTypeLoop += `
            <option value="${value.id}">${value.shop_name}</option>
        `;
    })

    $.each(freightageTypeObject, function(key, value) {
        freightageTypesLoop += `
            <option value="${value.id}">${value.value}</option>
        `; 
    });

    let repeaterBody = `
        <div data-repeatable="" class="mb-10 notice bg-light-primary rounded border-primary border border-dashed p-6">
            <fieldset class="row">
                <!--begin::Row-->
                <div class="row col-md-12 freightage-loader-repeater">
                    <div class="col-md-12">
                        <!--begin::کارت body-->
                        <div class="mb-10 fv-row">
                            <!--begin::Tags-->
                            <label class="form-label">تعیین مبدا سفارش </label>
                            <!--end::Tags-->
                            <!--begin::Input-->
                            <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="origin_loadertype_outlet[]" style="width: 100%">
                                <option value="0">مبدا سفارش را انتخاب نمایید</option>
                                ${originLoaderTypeLoop}
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::کارت body-->
                        <div class="mb-10 fv-row freightagetype_selection">
                            <!--begin::Tags-->
                            <label class="form-label">تعیین روش ارسال </label>
                            <!--end::Tags-->
                            <!--begin::Input-->
                            <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightagetype_id[]" style="width: 100%">
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
                            <label class="form-label">تعیین نوع بارگیر</label>
                            <!--end::Tags-->
                            <!--begin::Input-->
                            <select class="js-example-basic-single form-control yelsu-select2-basic-single" name="freightageloadertype_id[]" style="width: 100%">
                                <option value="0">نوع بارگیر را انتخاب نمایید</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
                <!--end::Row-->
            </fieldset>
            <fieldset class="row d-flex justify-content-end">
                <div class="col-md-5">
                    <!--begin::Tags-->
                    <label class="form-label">تعیین حداقل مقدار</label>
                    <!--end::Tags-->
                    
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-sm" name="loader_type_min[]" placeholder="به عنوان مثال: 1000">
                    <!--end::Input-->
                </div>
                <div class="col-md-5">
                    <!--begin::Tags-->
                    <label class="form-label">تعیین حداکثر مقدار</label>
                    <!--end::Tags-->
                    
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-sm" name="loader_type_max[]" placeholder="به عنوان مثال: 5000">
                    <!--end::Input-->
                </div>
                <div class="col-md-2 d-flex align-items-end">
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

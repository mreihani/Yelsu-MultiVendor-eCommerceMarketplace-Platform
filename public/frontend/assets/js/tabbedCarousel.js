$(document).ready(function () {
    var petroswiper = new Swiper(".petroCategorySwiper", {
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
        },

        // Responsive breakpoints
        breakpoints: {
            // when window width is <= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is <= 480px
            1000: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
            // when window width is <= 640px
            1500: {
                slidesPerView: 8,
                spaceBetween: 40,
            },
        },
    });

    let petroCategorySwiper = $(".petroCategorySwiper")
        .children("div")
        .eq(0)
        .children("div");

    $(document).on("click", ".nav-filterpetro", function (e) {
        let dataFilter = $(this).data("filter");

        if (dataFilter != "all_categories_petro") {
            $.each(petroCategorySwiper, function (i, element) {
                if (element.classList.contains(dataFilter)) {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            });

            petroswiper.autoplay.stop();
            $(".petroCategorySwiper > div").css(
                "transform",
                "translate3d(0px, 0px, 0px)"
            );
        }

        if (dataFilter == "all_categories_petro") {
            $.each(petroCategorySwiper, function (i, element) {
                element.style.display = "block";
            });
            petroswiper.autoplay.start();
        }
    });

    var steelswiper = new Swiper(".steelCategorySwiper", {
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
        },

        // Responsive breakpoints
        breakpoints: {
            // when window width is <= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is <= 480px
            1000: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
            // when window width is <= 640px
            1500: {
                slidesPerView: 8,
                spaceBetween: 40,
            },
        },
    });

    let steelCategorySwiper = $(".steelCategorySwiper")
        .children("div")
        .eq(0)
        .children("div");

    $(document).on("click", ".nav-filtersteel", function (e) {
        let dataFilter = $(this).data("filter");

        if (dataFilter != "all_categories_steel") {
            $.each(steelCategorySwiper, function (i, element) {
                if (element.classList.contains(dataFilter)) {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            });

            steelswiper.autoplay.stop();
            $(".steelCategorySwiper > div").css(
                "transform",
                "translate3d(0px, 0px, 0px)"
            );
        }

        if (dataFilter == "all_categories_steel") {
            $.each(steelCategorySwiper, function (i, element) {
                element.style.display = "block";
            });
            steelswiper.autoplay.start();
        }
    });

    var miningswiper = new Swiper(".miningCategorySwiper", {
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            // when window width is <= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is <= 480px
            1000: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
            // when window width is <= 640px
            1500: {
                slidesPerView: 8,
                spaceBetween: 40,
            },
        },
    });

    let miningCategorySwiper = $(".miningCategorySwiper")
        .children("div")
        .eq(0)
        .children("div");

    $(document).on("click", ".nav-filtermining", function (e) {
        let dataFilter = $(this).data("filter");

        if (dataFilter != "all_categories_mining") {
            $.each(miningCategorySwiper, function (i, element) {
                if (element.classList.contains(dataFilter)) {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            });

            miningswiper.autoplay.stop();
            $(".miningCategorySwiper > div").css(
                "transform",
                "translate3d(0px, 0px, 0px)"
            );
        }

        if (dataFilter == "all_categories_mining") {
            $.each(miningCategorySwiper, function (i, element) {
                element.style.display = "block";
            });
            miningswiper.autoplay.start();
        }
    });

    var constructionswiper = new Swiper(".constructionCategorySwiper", {
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            // when window width is <= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is <= 480px
            1000: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
            // when window width is <= 640px
            1500: {
                slidesPerView: 8,
                spaceBetween: 40,
            },
        },
    });

    let constructionCategorySwiper = $(".constructionCategorySwiper")
        .children("div")
        .eq(0)
        .children("div");

    $(document).on("click", ".nav-filterconstruction", function (e) {
        let dataFilter = $(this).data("filter");

        if (dataFilter != "all_categories_construction") {
            $.each(constructionCategorySwiper, function (i, element) {
                if (element.classList.contains(dataFilter)) {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            });

            constructionswiper.autoplay.stop();
            $(".constructionCategorySwiper > div").css(
                "transform",
                "translate3d(0px, 0px, 0px)"
            );
        }

        if (dataFilter == "all_categories_construction") {
            $.each(constructionCategorySwiper, function (i, element) {
                element.style.display = "block";
            });
            constructionswiper.autoplay.start();
        }
    });

    setTimeout(function () {
        petroswiper.autoplay.start();
        // steelswiper.autoplay.start();
        // miningswiper.autoplay.start();
        // constructionswiper.autoplay.start();
    }, 1500);
});

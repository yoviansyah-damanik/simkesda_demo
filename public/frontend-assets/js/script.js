$(".counter").each(function () {
    $(this)
        .prop("Counter", 0)
        .animate(
            {
                Counter: $(this).text(),
            },
            {
                duration: 3000,
                easing: "swing",
                step: function (now) {
                    $(this).text(Math.ceil(now).toLocaleString("id-ID"));
                },
            }
        );
});

$(window).on("load", function () {
    $(".preloader").fadeOut();
});

var wow = new WOW({
    boxClass: "wow",
    animateClass: "animate__animated",
    offset: 0,
    mobile: true,
    live: true,
    callback: function (box) {
        //
    },
    scrollContainer: null,
    resetAnimation: true,
});
wow.init();

$(".offcanvas").on({
    "shown.bs.offcanvas": (event) => {
        $("body").addClass("overflow-hidden");
    },
    "hidden.bs.offcanvas": (event) => {
        $("body").removeClass("overflow-hidden");
    },
});

$("form").on("submit", () => {
    $(".preloader").fadeIn();
});

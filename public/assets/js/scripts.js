//   all ------------------
function initCitybook() {
    "use strict";
    //   loader ------------------
    $(".loader-wrap").fadeOut(300, function () {
        $("#main").animate(
            {
                opacity: "1",
            },
            300
        );
    });
    //   Background image ------------------
    var a = $(".bg");
    a.each(function (a) {
        if ($(this).attr("data-bg"))
            $(this).css("background-image", "url(" + $(this).data("bg") + ")");
    });
    //   scrollToFixed------------------
    $(".fixed-bar").scrollToFixed({
        minWidth: 1064,
        marginTop: 90,
        removeOffsets: true,
        limit: function () {
            var a =
                $(".limit-box").offset().top -
                $(".fixed-bar").outerHeight() -
                70;
            return a;
        },
    });
    $(".back-to-filters").scrollToFixed({
        minWidth: 1224,
        zIndex: 12,
        marginTop: 130,
        removeOffsets: true,
        limit: function () {
            var a =
                $(".limit-box").offset().top -
                $(".back-to-filters").outerHeight(true) -
                10;
            return a;
        },
    });
    $(".scroll-nav-wrapper").scrollToFixed({
        minWidth: 768,
        zIndex: 12,
        marginTop: 80,
        removeOffsets: true,
        limit: function () {
            var a =
                $(".limit-box").offset().top -
                $(".scroll-nav-wrapper").outerHeight(true) -
                10;
            return a;
        },
    });
    //   Isotope------------------
    function initIsotope() {
        if ($(".gallery-items").length) {
            var a = $(".gallery-items").isotope({
                singleMode: true,
                columnWidth:
                    ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector:
                    ".gallery-item, .gallery-item-second, .gallery-item-three",
                transformsEnabled: true,
                transitionDuration: "700ms",
                resizable: true,
            });
            a.imagesLoaded(function () {
                a.isotope("layout");
            });
            $(".gallery-filters").on("click", "a.gallery-filter", function (b) {
                var c = $(this).attr("data-filter"),
                    d = $(this).text();
                b.preventDefault();
                var c = $(this).attr("data-filter");
                a.isotope({
                    filter: c,
                });
                $(".gallery-filters a.gallery-filter").removeClass(
                    "gallery-filter-active"
                );
                $(this).addClass("gallery-filter-active");
            });
        }
    }
    initIsotope();
    //   Slick------------------
    var sbp = $(".swiper-button-prev"),
        sbn = $(".swiper-button-next");
    $(".fw-carousel").slick({
        dots: true,
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        centerMode: false,
        arrows: false,
        variableWidth: true,
    });
    sbp.on("click", function () {
        $(".fw-carousel").slick("slickPrev");
    });

    sbn.on("click", function () {
        $(".fw-carousel").slick("slickNext");
    });
    $(".slideshow-container").slick({
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        fade: true,
        cssEase: "ease-in",
        infinite: true,
        speed: 1000,
    });
    $(".single-slider").slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
    });
    sbp.on("click", function () {
        $(this)
            .closest(".single-slider-wrapper")
            .find(".single-slider")
            .slick("slickPrev");
    });
    sbn.on("click", function () {
        $(this)
            .closest(".single-slider-wrapper")
            .find(".single-slider")
            .slick("slickNext");
    });

    $(".slider-container").slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
    });
    $(".slider-container").on("init", function (event, slick) {
        initAutocomplete();
    });
    sbp.on("click", function () {
        $(this)
            .closest(".slider-container-wrap")
            .find(".slider-container")
            .slick("slickPrev");
    });
    sbn.on("click", function () {
        $(this)
            .closest(".slider-container-wrap")
            .find(".slider-container")
            .slick("slickNext");
    });
    $(".single-carousel").slick({
        infinite: true,
        slidesToShow: 3,
        dots: true,
        arrows: false,
        centerMode: true,
        responsive: [
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 2,
                    centerMode: false,
                },
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                },
            },
        ],
    });
    sbp.on("click", function () {
        $(this)
            .closest(".carousel ")
            .find(".single-carousel")
            .slick("slickPrev");
    });
    sbn.on("click", function () {
        $(this)
            .closest(".carousel")
            .find(".single-carousel")
            .slick("slickNext");
    });
    $(".listing-carousel").slick({
        infinite: true,
        slidesToShow: 5,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: "0",
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 4,
                },
            },
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 3,
                },
            },

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });
    sbp.on("click", function () {
        $(this)
            .closest(".list-carousel")
            .find(".listing-carousel")
            .slick("slickPrev");
    });
    sbn.on("click", function () {
        $(this)
            .closest(".list-carousel")
            .find(".listing-carousel")
            .slick("slickNext");
    });
    $(".client-carousel").slick({
        infinite: true,
        slidesToShow: 5,
        dots: false,
        arrows: false,
        centerMode: true,
        responsive: [
            {
                breakpoint: 1224,
                settings: {
                    slidesToShow: 4,
                    centerMode: false,
                },
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                },
            },
        ],
    });
    $(".sp-cont-prev").on("click", function () {
        $(this)
            .closest(".spons-list")
            .find(".client-carousel")
            .slick("slickPrev");
    });
    $(".sp-cont-next").on("click", function () {
        $(this)
            .closest(".spons-list")
            .find(".client-carousel")
            .slick("slickNext");
    });
    //   Bubbles ------------------
    $('<div class="bubbles"></div>').appendTo(".bubble-bg");
    var bArray = [];
    var sArray = [5, 10, 15, 20];
    for (var i = 0; i < $(".bubbles").width(); i++) {
        bArray.push(i);
    }
    function randomValue(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    }
    setInterval(function () {
        var size = randomValue(sArray);
        $(".bubbles").append(
            '<div class="individual-bubble" style="left: ' +
                randomValue(bArray) +
                "px; width: " +
                size +
                "px; height:" +
                size +
                'px;"></div>'
        );
        $(".individual-bubble").fadeOut(5000, function () {
            $(this).remove();
        });
    }, 350);
    //   lightGallery------------------
    $(".image-popup").lightGallery({
        selector: "this",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        counter: false,
    });
    var o = $(".lightgallery"),
        p = o.data("looped");
    o.lightGallery({
        selector: ".lightgallery a.popup-image",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        loop: false,
        counter: false,
    });
    //   appear------------------
    $(".stats").appear(function () {
        $(".num").countTo();
    });
    // Share   ------------------
    $(".share-container").share({
        networks: [
            "facebook",
            "pinterest",
            "googleplus",
            "twitter",
            "linkedin",
        ],
    });
    var shrcn = $(".share-container");
    function showShare() {
        shrcn.removeClass("isShare");
        shrcn.addClass("visshare");
    }
    function hideShare() {
        shrcn.addClass("isShare");
        shrcn.removeClass("visshare");
    }
    $(".showshare").on("click", function () {
        $(this).toggleClass("vis-butsh");
        $(this)
            .find("span")
            .text($(this).text().trim() === "Cerrar" ? "Compartir" : "Cerrar");
        if ($(".share-container").hasClass("isShare")) showShare();
        else hideShare();
    });

    //   accordion ------------------
    $(".accordion a.toggle").on("click", function (a) {
        a.preventDefault();
        $(".accordion a.toggle").removeClass("act-accordion");
        $(this).addClass("act-accordion");
        if ($(this).next("div.accordion-inner").is(":visible")) {
            $(this).next("div.accordion-inner").slideUp();
        } else {
            $(".accordion a.toggle").next("div.accordion-inner").slideUp();
            $(this).next("div.accordion-inner").slideToggle();
        }
    });
    //   tabs------------------
    $(".tabs-menu a").on("click", function (a) {
        a.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var b = $(this).attr("href");
        $(".tab-content").not(b).css("display", "none");
        $(b).fadeIn();
    });
    //   Contact form------------------
    $(document).on("submit", "#contactform", function () {
        var a = $(this).attr("action");
        $("#message").slideUp(750, function () {
            $("#message").hide();
            $("#submit").attr("disabled", "disabled");
            $.post(
                a,
                {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    comments: $("#comments").val(),
                },
                function (a) {
                    document.getElementById("message").innerHTML = a;
                    $("#message").slideDown("slow");
                    $("#submit").removeAttr("disabled");
                    if (null != a.match("success"))
                        $("#contactform").slideDown("slow");
                }
            );
        });
        return false;
    });
    $(document).on(
        "keyup",
        "#contactform input, #contactform textarea",
        function () {
            $("#message").slideUp(1500);
        }
    );
    //   mailchimp------------------
    $("#subscribe").ajaxChimp({
        language: "eng",
        url: "https://gmail.us1.list-manage.com/subscribe/post?u=1fe818378d5c129b210719d80&amp;id=a2792f681b",
    });
    $.ajaxChimp.translations.eng = {
        submit: "Submitting...",
        0: '<i class="fa fa-check"></i> We will be in touch soon!',
        1: '<i class="fa fa-warning"></i> You must enter a valid e-mail address.',
        2: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        3: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        4: '<i class="fa fa-warning"></i> E-mail address is not valid.',
        5: '<i class="fa fa-warning"></i> E-mail address is not valid.',
    };
    //   Video------------------
    var v = $(".background-youtube-wrapper").data("vid");
    var f = $(".background-youtube-wrapper").data("mv");
    $(".background-youtube-wrapper").YTPlayer({
        fitToBackground: true,
        videoId: v,
        pauseOnScroll: true,
        mute: f,
        callback: function () {
            var a = $(".background-youtube-wrapper").data("ytPlayer").player;
        },
    });

    var w = $(".background-vimeo").data("vim"),
        bvc = $(".background-vimeo"),
        bvmc = $(".media-container"),
        bvfc = $(".background-vimeo iframe "),
        vch = $(".video-container");
    bvc.append(
        '<iframe src="//player.vimeo.com/video/' +
            w +
            '?background=1"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>'
    );
    $(".video-holder").height(bvmc.height());
    if ($(window).width() > 1024) {
        if ($(".video-holder").length > 0)
            if ((bvmc.height() / 9) * 16 > bvmc.width()) {
                bvfc.height(bvmc.height()).width((bvmc.height() / 9) * 16);
                bvfc.css({
                    "margin-left": (-1 * $("iframe").width()) / 2 + "px",
                    top: "-75px",
                    "margin-top": "0px",
                });
            } else {
                bvfc.width($(window).width()).height(
                    ($(window).width() / 16) * 9
                );
                bvfc.css({
                    "margin-left": (-1 * $("iframe").width()) / 2 + "px",
                    "margin-top": (-1 * $("iframe").height()) / 2 + "px",
                    top: "50%",
                });
            }
    } else if ($(window).width() < 760) {
        $(".video-holder").height(bvmc.height());
        bvfc.height(bvmc.height());
    } else {
        $(".video-holder").height(bvmc.height());
        bvfc.height(bvmc.height());
    }
    vch.css("width", $(window).width() + "px");
    vch.css("height", (720 / 1280) * $(window).width()) + "px";
    if (vch.height() < $(window).height()) {
        vch.css("height", $(window).height() + "px");
        vch.css("width", (1280 / 720) * $(window).height()) + "px";
    }
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        var a = 70 + $(".scroll-nav-wrapper").height();
        if (
            location.pathname.replace(/^\//, "") ===
                this.pathname.replace(/^\//, "") ||
            location.hostname === this.hostname
        ) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate(
                    {
                        scrollTop: b.offset().top - a,
                    },
                    {
                        queue: false,
                        duration: 1200,
                        easing: "easeInOutExpo",
                    }
                );
                return false;
            }
        }
    });
    $(".scroll-init  ul ").singlePageNav({
        filter: ":not(.external)",
        updateHash: false,
        offset: 110,
        threshold: 120,
        speed: 1200,
        currentClass: "act-scrlink",
    });
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            800
        );
        return false;
    });
    // scroll animation ------------------
    $(window).on("scroll", function (a) {
        if ($(this).scrollTop() > 150) {
            $(".to-top").fadeIn(500);
        } else {
            $(".to-top").fadeOut(500);
        }
    });
    // collage image position ------------------
    $(".images-collage-item").each(function () {
        var tcp = $(this),
            dpl = tcp.data("position-left"),
            dpt = tcp.data("position-top"),
            dzi = tcp.data("zindex");
        tcp.css({
            top: dpt + "%",
        });
        tcp.css({
            "z-index": dzi,
        });
        tcp.css({
            left: dpl + "%",
        });
    });
    // modal ------------------
    var modal = {};
    modal.hide = function () {
        $(".modal").fadeOut();
        $("html, body").removeClass("hid-body");
    };
    $(".modal-open").on("click", function (e) {
        e.preventDefault();
        $(".modal").fadeIn();
        $("html, body").addClass("hid-body");
    });
    $(".close-reg").on("click", function () {
        modal.hide();
    });
    // click ------------------
    $(".more-filter-option").on("click", function () {
        $(".hidden-listing-filter").slideToggle(500);
        $(this).find("span").toggleClass("mfilopact");
    });
    $(".show-search-button").on("click", function () {
        $(".vis-header-search").slideToggle(500);
    });
    $(".listing-view-layout li a.list").on("click", function (e) {
        e.preventDefault();
        $(".listing-view-layout li a").removeClass("active");
        $(".listing-item").addClass("list-layout");
        $(this).addClass("active");
    });
    $(".listing-view-layout li a.grid").on("click", function (e) {
        e.preventDefault();
        $(".listing-view-layout li a").removeClass("active");
        $(".listing-item").removeClass("list-layout");
        $(this).addClass("active");
    });
    // Forms ------------------
    $(document).on("change", ".leave-rating input", function () {
        var $radio = $(this);
        $(".leave-rating .selected").removeClass("selected");
        $radio.closest("label").addClass("selected");
    });

    $(".chosen-select").niceSelect();
    $('input[type="range"].distance-radius').rangeslider({
        polyfill: false,
        onInit: function () {
            this.output = $(".distance-title span").html(this.$element.val());
        },
        onSlide: function (position, value) {
            this.output.html(value);
        },
    });
    $("input.datepicker").dateDropper();
    $("input.timepicker").timeDropper({
        setCurrentTime: false,
        meridians: true,
        primaryColor: "#4DB7FE",
        borderColor: "#4DB7FE",
        minutesInterval: "15",
    });
    $(".eye").on("click touchstart", function () {
        var epi = $(this).parent(".pass-input-wrap").find("input");
        if (epi.attr("type") === "password") {
            epi.attr("type", "text");
        } else {
            epi.attr("type", "password");
        }
    });
    var datacityw = $("#weather-widget").data("city");

    $("#weather-widget").ideaboxWeather({
        location: datacityw,
    });

    // Styles ------------------
    if ($("footer.main-footer").hasClass("fixed-footer")) {
        $('<div class="height-emulator fl-wrap"></div>').appendTo("#main");
    }
    function csselem() {
        $(".height-emulator").css({
            height: $(".fixed-footer").outerHeight(true),
        });
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true),
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true),
        });
        $(".map-container.column-map").css({
            height: $(window).outerHeight(true) - 80 + "px",
        });
    }
    csselem();
    // Mob Menu------------------
    $(".nav-button-wrap").on("click", function () {
        $(".main-menu").toggleClass("vismobmenu");
    });
    function mobMenuInit() {
        var ww = $(window).width();
        if (ww < 1064) {
            $(".menusb").remove();
            $(".main-menu").removeClass("nav-holder");
            $(".main-menu nav")
                .clone()
                .addClass("menusb")
                .appendTo(".main-menu");
            $(".menusb").menu();
        } else {
            $(".menusb").remove();
            $(".main-menu").addClass("nav-holder");
        }
    }
    mobMenuInit();
    //   css ------------------
    var $window = $(window);
    $window.on("resize", function () {
        csselem();
        mobMenuInit();
    });
    $(".box-cat").on({
        mouseenter: function () {
            var a = $(this).data("bgscr");
            $(".bg-ser").css("background-image", "url(" + a + ")");
        },
    });
    $(".header-user-name").on("click", function () {
        $(".header-user-menu ul").toggleClass("hu-menu-vis");
        $(this).toggleClass("hu-menu-visdec");
    });
    // Counter ------------------
    if ($(".counter-widget").length > 0) {
        var countCurrent = $(".counter-widget").attr("data-countDate");
        $(".countdown").downCount({
            date: countCurrent,
            offset: 0,
        });
    }

    function showBookingForm() {
        $(".booking-modal-wrap , .bmw-overlay").fadeIn(400);
        $("html, body").addClass("hid-body");
    }
    function hideBookingForm() {
        $(".booking-modal-wrap , .bmw-overlay").fadeOut(400);
        $("html, body").removeClass("hid-body");
    }
    $(".booking-modal-close , .bmw-overlay").on("click", function () {
        hideBookingForm();
    });
    $(".book-btn").on("click", function (e) {
        e.preventDefault();
        showBookingForm();
    });

    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;
    $(".next-form").on("click", function (e) {
        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        $("#progressbar li")
            .eq($(".bookiing-form-wrap fieldset").index(next_fs))
            .addClass("active");
        next_fs.show();
        current_fs.animate(
            {
                opacity: 0,
            },
            {
                step: function (now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = now * 50 + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        transform: "scale(" + scale + ")",
                        position: "absolute",
                    });
                    next_fs.css({
                        left: left,
                        opacity: opacity,
                        position: "relative",
                    });
                },
                duration: 1200,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                easing: "easeInOutBack",
            }
        );
    });
    $(".back-form").on("click", function (e) {
        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li")
            .eq($(".bookiing-form-wrap fieldset").index(current_fs))
            .removeClass("active");
        previous_fs.show();
        current_fs.animate(
            {
                opacity: 0,
            },
            {
                step: function (now, mx) {
                    scale = 0.8 + (1 - now) * 0.2;
                    left = (1 - now) * 50 + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        left: left,
                        position: "absolute",
                    });
                    previous_fs.css({
                        transform: "scale(" + scale + ")",
                        opacity: opacity,
                        position: "relative",
                    });
                },
                duration: 1200,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                easing: "easeInOutBack",
            }
        );
    });
}
//   Parallax ------------------
function initparallax() {
    var a = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (
                a.Android() ||
                a.BlackBerry() ||
                a.iOS() ||
                a.Opera() ||
                a.Windows()
            );
        },
    };
    trueMobile = a.any();
    if (null === trueMobile) {
        var b = new Scrollax();
        b.reload();
        b.init();
    }
    if (trueMobile)
        $(".bgvid , .background-vimeo , .background-youtube-wrapper ").remove();
}
//   Star Raiting ------------------
function cardRaining() {
    $.fn.duplicate = function (a, b) {
        var c = [];
        for (var d = 0; d < a; d++) $.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
    var cr = $(".card-popup-raining");
    cr.each(function (cr) {
        var starcount = $(this).attr("data-starrating");
        $("<i class='fa fa-star'></i>").duplicate(starcount).prependTo(this);
    });
}
cardRaining();
var cr2 = $(".card-popup-rainingvis");
cr2.each(function (cr) {
    var starcount2 = $(this).attr("data-starrating2");
    $("<i class='fa fa-star'></i>").duplicate(starcount2).prependTo(this);
});
$(".location a , .loc-act").on("click", function (e) {
    e.preventDefault();
    $.get(
        "http://ipinfo.io",
        function (response) {
            $(".location input , .qodef-archive-places-search").val(
                response.city
            );
        },
        "jsonp"
    );
});
$(".fuzone input").each(function () {
    $(this).on("change", function () {
        var pufzone = $(this).parents(".fuzone").find(".photoUpload-files");
        pufzone.empty();
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            $("<span></span>").text(files[i].name).appendTo(pufzone);
        }
    });
});
$(".quantity-item").each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="text"]'),
        btnUp = spinner.find(".plus"),
        btnDown = spinner.find(".minus"),
        min = input.attr("min"),
        max = input.attr("max");

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input.qty").val(newVal);
        spinner.find("input.qty").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input.qty").val(newVal);
        spinner.find("input.qty").trigger("change");
    });
});
function initAutocomplete() {
    var input = document.getElementById("autocomplete-input");
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener("place_changed", function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert(
                "No details available for input: '" + place.name + "'"
            );
            return;
        }
    });
}
$(".notification-close").on("click", function () {
    $(this).parent(".notification").slideUp(500);
});

var chatwidwrap = $(".chat-widget_wrap"),
    cahtwidbutton = $(".chat-widget-button");
function showChat() {
    cahtwidbutton.addClass("closechat_btn");
    chatwidwrap.fadeIn(500).removeClass("not-vis-chat");
}
function hideChat() {
    cahtwidbutton.removeClass("closechat_btn");
    chatwidwrap.fadeOut(500).addClass("not-vis-chat");
}
cahtwidbutton.on("click", function () {
    if (chatwidwrap.hasClass("not-vis-chat")) {
        showChat();
    } else {
        hideChat();
    }
});
document.addEventListener("gesturestart", function (e) {
    e.preventDefault();
});
//   Init All ------------------
$(function () {
    initCitybook();
    initparallax();
});

(function ($) {

    "use strict";


    // -------------------------------------------------------------
    //      Sticky Menu
    // -------------------------------------------------------------

    function stickMenu() {
        if ($(".navbar , .tab-bar").length) {
            var nav = $('.navbar , .tab-bar'),
                    scrolled = false,
                    top = $(window).scrollTop();

            if (110 < top && !scrolled) {
                nav.addClass('fixed animated fadeInDown').animate({'margin-top': '0px'});
                scrolled = true;
            } else {
                nav.removeClass('fixed animated fadeInDown').css('margin-top', '0px');
                scrolled = false;
            }
        }
    }


    /*--------------------------------------------------------------
     Offcanvas Menu
     --------------------------------------------------------------*/
    function offcanvasMenu() {
        if ($("#menu").length) {
            $("#menu").slicknav();
        }
    }


    /*--------------------------------------------------------------
     Jquery light Box
     --------------------------------------------------------------*/
    function popupPrettyPhoto() {
        if ($(".p-photo").length) {
            $("a[data-gal^='prettyPhoto'").prettyPhoto({hook: "data-gal"});
        }
    }


    /*--------------------------------------------------------------
     Jquery Parralax
     --------------------------------------------------------------*/
    function parallaxDo() {
        if ($(".parallax-window").length) {
            $(".parallax-window").parallax({
                speed: 0.9,
                positionY: "-100px"
            });
        }
    }


    /*--------------------------------------------------------------
     Price-Change-Option
     --------------------------------------------------------------*/

    //Setup price slider (Price Range) 
    if ($(".priceSlider").length) {
        var priceSlider = $(".priceSlider"),
                Link = $.noUiSlider.Link;

        priceSlider.noUiSlider({
            range: {
                'min': 1200,
                'max': 100500,
            },
            start: [15000, 90500],
            step: 1000,
            margin: 0,
            connect: true,
            direction: 'ltr',
            orientation: 'horizontal',
            behaviour: 'tap-drag',
            serialization: {
                lower: [
                    new Link({
                        target: $(".price-min")
                    })
                ],
                upper: [
                    new Link({
                        target: $(".price-max")
                    })
                ],
                format: {
                    // Set formatting
                    decimals: 0,
                    thousand: ',',
                    prefix: '$'
                }
            }
        });
    }


    //Setup price slider (Price Range) 
    if ($(".spSlider").length) {
        var spSlider = $(".spSlider"),
                Link = $.noUiSlider.Link;

        spSlider.noUiSlider({
            range: {
                'min': 800,
                'max': 24000,
            },
            start: [4000, 22000],
            step: 200,
            margin: 0,
            connect: true,
            direction: 'ltr',
            orientation: 'horizontal',
            behaviour: 'tap-drag',
            serialization: {
                lower: [
                    new Link({
                        target: $(".spft-min")
                    })
                ],
                upper: [
                    new Link({
                        target: $(".spft-max")
                    })
                ],
                format: {
                    // Set formatting
                    decimals: 0,
                    thousand: ',',
                    prefix: ''
                }
            }
        });
    }


    //Setup price slider (Price Range) for home 3
    if ($(".priceFilter").length) {
        var priceFilter = $(".priceFilter"),
                Link = $.noUiSlider.Link;

        priceFilter.noUiSlider({
            range: {
                'min': 400,
                'max': 100000,
            },
            start: [22000, 74000],
            step: 200,
            margin: 0,
            connect: true,
            direction: 'ltr',
            orientation: 'horizontal',
            behaviour: 'tap-drag',
            serialization: {
                lower: [
                    new Link({
                        target: $(".price-min")
                    })
                ],
                upper: [
                    new Link({
                        target: $(".price-max")
                    })
                ],
                format: {
                    // Set formatting
                    decimals: 0,
                    thousand: ',',
                    prefix: '$'
                }
            }
        });
    }



    /*--------------------------------------------------------------
     Showcase Feature Slider Area
     --------------------------------------------------------------*/

    // Fact Counter
    function estertoCounter() {
        if ($('.estetoCounterCount').length) {
            $('.estetoCounterCount .counter.animated').each(function () {

                var $this = $(this),
                        n = $this.find(".count-text").attr("data-stop"),
                        r = parseInt($this.find(".count-text").attr("data-speed"), 10);

                if (!$this.hasClass("counted")) {
                    $this.addClass("counted");
                    $({
                        countNum: $this.find(".count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function () {
                            $this.find(".count-text").text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.find(".count-text").text(this.countNum);
                        }
                    });
                }
            });
        }
    }



    /* ---------------------------------------------------
     PORTFOLIO FILTERING
     ---------------------------------------------------- */
    function filtering() {
        if ($(".filter-item").length) {
            shuffleme.init();
        }
    }



    /* ---------------------------------------------------
     TESTIMONIAL CAROUSEL
     ---------------------------------------------------- */
    if ($(".testmonialsCarousel").length) {
        $(".testmonialsCarousel").slick({
            autoplay: false,
            centerMode: true,
            centerPadding: '0',
            speed: '400',
            arrows: true,
            slidesToShow: 3,
            prevArrow: "<img class='longOrangeLeftArrow prev slick-prev' src='images/icons/orange_leftArrow.png'>",
            nextArrow: "<img class='longOrangeRightArrow next slick-next' src='images/icons/orange_rightArrow.png'>",
            responsive: [
                {
                    breakpoint: 1500,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '70px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '100px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    }


    // testmonialsCarousel
    if ($(".testmonialsCarouselBox").length) {
        $(".testmonialsCarouselBox").slick({
            autoplay: false,
            centerMode: true,
            centerPadding: '0',
            arrows: true,
            // fade: true,
            slidesToShow: 1,
            prevArrow: "<img class='longOrangeLeftArrow prev slick-prev' src='images/icons/orange_leftArrow.png'>",
            nextArrow: "<img class='longOrangeRightArrow next slick-next' src='images/icons/orange_rightArrow.png'>",
            responsive: [
                {
                    breakpoint: 1500,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '70px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '100px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    }



    /*--------------------------------------------------------------
     lovemoreProperty
     --------------------------------------------------------------*/
    if ($(".lovemoreProperty").length) {
        $(".lovemoreProperty").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: "<img class='bigLeftArrow prev slick-prev' src='images/icons/big_leftArrow.png'>",
            nextArrow: "<img class='bigRightArrow next slick-next' src='images/icons/big_rightArrow.png'>"
        });
    }



    /*--------------------------------------------------------------
     CottageImgSlider
     --------------------------------------------------------------*/
    function cottageImageSlider() {
        if ($(".cottageImgSlider").length) {
            $(".cottageImgSlider").slick({
                autoplay: true,
                autoplaySpeed: 1500,
                centerMode: true,
                centerPadding: '150px',
                slidesToShow: 1,
                prevArrow: "<img class='bigLeftArrow prev slick-prev' src='images/icons/orange_leftArrow.png'>",
                nextArrow: "<img class='bigRightArrow next slick-next' src='images/icons/orange_rightArrow.png'>",
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
    }



    /*--------------------------------------------------------------
     Header Menu search open colose
     --------------------------------------------------------------*/
    

    /*--------------------------------------------------------------
     BestThemeInMarket-Fade- Slider
     --------------------------------------------------------------*/
    if ($(".bestThemeInMarket").length) {
        $(".bestThemeInMarket").slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
        });
    }



    /*--------------------------------------------------------------
     singleItemCarousel
     --------------------------------------------------------------*/
    if ($(".singleItemCarousel").length) {
        $(".singleItemCarousel").slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false
        });
    }



    /*--------------------------------------------------------------
     CompanyLogo Carousel
     --------------------------------------------------------------*/
    if ($(".partnerCompanyLogo").length) {
        $(".partnerCompanyLogo").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 1000,
            responsive: [
                {breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }


    /*--------------------------------------------------------------
     GalleryGrid
     --------------------------------------------------------------*/
    if ($(".masonry-grid-home").length) {
        $(".masonry-grid-home").masonry({});
    }

    function masonryGrid() {
        if ($(".grid").length) {
            $(".grid").masonry({});
        }
    }



    /*--------------------------------------------------------------
     tweetsItemCarousel
     --------------------------------------------------------------*/
    if ($(".tweetsItemCarousel").length) {
        $(".tweetsItemCarousel").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
            autoplay: false,
            vertical: true,
            autoplaySpeed: 1000,
            responsive: [
                {breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }



    /*--------------------------------------------------------------
     Floor plan accordion
     --------------------------------------------------------------*/
    function toggleFloorsPlanAccrodion() {
        if ($("#accordianShortCode .accordionRow").length) {
            var accordionBtn = $("#accordianShortCode .accordionRow > a"),
                    accordionContent = $("#accordianShortCode .accordionRow > .accordion-content");

            accordionBtn.on("click", function (e) {
                var $this = $(this);

                if ($this.parent().has("div")) {
                    e.preventDefault();
                }

                if (!$this.hasClass("activeLine")) {
                    // hide any open menus and remove all other classes
                    accordionBtn.removeClass("activeLine");
                    accordionBtn.find(".accordion-content").removeClass("opened");
                    accordionContent.slideUp(500);

                    // open our new menu and add the activeLine class
                    $this.addClass("activeLine");
                    accordionContent.addClass("opened");
                    $this.next(".accordion-content").slideDown(500);
                } else if ($this.hasClass("activeLine")) {
                    $this.removeClass("activeLine");
                    accordionContent.removeClass("opened");
                    $this.next(".accordion-content").slideUp(500);
                }
            });
        }
    }



    // -------------------------------------------------------------
    //       Google-map-Area
    // -------------------------------------------------------------

    // Google-map-One
    function mapStyle1() {
        if ($("#googleMap1").length) {
            var uluru = {lat: 22.863445, lng: 89.516730};

            var contentString = '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h1 id="firstHeading" class="firstHeading">Position</h1>' +
                    '<div id="bodyContent">' +
                    '<p>That u find</p>' +
                    '</div>' +
                    '</div>';

            $('#googleMap1')
                    .gmap3({
                        zoom: 14,
                        center: uluru
                    })

                    .marker({
                        position: uluru
                    })

                    .infowindow({
                        content: contentString
                    })

                    .then(function (infowindow) {
                        var map = this.get(0);
                        var marker = this.get(1);
                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });
                    });
        }
    }


    // Google-map-Two / Four / Seven
    function mapStyle2() {
        if ($('#googleMap4').length || $('#googleMap7').length) {

            var uluru = {lat: 22.863445, lng: 89.516730};

            var contentString = '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h1 id="firstHeading" class="firstHeading">Position</h1>' +
                    '<div id="bodyContent">' +
                    '<p>That u find</p>' +
                    '</div>' +
                    '</div>';

            $('#googleMap4,#googleMap7')
                    .gmap3({
                        zoom: 11,
                        center: uluru
                    })
                    .marker({
                        position: uluru,
                        icon: "images/map.png"
                    })
                    .infowindow({
                        content: contentString
                    })
                    .then(function (infowindow) {
                        var map = this.get(0);
                        var marker = this.get(1);
                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });
                    });
        }
    }


    // Google-map-Five
    function mapStyle3() {
        if ($('#googleMap5').length) {
            $('#googleMap5')
                    .gmap3({
                        address: "Haltern am See, Weseler Str. 151",
                        zoom: 11,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    })

                    .marker(function (map) {
                        return {
                            position: map.getCenter(),
                            icon: 'images/map2.png'
                        };
                    });
        }
    }


    // Google-map-Six
    function mapStyle4() {
        if ($("#googleMap6").length) {
            $("#googleMap6")
                    .gmap3({
                        address: "Haltern am See, Weseler Str. 151",
                        zoom: 11,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    })
                    .marker(function (map) {
                        return {
                            position: map.getCenter(),
                            icon: 'images/map4.png'
                        };
                    })
                    ;
        }
    }


    // Google-map-Eight
    function mapStyle5() {
        if ($("#googleMap8").length || $("#googleMap2").length) {
            var pos = [41.797916, -93.278046];
            $("#googleMap8,#googleMap2")
                    .gmap3({
                        center: pos,
                        zoom: 13,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    })
                    .marker({
                        position: pos,
                        icon: 'images/map8.png'
                    })
                    .overlay({
                        position: pos,
                        content: '<div style="width:200px; height: 50px;">' +
                                '<img src="images/adress.png">' +
                                '</div>',
                        x: -260,
                        y: -80
                    })
                    ;
        }
    }


    // Google-map-Three
    function mapStyle6() {
        if ($("#googleMap3").length) {
            $("#googleMap3").mapit();
        }
    }


    /*--------------------------------------------------------------
     Showcase Feature Slider Area 2
     --------------------------------------------------------------*/

    // $(function () { 
    //     $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
    // });  



    // -------------------------------------------------------------
    // WOW JS
    // -------------------------------------------------------------
    var wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // default
        offset: 0, // default
        mobile: true, // default
        live: true        // default
    });



    // -------------------------------------------------------------
    //      Progress Bar
    // -------------------------------------------------------------
    if ($(".progressSection .progress-bar").length) {
        var $progress_bar = $('.progress-bar');
        $progress_bar.appear();
        $(document.body).on('appear', '.progress-bar', function () {
            var current_item = $(this);
            if (!current_item.hasClass('appeared')) {
                $(this).css('width', $(this).attr('aria-valuenow') + '%').addClass('appeared');
            }
        });
    }
    ;



    // -------------------------------------------------------------
    //      Pre-Loader
    // -------------------------------------------------------------
    function preloader() {
        if ($('#preloader').length) {
            Pace.on('done', function () {
                $('#preloader').delay(500).fadeOut(800);
            });
        }
    }



    // -------------------------------------------------------------
    //      Back To Top
    // -------------------------------------------------------------

    function backToTopBtnAppear() {
        if ($("#toTop").length) {
            var windowpos = $(window).scrollTop(),
                    backToTopBtn = $("#toTop");

            if (windowpos > 300) {
                backToTopBtn.fadeIn();
            } else {
                backToTopBtn.fadeOut();
            }
        }
    }

    function backToTop() {
        if ($("#toTop").length) {
            var backToTopBtn = $("#toTop");
            backToTopBtn.on("click", function () {
                $("html, body").animate({
                    scrollTop: 0
                }, 1000);

                return false;
            })
        }
    }


    // -------------------------------------------------------------
    //      WHEN WINDOW LOAD
    // -------------------------------------------------------------
    $(window).on("load", function () {

        preloader();

        offcanvasMenu();

        wow.init();

        popupPrettyPhoto();

        parallaxDo();

        filtering();

        cottageImageSlider();

        masonryGrid();

        toggleFloorsPlanAccrodion();

        mapStyle1();

        mapStyle2();

        mapStyle3();

        mapStyle4();

        mapStyle5();

        mapStyle6();

        backToTop();

    });


    // -------------------------------------------------------------
    //      WHEN WINDOW SCROLL
    // -------------------------------------------------------------
    $(window).on("scroll", function () {

        stickMenu();

        backToTopBtnAppear();

        estertoCounter();

    });


})(window.jQuery);

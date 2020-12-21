// top to bottom
$(document).on('click', '.top-bottom-inner', function () {
    $('html, body').animate({
        scrollTop: 0
    }, 600);
});
// endtop to bottom


$(document).ready(function () {

    // mobile Menu
    $(window).on('load resize', function () {
        if ($(window).width() <= 991) {
            $('.header-search-wrapper').insertAfter('.header-menu-center')
        } else {
            $('.header-search-wrapper').insertAfter('.header-bottom-inner .col-lg-4.col-md-4.col-sm-5')
        }
    });
    // end mobile Menu

    // category
    $('.category').owlCarousel({
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            800: {
                items: 4,
                nav: false
            },
            992: {
                items: 4,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: true
            }
        }
    });
    // end category

    // start blog :: Savan ::
    window.blogOwlCarousel = {
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: false,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 1,
                nav: false
            },
            550: {
                items: 2,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            800: {
                items: 2,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: true
            }
        }
    };
    // end blog :: Savan ::

    // bestSellers
    var bestSellers = $('.bestsellers');
    bestSellers.owlCarousel({
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: true
            },
            576: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: true
            }
        }
    });
    $(window).on('load resize', function () {
        if ($(window).width() > 999) {
            $('.bestsellers .owl-item.active').removeClass('zoom-img');
            $('.bestsellers .owl-item.active').eq(2).addClass('zoom-img');
        } else {
            $('.bestsellers .owl-item.active').removeClass('zoom-img');
            $('.bestsellers .owl-item.active').eq(1).addClass('zoom-img');
        }
    });
    bestSellers.on('translated.owl.carousel', function () {
        if ($(window).width() > 999) {
            $('.bestsellers .owl-item.active').removeClass('zoom-img');
            $('.bestsellers .owl-item.active').eq(2).addClass('zoom-img');
        } else {
            $('.bestsellers .owl-item.active').removeClass('zoom-img');
            $('.bestsellers .owl-item.active').eq(1).addClass('zoom-img');
        }
    });
    // end bestSellers

    // product :: Savan ::
    window.productOwlCarousel = {
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            575: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            768: {
                items: 3,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1300: {
                items: 3,
                nav: true,
                loop: true
            }
        }
    };
    // end product :: Savan ::

    // tab-featured-product
    $('.tab-featured-product').owlCarousel({
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            575: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1200: {
                items: 4,
                nav: false
            },
            1300: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });
    // end tab-featured-product

    // tab-new-product
    $('.tab-new-product').owlCarousel({
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            575: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1200: {
                items: 4,
                nav: false
            },
            1300: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });
    // end tab-new-product

    // tab-best-product
    $('.tab-best-product').owlCarousel({
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            575: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1200: {
                items: 4,
                nav: false
            },
            1300: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });
    // end tab-best-product

    // start testimonial :: Savan ::
    window.testimonialOwlCarousel = {
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: false,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            576: {
                items: 2,
                nav: false
            },
            991: {
                items: 2,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: true
            }
        }
    };
    $(document).on('click', '.pagin .pagin-btn.btn-prev', function () {
        if ($(this).hasClass('tab')) {
            $('.tabcontent').each(function () {
                if ($(this).css('display') == 'block') {
                    let tabId = $(this).attr('id');
                    $('#' + tabId).find('.owl-nav .owl-prev').trigger('click')
                }
            });
        } else {
            $(this).parent().parent().parent().find('.owl-nav .owl-prev').trigger('click');
        }
    });
    $(document).on('click', '.pagin .pagin-btn.btn-next', function () {
        if ($(this).hasClass('tab')) {
            $('.tabcontent').each(function () {
                if ($(this).css('display') == 'block') {
                    let tabId = $(this).attr('id');
                    $('#' + tabId).find('.owl-nav .owl-next').trigger('click')
                }
            });
        } else {
            $(this).parent().parent().parent().find('.owl-nav .owl-next').trigger('click');
        }
    });
    // end testimonial :: Savan ::

    // Product-page

    // multiproduct

    $('.multiproduct').owlCarousel({
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            480: {
                items: 3,
                nav: false
            },
            600: {
                items: 4,
                nav: false
            },
            991: {
                items: 5,
                nav: false
            },
            992: {
                items: 4,
                nav: false
            },
            1000: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });
    $(document).on('click', '.multiproduct-btn .btn-prev', function () {
        $('.multiproduct .owl-nav .owl-prev').trigger('click');
    });
    $(document).on('click', '.multiproduct-btn .btn-next', function () {
        $('.multiproduct .owl-nav .owl-next').trigger('click');
    });
    $('.multiproduct .multiproduct_img a').click(function () {
        var srcVal = $(this).find('img').attr('src');
        $('.product-page-left-signal img').attr('src', srcVal);
    });

    // end multiproduct

    // productpage-quantity
    $('.productpage-quantity .productpage-quantity-increase a').click(function () {
        var getVal = parseInt($('.productpage-quantity .productpage-quantity-block input[name=quantity]').val());
        getVal++;
        $('.productpage-quantity .productpage-quantity-block input[name=quantity]').val(getVal)
    });
    $('.productpage-quantity .productpage-quantity-decrease a').click(function () {
        var getVal = parseInt($('.productpage-quantity .productpage-quantity-block input[name=quantity]').val());
        getVal--;
        if (getVal <= 1)
            getVal = 1;
        $('.productpage-quantity .productpage-quantity-block input[name=quantity]').val(getVal)
    });
    // end productpage-quantity

    // related
    $('.related').owlCarousel({
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        loop: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            575: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1200: {
                items: 4,
                nav: false
            },
            1300: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });
    $(document).on('click', '.pagin .pagin-btn.btn-prev', function () {
        $(this).parent().parent().parent().find('.owl-nav .owl-prev').trigger('click');
    });
    $(document).on('click', '.pagin .pagin-btn.btn-next', function () {
        $(this).parent().parent().parent().find('.owl-nav .owl-next').trigger('click');
    });


    // end related

    // Product-page
});

// Home page

// tabproduct

$(document).ready(function () {
    $('.tabproduct-tab .tab .tablinks').eq(0).addClass('active');
});

let test = tabcontent = document.getElementsByClassName("tabcontent");
for (var i = 0; i < test.length; i++) {
    if (i != 0) {
        test[i].style.display = "none";
    }
}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// end tabproduct

// end Home page

// Category Page

// List & grid product

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// end List & grid product

// end Category Page

// mega menu
$(document).on('mouseenter', '#megamenu > ul > li.nav-item', function () {
    $('#megamenu > ul > li.nav-item').removeClass('team');
    $(this).addClass('team');
});

$(document).on('mouseleave', '#megamenu > ul > li.nav-item', function () {
    $(this).removeClass('team');
});

$(document).on('click', '.megamenu-close', function () {
    $('.header-menu-button').trigger('click');
});
// end mega menu

// mobile Menu
$(window).on('load resize', function () {
    if ($(window).width() <= 991) {
        $('.header-search-wrapper').insertAfter('.header-menu-center')
    } else {
        $('.header-search-wrapper').insertAfter('.header-bottom-inner .col-lg-4.col-md-4.col-sm-5')
    }
});
// end mobile Menu

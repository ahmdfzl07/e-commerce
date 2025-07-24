$(function () {
  "use strict";

  // Skrollr
  if (typeof skrollr !== 'undefined') {
    skrollr.init({ forceHeight: false });
  }

  // Nice Select
  if (typeof $.fn.niceSelect !== 'undefined') {
    $('select').niceSelect();
  }

  // Hero Carousel
  if (typeof $.fn.owlCarousel !== 'undefined') {
    $(".hero-carousel").owlCarousel({
      items: 3,
      margin: 10,
      autoplay: false,
      autoplayTimeout: 5000,
      loop: true,
      nav: false,
      dots: false,
      responsive: {
        0: { items: 1 },
        600: { items: 2 },
        810: { items: 3 }
      }
    });

    // Best Seller Carousel
    if ($('.owl-carousel').length > 0) {
      $('#bestSellerCarousel').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
        dots: false,
        responsive: {
          0: { items: 1 },
          600: { items: 2 },
          900: { items: 3 },
          1130: { items: 4 }
        }
      });
    }

    // Single Product Carousel
    $(".s_Product_carousel").owlCarousel({
      items: 1,
      autoplay: false,
      autoplayTimeout: 5000,
      loop: true,
      nav: false,
      dots: false
    });
  } else {
    console.warn('OwlCarousel not loaded.');
  }

  // Mailchimp
  if (typeof $.fn.ajaxChimp !== 'undefined') {
    $('#mc_embed_signup').find('form').ajaxChimp();
  }

  // Fixed Navbar
  $(window).scroll(function () {
    var sticky = $('.header_area'),
        scroll = $(window).scrollTop();

    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
  });

  // Price Range Slider
  if (document.getElementById("price-range") && typeof noUiSlider !== 'undefined') {
    var nonLinearSlider = document.getElementById('price-range');

    noUiSlider.create(nonLinearSlider, {
      connect: true,
      behaviour: 'tap',
      start: [500, 4000],
      range: {
        'min': [0],
        '10%': [500, 500],
        '50%': [4000, 1000],
        'max': [10000]
      }
    });

    var nodes = [
      document.getElementById('lower-value'),
      document.getElementById('upper-value')
    ];

    nonLinearSlider.noUiSlider.on('update', function (values, handle) {
      nodes[handle].innerHTML = values[handle];
    });
  }
  if (typeof $.fn.slick !== 'undefined') {
    $('.my-slick-carousel').slick({
        autoplay: true,
        arrows: true,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
} else {
    console.warn('Slick Carousel not loaded!');
}

});

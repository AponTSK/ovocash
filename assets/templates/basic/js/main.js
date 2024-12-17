(function ($) {
  "use strict";

  // ============== Header Hide Click On Body Js Start ========
  // $('.navbar-toggler.header-button').on('click', function() {
  //   if($('.body-overlay').hasClass('show')){
  //     $('.body-overlay').removeClass('show');
  //   }else{
  //     $('.body-overlay').addClass('show');
  //   }
  // });
  // $('.body-overlay').on('click', function() {
  //   $('.header-button').trigger('click');
  // });
  $(".header-button").on("click", function () {
    $(".body-overlay").toggleClass("show");
  });
  $(".body-overlay").on("click", function () {
    $(".header-button").trigger("click");
    $(this).removeClass("show");
  });
  // =============== Header Hide Click On Body Js End =========

  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    // ========================== Header Hide Scroll Bar Js Start =====================
    $(".navbar-toggler.header-button").on("click", function () {
      $("body").toggleClass("scroll-hidden-sm");
    });
    $(".body-overlay").on("click", function () {
      $("body").removeClass("scroll-hidden-sm");
    });
    // ========================== Header Hide Scroll Bar Js End =====================

    // ================== Password Show Hide Js Start ==========
    $(".toggle-password").on("click", function () {
      $(this).toggleClass(" fa-eye-slash");
      var input = $($(this).attr("id"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // =============== Password Show Hide Js End =================

    // ===================== Table Delete Column Js Start =================
    $(".delete-icon").on("click", function () {
      $(this).closest("tr").addClass("d-none");
    });
    // ===================== Table Delete Column Js End =================

    // header search btn

    $(".section__search-btn").on("click", function () {
      $(this).toggleClass("active");
      $(".section-search-form").toggleClass("active");
    });

    $(document).on("click touchstart", function (e) {
      if (
        !$(e.target).is(
          ".section__search-btn, .section__search-btn *, .section-search-form, .section-search-form *"
        )
      ) {
        $(".section-search-form").removeClass("active");
        $(".section__search-btn").removeClass("active");
      }
    });

    // ========================= Slick Slider Js Start ==============
    if ($(".testimonial-slider").length > 0) {
      $(".testimonial-slider").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1500,
        dots: true,
        pauseOnHover: true,
        arrows: false,
        prevArrow:
          '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              arrows: false,
              slidesToShow: 2,
              dots: true,
            },
          },
          {
            breakpoint: 991,
            settings: {
              arrows: false,
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              arrows: false,
              slidesToShow: 1,
            },
          },
        ],
      });
    }
    // ========================= Slick Slider Js End ===================

    // ========================= Slick Slider Js Start ==============
    if ($(".recent-slider").length > 0) {
      $(".recent-slider").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1500,
        dots: false,
        pauseOnHover: true,
        arrows: true,
        prevArrow:
          '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }

    if ($(".profile-slider").length > 0) {
      $(".profile-slider").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1500,
        dots: false,
        pauseOnHover: true,
        arrows: true,
        prevArrow:
          '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }

    // gig details area js

    if ($(".profile-details__video").length > 0) {
      $(".profile-details__video").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: ".profile-details__gallery",
        prevArrow:
          '<button type="button" class="slick-prev gig-details-thumb-arrow"><i class="las la-long-arrow-alt-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next gig-details-thumb-arrow"><i class="las la-long-arrow-alt-right"></i></button>',
      });
    }

    if ($(".profile-details__gallery").length > 0) {
      $(".profile-details__gallery").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: ".profile-details__video",
        dots: false,
        arrows: false,

        focusOnSelect: true,
        prevArrow:
          '<button type="button" class="slick-prev gig-details-arrow"><i class="las la-long-arrow-alt-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next gig-details-arrow"><i class="las la-long-arrow-alt-right"></i></button>',
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 676,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 460,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
        ],
      });
    }

    // ========================= Slick Slider Js End ===================

    // ========================= Client Slider Js Start ===============

    if ($(".client-slider").length > 0) {
      $(".client-slider").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        pauseOnHover: true,
        speed: 2000,
        dots: false,
        arrows: false,
        prevArrow:
          '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 6,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 5,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 4,
            },
          },
          {
            breakpoint: 400,
            settings: {
              slidesToShow: 3,
            },
          },
        ],
      });
    }

    // ========================= Client Slider Js End ===================

    // ============================ToolTip Js Start=====================
    const tooltipTriggerList = document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
    // ============================ToolTip Js End========================

    // ================== Sidebar Menu Js Start ===============
    // Sidebar Dropdown Menu Start
    $(".has-dropdown > a").click(function () {
      $(".sidebar-submenu").slideUp(200);
      if ($(this).parent().hasClass("active")) {
        $(".has-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      } else {
        $(".has-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });
    // Sidebar Dropdown Menu End

    // Sidebar Icon & Overlay js
    $(".dashboard-body__bar-icon").on("click", function () {
      $(".sidebar-menu").addClass("show-sidebar");
      $(".sidebar-overlay").addClass("show");
    });
    $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
      $(".sidebar-menu").removeClass("show-sidebar");
      $(".sidebar-overlay").removeClass("show");
    });
    // Sidebar Icon & Overlay js
    // ===================== Sidebar Menu Js End =================

    // ==================== Dashboard User Profile Dropdown Start ==================
    $(".user-info__button").on("click", function () {
      $(".user-info-dropdown").toggleClass("show");
    });
    $(".user-info__button").attr("tabindex", -1).focus();

    $(".user-info__button").on("focusout", function () {
      $(".user-info-dropdown").removeClass("show");
    });
    // ==================== Dashboard User Profile Dropdown End ==================

    // ========================= Odometer Counter Up Js End ==========
    // if ($(".counterup-item").length > 0) {
    $(".counterup-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (
            var i = 0;
            i < document.querySelectorAll(".odometer").length;
            i++
          ) {
            var el = document.querySelectorAll(".odometer")[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
    // }
    // ========================= Odometer Up Counter Js End =====================
  });
  // ==========================================
  //      End Document Ready function
  // ==========================================

  // ========================= Preloader Js Start =====================
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  // ========================= Preloader Js End=====================

  // popup  js
  // var videoItem = $(".video-pop");
  // if (videoItem) {
  //     videoItem.magnificPopup({
  //         type: "iframe",
  //     });
  // };

  // popup  js

  // ========================= Header Sticky Js Start ==============
  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 300) {
      $(".header").addClass("fixed-header");
    } else {
      $(".header").removeClass("fixed-header");
    }
  });
  // ========================= Header Sticky Js End===================

  //============================ Scroll To Top Icon Js Start =========
  var btn = $(".scroll-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
  //========================= Scroll To Top Icon Js End ======================
  // ======================= dashboard balance box start =============================
  // $('.balance-box').on('click', e => { $('.balance-box').toggleClass('open')
  // });
  $(".balance-box").on("click", function () {
    $(this).addClass("open");
    setTimeout(RemoveClass, 2000);
  });
  function RemoveClass() {
    $(".balance-box").removeClass("open");
  }
  // ======================= dashboard balance box end =============================

  $("[data-highlight]").each(function () {
    const $this = $(this);
    let originalText = $this.text().trim().split(" ");
    let textLength = originalText.length;
    const highlight = $this.data("highlight").toString();
    const highlight_class =
      $this.data("highlight-class")?.toString() || "text--base";
    const highlightToArray = highlight.split(",");
    // Loop through each highlight range
    $.each(highlightToArray, function (i, element) {
      const index = element.toString().split("_");
      var startIndex = index[0];
      var endIndex = index.length > 1 ? index[1] : startIndex;
      if (startIndex < 0) {
        startIndex = textLength - Math.abs(startIndex);
      }
      if (endIndex < 0) {
        endIndex = textLength - Math.abs(endIndex);
      }
      const startIndexValue = originalText[startIndex];
      const endIndexValue = originalText[endIndex];
      if (startIndex === endIndex) {
        originalText[
          startIndex
        ] = `<span class="${highlight_class}">${startIndexValue}</span>`;
      } else {
        originalText[
          startIndex
        ] = `<span class="${highlight_class}">${startIndexValue}`;
        originalText[endIndex] = `${endIndexValue}</span>`;
      }
    });
    $this.html(originalText.join(" "));
  });
})(jQuery);

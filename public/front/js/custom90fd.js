(function ($) {
  "use strict";

  $("#form-option-conference").css("display", "none");
  $("#form-option-abstract").css("display", "none");
  $("#submit").css("display", "none");

  function refresh() {
    $("#form-option-conference").css("display", "none");
    $("#form-option-abstract").css("display", "none");
    $("#submit").css("display", "none");
  }

  $(".owl-show-events").owlCarousel({
    items: 2,
    loop: true,
    dots: true,
    nav: true,
    autoplay: true,
    margin: 30,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  // 	  document.getElementById("hours").innerText=0;
  //   document.getElementById("days").innerText=0;
  //   document.getElementById("minutes").innerText=0;
  //   document.getElementById("seconds").innerText=0;

  const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

  let countDown = new Date("Nov 18, 2022 00:00:00").getTime(),
    x = setInterval(function () {
      let now = new Date().getTime(),
        distance = countDown - now;

      // if (distance <= 0) {
      //   clearInterval(x);
      //   (document.getElementById("days").innerHTML = Math.floor(0)),
      //     (document.getElementById("hours").innerHTML = Math.floor(0)),
      //     (document.getElementById("minutes").innerHTML = Math.floor(0)),
      //     (document.getElementById("seconds").innerHTML = Math.floor(0));
      // } else {
      //   (document.getElementById("days").innerHTML = Math.floor(
      //     distance / day
      //   )),
      //     (document.getElementById("hours").innerHTML = Math.floor(
      //       (distance % day) / hour
      //     )),
      //     (document.getElementById("minutes").innerHTML = Math.floor(
      //       (distance % hour) / minute
      //     )),
      //     (document.getElementById("seconds").innerHTML = Math.floor(
      //       (distance % minute) / second
      //     ));
      // }
    }, second);

  $(function () {
    $("#tabs").tabs();
  });

  $(".schedule-filter li").on("click", function () {
    var tsfilter = $(this).data("tsfilter");
    $(".schedule-filter li").removeClass("active");
    $(this).addClass("active");
    if (tsfilter == "all") {
      $(".schedule-table").removeClass("filtering");
      $(".ts-item").removeClass("show");
    } else {
      $(".schedule-table").addClass("filtering");
    }
    $(".ts-item").each(function () {
      $(this).removeClass("show");
      if ($(this).data("tsmeta") == tsfilter) {
        $(this).addClass("show");
      }
    });
  });

  // Window Resize Mobile Menu Fix
  mobileNav();

  // Scroll animation init
  window.sr = new scrollReveal();

  // Menu Dropdown Toggle
  if ($(".menu-trigger").length) {
    $(".menu-trigger").on("click", function () {
      $(this).toggleClass("active");
      $(".header-area .nav").slideToggle(200);
    });
  }

  // Page loading animation
  $(window).on("load", function () {
    $("#js-preloader").addClass("loaded");
  });

  // Window Resize Mobile Menu Fix
  $(window).on("resize", function () {
    mobileNav();
  });

  // Window Resize Mobile Menu Fix
  function mobileNav() {
    var width = $(window).width();
    $(".submenu").on("click", function () {
      if (width < 767) {
        $(".submenu ul").removeClass("active");
        $(this).find("ul").toggleClass("active");
      }
    });
  }

  $("#registration_type").on("change", function () {
    if (
      this.value == "Conference Attendee" ||
      this.value == "Therapy Workshop" ||
      this.value == "Perfumery Workshop" ||
      this.value == "Research Workshop" ||
      this.value == "Master Class for Cosmeceutical formulation"
    ) {
      $("#form-option-conference").css("display", "block");
      $("#form-option-abstract").css("display", "none");
      $("#submit").css("display", "block");
      $("#fee-conference").prop("required", true);
      $("#fee-abstract").prop("required", false);
      $("#abstract").prop("required", false);
      document.getElementById("output").innerHTML = "";
    } else if (this.value == "Abstract Submission") {
      $("#form-option-conference").css("display", "none");
      $("#form-option-abstract").css("display", "block");
      $("#submit").css("display", "block");
      $("#fee-conference").prop("required", false);
      $("#fee-abstract").prop("required", true);
      $("#abstract").prop("required", true);
      document.getElementById("output").innerHTML = "";
    } else {
      $("#form-option-conference").css("display", "none");
      $("#form-option-abstract").css("display", "none");
      $("#submit").css("display", "none");
      $("#fee-conference").prop("required", true);
      $("#fee-abstract").prop("required", true);
      $("#abstract").prop("required", true);
      document.getElementById("output").innerHTML = "";
    }
  });
  $(function () {
    $("#form").on("submit", function (e) {
      e.preventDefault();
      document.getElementById("output").innerHTML =
        "Submitting your response....";

      $.ajax({
        type: "post",
        url: "post.php",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
          var response = JSON.parse(data);
          var myJSON = JSON.stringify(response);
          if (response.length == 0) {
            document.getElementById("output").innerHTML =
              "<small style='color: green;'>Form submitted successfully.<br>Confirmation email was sent.</small>";
            $("#form").trigger("reset");
            refresh();
          } else {
            document.getElementById("output").innerHTML = myJSON;
          }
        },
      });
    });
  });
})(window.jQuery);

(function ($) {
  "use strict";

  const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

  let countDown = new Date("Nov 18, 2022 00:00:00").getTime(),
    x = setInterval(function () {
      let now = new Date().getTime(),
        distance = countDown - now;

      if (distance <= 0) {
        clearInterval(x);
        (document.getElementById("days").innerHTML = Math.floor(0)),
          (document.getElementById("hours").innerHTML = Math.floor(0)),
          (document.getElementById("minutes").innerHTML = Math.floor(0)),
          (document.getElementById("seconds").innerHTML = Math.floor(0));
      } else {
        (document.getElementById("days").innerHTML = Math.floor(
          distance / day
        )),
          (document.getElementById("hours").innerHTML = Math.floor(
            (distance % day) / hour
          )),
          (document.getElementById("minutes").innerHTML = Math.floor(
            (distance % hour) / minute
          )),
          (document.getElementById("seconds").innerHTML = Math.floor(
            (distance % minute) / second
          ));
      }
    }, second);
})(window.jQuery);

$(document).ready(function(){
	var countDownDate = new Date("<?php echo $start_time; ?>").toLocaleString("en-US", { timeZone: "Asia/Dhaka" });
    countDownDate = new Date(countDownDate);
    var add_zero_for_single = function (v) {
      if (parseInt(v) < 10) {
        return "0" + v;
      } else {
        return v;
      }
    }

    // Update the count down every 1 second
    var x = setInterval(function () {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      $("#home_timer .t_Days").html(languageNumber(add_zero_for_single(days)));
      $("#home_timer .t_Hour").html(languageNumber(add_zero_for_single(hours)));
      $("#home_timer .t_Minutes").html(languageNumber(add_zero_for_single(minutes)));
      $("#home_timer .t_Seconds").html(languageNumber(add_zero_for_single(seconds)));

      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        $("#home_timer").html("");
      }
    }, 1000);

    function languageNumber(data) {
      data = data.toString();
      // var mapObj = {
      //   1: "১",
      //   2: "২",
      //   3: "৩",
      //   4: "৪",
      //   5: "৫",
      //   6: "৬",
      //   7: "৭",
      //   8: "৮",
      //   9: "৯",
      //   0: "০",
      // };
      // data = data.replace(/1|2|3|4|5|6|7|8|9|0/gi, function (matched) {
      //   return mapObj[matched];
      // });
      return data;
    }
})
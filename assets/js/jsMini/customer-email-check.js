$("document").ready(function() {
  // check reg-email script
  $("input[name='email']").keyup(function() {
    var email = $(this).val();
    if (validateEmail(email)) {
      $.ajax({
        type: "post",
        url: $("meta[name='url']").attr("content") + "api/email-check.php",
        data: {
          email: email
        },
        success: function(mofiz) {
          $(".err_em").text(mofiz);
        }
      });
    } else {
      $(".err_em").text("");
    }
  });
  // email check function
  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  // choose city script
  $("select[name='country']").change(function() {
    var country = parseInt($(this).val());
    if (country > 0) {
      $.ajax({
        type: "post",
        url: $("meta[name='url']").attr("content") + "api/select-city.php",
        data: {
          country: country
        },
        success: function(mofiz) {
          $("select[name='city_id']").html(mofiz);
        }
      });
    } else {
      $("select[name='city_id']").html("<option>Choose country first</option>");
    }
  });
  $("#payment").change(function() {
    var country = $(this).val();
    if (country == 1) {
      $(".rocket").hide();
      $(".bkash").hide();
      $(".card").hide();
    } else if (country == 2) {
      $(".bkash").show();
      $(".rocket").hide();
      $(".card").hide();
    } else if (country == 3) {
      $(".bkash").hide();
      $(".card").hide();
      $(".rocket").show();
    }else if(country == 4){
      $(".card").show();
      $(".rocket").hide();
      $(".bkash").hide();
    }
    else if(country == 0){
      $(".rocket").hide();
      $(".bkash").hide();
      $(".card").hide();
    }
  });
});

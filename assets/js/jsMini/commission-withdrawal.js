$("document").ready(function() {
  $("input[name='submit_wid']").click(function(e) {
    e.preventDefault();
    var withdrawal = Number($("input[name='withdrawal']").val());
    var twid = Number($("input[name='twid']").val());
    var total_com = Number($("input[name='total_com']").val());

    if (withdrawal < 999) {
      alert("Minimum withdrawal is 1000 Taka");
      return;
    } else if (withdrawal > twid) {
      alert("Your account does not have enough money");
      return;
    } else {
      $("#bidsuccess").show();
    }
    if (withdrawal) {
      $.ajax({
        type: "post",
        url:
          $("meta[name='url']").attr("content") +
          "api/commission-withdrawal.php",
        data: {
          withdrawal: withdrawal
        },
        success: function(data) {
          $("input[name='twid']").val(total_com - data);
          $("input[name='withdrawal']").val("");
        }
      });
    }
  });
});

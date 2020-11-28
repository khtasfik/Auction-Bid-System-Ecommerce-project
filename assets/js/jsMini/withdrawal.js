$("document").ready(function() {
    $("input[name='submit_wid']").click(function(e) {
      e.preventDefault();
      var withdrawal = Number($("input[name='withdrawal']").val());
      var avltk = Number($("input[name='avltk']").val());
      var total = Number($("input[name='total']").val());
  
      if (withdrawal < 999) {
        alert("Minimum withdrawal is 1000 Taka");
        return;
      } else if (withdrawal > avltk) {
        alert("Your account does not have enough money");
        return;
      } else {
        $("#bidsuccess").show();
      }
      if (withdrawal) {
        $.ajax({
          type: "post",
          url: $("meta[name='url']").attr("content") + "api/withdrawal.php",
          data: {
            withdrawal: withdrawal
          },
          success: function(data) {
            $("input[name='avltk']").val(total - data);
            $("input[name='twid']").val(data);
            $("input[name='withdrawal']").val("");
          }
        });
      }
    });
  });
  
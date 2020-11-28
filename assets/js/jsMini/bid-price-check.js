$("document").ready(function() {
  $("input[name='bid_price']").keyup(function() {
    var bid_price = Number($("input[name='bid_price']").val());
    var min_bid = Number($("#min_bid").text());

    if (bid_price <= min_bid && bid_price != "") {
      $(".error").show("");
    } else {
      $(".error").hide("");
    }
  });
  $("input[name='submit_bid']").click(function(e) {
    e.preventDefault();
    var bid_price = Number($("input[name='bid_price']").val());
    var min_bid = Number($("#min_bid").text());
    if (min_bid >= bid_price) {
      alert("You need to place at least " + (min_bid + 1));
      return;
    } else {
      $("#bidsuccess").show();
    }
    if (bid_price) {
      $.ajax({
        type: "post",
        url: $("meta[name='url']").attr("content") + "api/bid_price.php",
        data: {
          bid_price: bid_price,
          product_id: $("input[name='pid']").val()
        },
        success: function(mofiz) {
          var count = "[ " + mofiz + " bids ]";
          $("#bid_count").text(count);
          $("#min_bid").text(bid_price);
          $("input[name='bid_price']").val("");
        }
      });
    }
  });
});

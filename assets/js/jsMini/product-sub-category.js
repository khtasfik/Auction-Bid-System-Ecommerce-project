$("document").ready(function() {
  $("select[name='sub_category']").change(function() {
    var sub_category = parseInt($(this).val());
    if (sub_category > 0) {
      $.ajax({
        type: "post",
        url:
          "http://localhost/a/project_auction/api/select-product-sub-category.php",
        data: {
          sub_category_id: sub_category
        },
        success: function(response) {
          $(".artest").html(response);
        }
      });
    }
  });
});

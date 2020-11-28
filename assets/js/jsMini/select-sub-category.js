$("document").ready(function() {
  $("select[name='category']").change(function() {
    var category = parseInt($(this).val());
    if (category > 0) {
      $.ajax({
        type: "post",
        url:
          $("meta[name='url']").attr("content") + "api/select-sub-category.php",
        data: {
          category: category
        },
        success: function(mofiz) {
          $("select[name='sub_category_id']").html(mofiz);
        }
      });
    } else {
      $("select[name='sub_category_id']").html(
        "<option>Choose category first</option>"
      );
    }
  });
});

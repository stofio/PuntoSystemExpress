$(document).ready(function() {
  //
  //load ARCHIVED requests
  //
  $("#target-content").load("include/archived_requests/get_archived_requests.php?page=1");
  $(".page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/archived_requests/get_archived_requests.php",
      type: "GET",
      data: {
        page: id
      },
      cache: false,
      success: function(dataResult) {
        $("#target-content").html(dataResult);
        $(".pageitem").removeClass("active");
        $("#" + select_id).addClass("active");
      }
    });
  });


  $(document).on('click', '.viewRequest', (e) => {
    var currentOrder = $(e.target).parents('.single-order');
    var reqId = currentOrder.find('input.request_id').val()
    location.href = "/client/view-request?i=" + reqId;
  });


});
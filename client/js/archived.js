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

  //expand request
  $(document).on("click", ".arrow-toggle", function(e) {
    var $_target = $(e.currentTarget);
    var $_panelBody = $_target.next(".panel-collapse");
    if ($_panelBody) {
      //$_panelBody.slideToggle('fast');
    }
    if ($_panelBody.css('display') !== 'none') {
      $_panelBody.slideUp(300);
      $_target.find('span').css({ 'transform': 'rotate(90deg)' });
    } else {
      $_panelBody.slideDown(300);
      $_target.find('span').css({ 'transform': 'rotate(-90deg)' });
    }
  })


});
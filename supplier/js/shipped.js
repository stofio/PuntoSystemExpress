$(document).ready(function() {
  //
  //load SHIPPED requests
  //
  $("#target-content").load("include/shipped_requests/get_shipped_requests.php?page=1");
  $(".page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/shipped_requests/get_shipped_requests.php",
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
$(document).ready(function() {
  $("#target-content").load("include/active_requests/get_active_requests.php?page=1", () => {
    $(".good_collection").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".good_delivery").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".offer_active_until").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
  });

  $(".page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/active_requests/get_active_requests.php",
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
});

//dates inputs
$(document).on('keypress', '.good_delivery, .good_collection, .offer_active_until', function(e) {
  e.preventDefault();
  return false;
});

//price input
$(document).on('focusout', ".offer_price", function(e) {
  var val = $(e.currentTarget).val();
  if (val == '') return;
  var decVal = parseFloat(val).toFixed(2);
  $(e.currentTarget).val(decVal)
})

//form submit
$(document).on("submit", ".offer_form", (e) => {
  e.preventDefault();

  var formData = new FormData(e.currentTarget);

  $.ajax({
    url: '/supplier/include/active_requests/create_offer.php',
    data: formData,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data) {
      console.log(data);
      //send email

      //show success message
      var success = `<div style="padding: 10px 25px"
                      <h2 class="mb-4">You have sent your offer<h2>
                      <p>You will be notified if your offer get accepted.</p>
                      </div>
                      `;
      $(e.currentTarget).fadeOut('slow', () => {
        $(e.currentTarget).empty().html(success).fadeIn();
      });

    }
  });
})
$(document).ready(function() {
  //
  //load LIVE tab
  //
  $("#target-content").load("include/live/get_live_requests.php?page=1");
  $(".page-link1.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");

    $.ajax({
      url: "include/live/get_live_requests.php",
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

  //
  //load TOCONFIRM tab
  //
  $("#target-content2").load("include/toconfirm/get_to_confirm_requests.php?page=1");
  $(".page-link2.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");

    $.ajax({
      url: "include/toconfirm/get_to_confirm_requests.php",
      type: "GET",
      data: {
        page: id.replace('tc-', '')
      },
      cache: false,
      success: function(dataResult) {
        $("#target-content2").html(dataResult);
        $(".pageitem2").removeClass("active");
        $("#tc-" + select_id).addClass("active");
      }
    });
  });

  //
  //load TOSHIP tab
  //
  $("#target-content3").load("include/toship/get_toship_requests.php?page=1");
  $(".page-link3.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/toship/get_toship_requests.php",
      type: "GET",
      data: {
        page: id.replace('ts-', '')
      },
      cache: false,
      success: function(dataResult) {
        $("#target-content3").html(dataResult);
        $(".pageitem3").removeClass("active");
        $("#ts-" + select_id).addClass("active");
      }
    });
  });

});

$(document).on('click', '#cancelLiveOffer', (e) => {
  var currentOrder = $(e.target).parents('.single-order');
  if (confirm(`Do you want to Cancel the '${currentOrder.find('.order-title').html()}' request? 
  All the suppliers have already received a notification email about the request.`)) {
    // YES
    $.ajax({
      url: "include/live/delete_live_requests.php",
      type: "POST",
      data: {
        id: currentOrder.find('.request_id').val()
      },
      cache: false,
      success: function(dataResult) {
        console.log(dataResult)
        currentOrder.remove();
      }
    });
  }
});


$(document).on('click', '.blockOffer', (e) => {
  var currentOffer = $(e.target).parents('.single-offer');
  var currentRequest = $(e.target).parents('.single-order');
  if (confirm(`Do you want to accept the offer of ${currentOffer.find('.offer-price h4').html()}?
  The offer will be moved to TO SHIP tab, from where you can contact the supplier directly by email.`)) {
    // YES
    $.ajax({
      url: "include/toconfirm/block_offer.php",
      type: "POST",
      data: {
        offer_id: currentOffer.find('.offer_id').val(),
        request_id: currentRequest.find('.request_id').val()
      },
      cache: false,
      success: function(dataResult) {

        //show success message
        var success = `<div style="padding: 10px 25px"
              <h2 class="mb-4">The supplier will be notified by email to ship your request of ${currentOffer.find('.offer-price h4').html()}.<h2>
              <p>You will be notified by email when the shipment is on the way.</p>
              <p>You can contact the supplier from the TO SHIP tab.</p>
              </div>
              `;
        $(currentRequest).fadeOut('slow', () => {
          $(currentRequest).empty().html(success).fadeIn();
        });
      }
    });
  }
});

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
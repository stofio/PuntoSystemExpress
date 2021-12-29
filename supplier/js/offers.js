$(document).ready(function() {
  //
  //load LIVE tab
  //
  $("#target-content").load("include/live_requests/get_live_requests.php?page=1");
  $(".page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/live_requests/get_live_requests.php",
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
  //load TOSHIP tab
  //
  $("#target-content2").load("include/toship_requests/get_toship_requests.php?page=1");
  $(".page-link2.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");

    $.ajax({
      url: "include/toship_requests/get_toship_requests.php",
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
  //load ENDED tab
  //
  $("#target-content3").load("include/ended_requests/get_ended_requests.php?page=1");
  $(".page-link3.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/ended_requests/get_ended_requests.php",
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


$(document).on('click', '.confirm_shipped', (e) => {
  var currentOffer = $(e.target).parents('.single-offer');
  var currentRequest = $(e.target).parents('.single-order');
  if (confirm(`Do you want to mark the request '${currentRequest.find('.order-title').html()}' as SHIPPED?
  This action will notify the client that the shipping is on the way.`)) {
    // YES
    $.ajax({
      url: "include/toship_requests/set_shipped_request.php",
      type: "POST",
      data: {
        offer_id: currentOffer.find('.offer_id').val(),
        request_id: currentRequest.find('.request_id').val()
      },
      cache: false,
      success: function(dataResult) {
        console.log(dataResult);

        //show success message
        var success = `<div style="padding: 10px 25px"
              <h2 class="mb-4">You can find this request in the <a href="/supplier/shipped">Shipped</a> section.<h2>
              <p>The client will be notified that the shipping is on the way.</p>
              </div>
              `;
        $(currentOffer).fadeOut('slow', () => {
          $(currentOffer).empty().html(success).fadeIn();
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
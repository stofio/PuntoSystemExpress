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
  //load IN TRANSIT tab
  //
  $("#target-content4").load("include/intransit/get_transit_requests.php?page=1");
  $(".page-link4.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");
    $.ajax({
      url: "include/intransit/get_transit_requests.php",
      type: "GET",
      data: {
        page: id.replace('tg-', '')
      },
      cache: false,
      success: function(dataResult) {
        $("#target-content4").html(dataResult);
        $(".pageitem4").removeClass("active");
        $("#tg-" + select_id).addClass("active");
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



$(document).on('submit', '.conf_shipped', (e) => {
  e.preventDefault();
  var currentOffer = $(e.target).find('.single-offer');
  var currentRequest = $(e.target).parents('.single-order');
  if (confirm(`Notify the client that the request '${currentRequest.find('.order-title').html()}' is IN TRANSIT?`)) {
    // YES
    var formData = new FormData(e.currentTarget);

    $.ajax({
      url: "include/toship_requests/set_shipped_request.php",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      cache: false,
      success: function(dataResult) {
        console.log(dataResult);

        //show success message
        var success = `<div style="padding: 10px 25px"
            <h2>The client will be notified that the shipping is on the way.</h2>
              <p class="mb-4">You can find this request in the IN TRANSIT tab.<p>
              
              </div>
              `;
        $(currentOffer).fadeOut('slow', () => {
          $(currentOffer).empty().html(success).fadeIn();
        });

      }
    });
  }
});


$(document).on('click', '.sped_ritirata', (e) => {
  var currentOffer = $(e.target).parents('.single-offer');
  var currentRequest = $(e.target).parents('.single-order');
  if (confirm(`Do you want to set this shipping as DELIVERED? The user will be notified about the changes.`)) {
    // YES

    //SET ORDER STATUS DELIVERED

    $('.sped_ritirata').fadeOut('slow', () => {
      $('.conclude_form').fadeIn('fast');
      $('.order-status').html('TO COMPLETE');
    });

  }
});


$(document).on('submit', '.conclude_form', (e) => {
  e.preventDefault();
  var currentOffer = $(e.target).parents('.single-offer');
  var currentRequest = $(e.target).parents('.single-order');
  if (confirm(`Mark current order as SHIPPED?`)) {
    // YES

    //SET ORDER AS CONCLUDED


    var success = `<div style="padding: 10px 25px"
              <h2 class="mb-4 mt-5">Shipment completed.<h2>
              <p>The user will be notified about the changes.</p>
              <p>You can find this request in the <a href="/supplier/shipped">archive</a></p>
              </div>
              `;
    $(e.target).parents('.single-order').fadeOut('slow', () => {
      $('#goingReq').append(success);
    });


  }
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
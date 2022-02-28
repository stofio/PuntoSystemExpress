$(document).ready(function() {
  //
  //load LIVE tab
  //
  $("#target-content").load("include/live/get_live_requests.php?page=1", () => {
    startTimers((currentQuote) => {
      currentQuote.parents('.order-status').html(`Bookable 
      <div class="offer-button view-button mt-3">
          <button class="viewQuote" type="button">View the quote</button>
      </div>`);
    })
  });
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
  //load BOOKED tab
  //
  $("#target-content2").load("include/booked/get_booked.php?page=1");
  $(".page-link2.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");

    $.ajax({
      url: "include/booked/get_booked.php",
      type: "GET",
      data: {
        page: id.replace('tc-', '')
      },
      cache: false,
      success: function(dataResult) {
        console.log(dataResult);
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

// $(document).on('click', '#cancelLiveOffer', (e) => {
//   var currentOrder = $(e.target).parents('.single-order');
//   if (confirm(`Do you want to Cancel the '${currentOrder.find('.order-title').html()}' request? 
//   All the suppliers have already received a notification email about the request.`)) {
//     // YES
//     $.ajax({
//       url: "include/live/delete_live_requests.php",
//       type: "POST",
//       data: {
//         id: currentOrder.find('.request_id').val()
//       },
//       cache: false,
//       success: function(dataResult) {
//         console.log(dataResult)
//         currentOrder.remove();
//       }
//     });
//   }
// });


$(document).on('click', '.viewQuote', (e) => {
  var currentOrder = $(e.target).parents('.single-order');
  var quoteId = currentOrder.find('input.request_id').val()
  location.href = "/client/choose-offer?i=" + quoteId;
});

$(document).on('click', '.viewRequest', (e) => {
  var currentOrder = $(e.target).parents('.single-order');
  var reqId = currentOrder.find('input.request_id').val()
  location.href = "/client/view-request?i=" + reqId;
});

$(document).on('click', '.archiveRequest', (e) => {
  var $currentOrder = $(e.target).parents('.single-order');
  var reqId = $currentOrder.find('input.request_id').val()

  $.ajax({
    url: "include/live/move_archive.php",
    type: "POST",
    data: {
      reqId: reqId
    },
    cache: false,
    success: function(dataResult) {
      console.log(dataResult);
      $currentOrder.slideUp(300);
    }
  });

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


//start timer
function startTimers(callback) {
  $.each($('.the-time'), (e, i) => {
    var timeLimit = $(i).attr('data-time-limit'); // s

    var timePassed = $(i).html().replace(/\s/g, ''); // mm:ss
    //var timePassedStmp = (timePassed.split(":")[0] * 60) + timePassed.split(":")[1]; // timestamp

    console.log(timePassed)
      //return;
    var interval = setInterval(function() {
      var timer = timePassed.split(':');
      //by parsing integer, I avoid all extra string processing
      var minutes = parseInt(timer[0], 10);
      var seconds = parseInt(timer[1], 10);
      --seconds;
      minutes = (seconds < 0) ? --minutes : minutes;
      minutes = (minutes < 10) ? '0' + minutes : minutes;
      if (minutes < 0) clearInterval(interval);
      seconds = (seconds < 0) ? 59 : seconds;
      seconds = (seconds < 10) ? '0' + seconds : seconds;
      //minutes = (minutes < 10) ?  minutes : minutes;
      $(i).html(minutes + ':' + seconds);
      timePassed = minutes + ':' + seconds;


      if (timePassed == '00:00') {
        if (typeof callback == 'function') {
          callback($(i));
        }
      }
    }, 1000);

  })

}
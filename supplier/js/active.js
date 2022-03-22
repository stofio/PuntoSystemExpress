$(document).ready(function() {
  $("#target-content").load("include/active_requests/get_active_requests.php?page=1", () => {
    $(".good_collection").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".good_delivery").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".offer_active_until").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    setDatesDefaults();
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

        $(".good_collection").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
        $(".good_delivery").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
        $(".offer_active_until").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
        setDatesDefaults();
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

  showLoading();

  $.ajax({
    url: '/supplier/include/active_requests/create_offer.php',
    data: formData,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data) {
      hideLoading();
      console.log(data);
      //send email

      //show success message
      var success = `<div class="notice-success" style="padding-top: 50px">
                      <h2 class="mb-4">You have sent your offer</h2>
                      <p>You will be notified if your offer gets accepted.</p>
                      </div>
                      `;
      $(e.currentTarget).fadeOut('slow', () => {
        $(e.currentTarget).empty().html(success).fadeIn();
      });

    }
  });
})


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


$(document).on("change dp.change", ".good_collection", (e) => {
  var $order = $(e.target).parents('.single-order');
  console.log($(e.target).val())

});


function setDatesDefaults() {
  $.each($(".single-offer"), (i, off) => {
    var todayDate = new Date();
    var deliverDate = new Date($(off).find('.good_delivery').attr('data-the-date'));
    var collectDate = new Date($(off).find('.good_collection').attr('data-the-date'));

    $(off).find('.offer_active_until').datetimepicker("setDate", todayDate);
    $(off).find('.good_delivery').datetimepicker("setDate", deliverDate);
    $(off).find('.good_collection').datetimepicker("setDate", collectDate);
  });
}


function showLoading() {
  $('body').append(`
  <div class="load-screen">
    <img src="/media/loading-buffering.gif" />
  </div>
  `).css("overflow", "hidden");
}

function hideLoading() {
  $('.load-screen').remove();
  $('body').css("overflow", "auto");
}
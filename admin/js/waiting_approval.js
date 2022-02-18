$(document).ready(function() {
  //
  //load WAITING APPROVAL tab
  //
  $("#target-content").load("include/waiting_approval/get_to_approve_req.php?page=1");
  $(".page-link.page-link").click(function() {
    var id = $(this).attr("data-id");
    var select_id = $(this).parent().attr("id");

    $.ajax({
      url: "include/waiting_approval/get_to_approve_req.php",
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


$(document).on('submit', '.offer_form', (e) => {
  e.preventDefault();
  var formData = new FormData(e.currentTarget);

  if (formData.get('shipment_ref') == 0) {
    //MOVE TO MANUAL
    submitAndMoveManual(formData);
  } else {
    //APPROVE
    submitAndApprove(formData);
  }



});


function submitAndApprove(formData) {
  if (confirm(`Confirm and submit BeOne Ref. Number: ${formData.get('beone_ref')}?`)) {
    // YES
    $.ajax({
      url: "include/waiting_approval/submit-beone.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function(dataResult) {
        //show success message
        console.log(dataResult)
        var success = `<div style="padding: 10px 25px"
              <h2 class="mb-4 mt-5">Request approved.<h2>
              <p>The supplier will be notified about the changes.</p>
              <p>The BeOne Ref. Number is: ${formData.get('beone_ref')}</p>
              </div>
              `;

        //SEND EMAIL TO ADMIN
        $(e.target).fadeOut('slow', () => {
          $(e.target).empty().html(success).fadeIn();
        });
      }
    });
  }
}


function submitAndMoveManual(formData) {
  if (confirm(`Set request as MANUAL?`)) {
    // YES
    $.ajax({
      url: "include/waiting_approval/submit-manual.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function(dataResult) {
        //show success message
        console.log(dataResult)
        var success = `<div style="padding: 10px 25px"
              <h2 class="mb-4 mt-5">Request moved to manual.<h2>
              <p>The request is moved into Archive.</p>
              <p>The request will be continued manually.</p>
              </div>
              `;

        //SEND EMAIL TO ADMIN
        $(e.target).fadeOut('slow', () => {
          $(e.target).empty().html(success).fadeIn();
        });
      }
    });
  }
}
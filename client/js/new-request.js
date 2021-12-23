(function() {

  //dates inputs
  $(".request_available_from").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
  $(".request_delivered_withing").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
  $('.request_available_from, .request_delivered_withing').keypress(function(e) {
    e.preventDefault();
    return false;
  });



  //form submit
  $("#new_request_form").on("submit", (e) => {
    e.preventDefault();
    console.log(e.currentTarget)

    var formData = new FormData(e.currentTarget);

    $.ajax({
      url: '/client/include/create_request.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
        //send email

        //show success message
        var success = `<h2 class="mb-4">Your shipment request is LIVE<h2>
                      <p>You will be able to accept an offer once at least 3 are collected.</p>
                      <p>You will be notified by email, but you can also check the <a href="/client/my-requests">My Requests</a> section.</p>
        `;
        $('#new_request_form').fadeOut('slow', () => {
          $('#new_request').append(success);
        });

      }
    });

  });

})();
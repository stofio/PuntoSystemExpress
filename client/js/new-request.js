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
  })





})();
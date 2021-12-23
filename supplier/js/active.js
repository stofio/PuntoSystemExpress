(function() {
  console.log('asd')

  //dates inputs
  $(".good_collection").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
  $(".good_delivery").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
  $('.good_delivery, .good_collection').keypress(function(e) {
    e.preventDefault();
    return false;
  });

  //price input
  $(".offer_price").on('focusout', function() {
    var val = $(".offer_price").val();
    console.log(val)
    if (val == '') return;
    var decVal = parseFloat(val).toFixed(2);
    $(".offer_price").val(decVal)
  })

  //form submit
  $(".offer_form").on("submit", (e) => {
    e.preventDefault();
    console.log(e.currentTarget)
  })





})();
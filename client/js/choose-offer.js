$(document).ready(function() {



  $(document).on('click', '.blockOffer', (e) => {
    var currentOffer = $(e.target).parents('.single-offer');
    var currentRequest = $(e.target).parents('.single-order');
    if (confirm(`Do you want to accept the offer of ${currentOffer.find('.offer-price h4').html()}? The offer will be moved to BOOKED tab. `)) {
      // YES
      $.ajax({
        url: "include/choose_offer/block_offer.php",
        type: "POST",
        data: {
          offer_id: currentOffer.find('.offer_id').val(),
          request_id: currentRequest.find('.req_id').val()
        },
        cache: false,
        success: function(dataResult) {
          //show success message
          var success = `<div style="padding: 10px 25px"
                <h2 class="mb-4 mt-5">Shipment waiting admin approval.<h2>
                <p>You will be notified by email when the shipment is on the way.</p>
                <p>You can contact the supplier from the BOOKED tab in My Quotes.</p>
                </div>
                `;

          //SEND EMAIL TO ADMIN
          $(currentRequest).fadeOut('slow', () => {
            $(currentRequest).empty().html(success).fadeIn();
          });
        }
      });
    }
  });



});
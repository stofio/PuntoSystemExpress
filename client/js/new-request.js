(function() {

  var euCountries = [];
  var nonEuCountries = [];


  //form submit
  $("#new_request_form").on("submit", (e) => {
    e.preventDefault();
    // console.log(e.currentTarget)

    var formData = new FormData(e.currentTarget);

    //serialize colli
    var colliArr = [];

    $.each($('.collo-single'), (i, collo) => {
      var we = $(collo).find('.collo-kg').val();
      var le = $(collo).find('.collo-l').val();
      var wi = $(collo).find('.collo-w').val();
      var he = $(collo).find('.collo-h').val();

      colliArr.push({
        weight: we,
        lenght: le,
        width: wi,
        height: he
      });
    })

    var data = { colli: colliArr };
    var serializedColli = JSON.stringify(data)

    formData.append('colli', serializedColli);

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
                      <p>You will be notified by email, but you can also check the <a href="/client/my-requests">My Requests</a> section.</p>
        `;
        $('#new_request_form').fadeOut('slow', () => {
          $('#new_request').append(success);
        });

      }
    });
  });

  //show non-EU selected warning
  $('.request_to').on('change', () => {
    var selected = $(".request_to option:selected").text();
    if (nonEuCountries.includes(selected)) {
      showCountryWarning();
    }
  });

  //add new collo
  $('#new-collo').on('click', addNewCollo);

  //remove collo
  $(document).on('click', '.remov-col', removeCollo);

  //check weight
  $(document).on('input', '.collo-kg', checkWeight);

  //check measures
  $(document).on('input', 'input.collo-l, input.collo-w, input.collo-h', checkMeasures);

  //allow only numbers input
  $(document).on('input', 'input.collo-kg, input.collo-l, input.collo-w, input.collo-h', (e) => {
    $(e.target).val($(e.target).val().replace(/[^\d]/, ''));
  });


  $(document).ready(function() {
    //dates inputs
    $(".request_available_from").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".request_delivered_within").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $(".request_expire").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
    $('.request_available_from, .request_delivered_within, .request_expire').keypress(function(e) {
      e.preventDefault();
      return false;
    });

    //init select2
    $('.request_from').select2({
      placeholder: "Select a state"
    });
    $('.request_to').select2({
      placeholder: "Select a state"
    });

    //select2 read and populate countries
    readCountries("/countries_EU.txt", countriesArray => {
      euCountries = countriesArray;
      addEuCountriesOptions('.request_from_eu_group', countriesArray);
      addEuCountriesOptions('.request_to_eu_group', countriesArray);
    });
    readCountries("/countries_non_EU.txt", countriesArray => {
      nonEuCountries = countriesArray;
      //addNonEuCountriesOptions('.request_from_non_eu_group', countriesArray);
      addNonEuCountriesOptions('.request_to_non_eu_group', countriesArray);
    });
  });



  function readCountries(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function() {
      if (rawFile.readyState === 4) {
        if (rawFile.status === 200 || rawFile.status == 0) {
          var allText = rawFile.responseText;
          var arrayCountries = allText.replace(/(\r\n|\n|\r)/gm, "").split(",");
          callback(arrayCountries);
        }
      }
    }
    rawFile.send(null);
  }


  /**
   * 
   * @param {string} whereTo element class
   * @param {array} countriesArray  array with countries
   */
  function addEuCountriesOptions(whereTo, countriesArray) {
    $.each(countriesArray, (i, country) => {
      $(whereTo).append(`<option value="${country}">${country}</option>`);
    });
  }

  /**
   * 
   * @param {string} whereTo element class
   * @param {array} countriesArray  array with countries
   */
  function addNonEuCountriesOptions(whereTo, countriesArray) {
    $.each(countriesArray, (i, country) => {
      $(whereTo).append(`<option value="${country}">${country}</option>`);
    });
  }


  function showCountryWarning() {
    var warn = `<p class="error-warn" id="warn-non-eu-to"><span>⚠</span> 
                  The country of destination does not belong to the European Union. Your request requires specific study. Our customer service will contact you shortly after with the best transport option.
                </p>`;
    $('#warn-non-eu-to').remove();

    $('.error-container').append(warn);
  }


  function addNewCollo() {
    var collo = `
    <div class="collo-single">
      <span class="coll-nu"></span>
      <label>Weight</label><input type="text" class="collo-kg" placeholder="In KG, E.g. 350" required>
      <label>Lenght</label><input type="text" class="collo-l" placeholder="In m, E.g. 5" required>
      <label>Width</label><input type="text" class="collo-w" placeholder="In m, E.g. 1.2" required>
      <label>Height</label><input type="text" class="collo-h" placeholder="In m, E.g. 2.4" required>
      <span class="remov-col">✕</span>
    </div>
    `;

    $(collo).insertBefore(('#new-collo'));
    reorderNumbers();
  }

  function removeCollo(e) {
    $(e.target).parent().remove();
    reorderNumbers();
    checkWeight();
  }

  function reorderNumbers() {
    $.each($('.collo-single'), (i, collo) => {
      $(collo).find('.coll-nu').html(i + 1);
    });
  }


  function checkWeight() {
    var totWeight = 0;
    var maxWeight = 1100;

    $.each($('.collo-kg'), (i, weight) => {
      totWeight = totWeight + $(weight).val() * 1;
    })

    if (isNaN(totWeight)) return;
    console.log(totWeight)
    if (totWeight > maxWeight) {
      showWeightWarning()
    } else {
      $('#warn-weight').remove();
    }
  }

  function showWeightWarning() {
    var warn = `<p class="error-warn" id="warn-weight"><span>⚠</span> 
                    The unit weight is too high for transport with standard express vehicles. Your request requires specific study. Our customer service will contact you soon after.  
                </p>`;
    $('#warn-weight').remove();

    $('.error-container').append(warn);
  }

  function checkMeasures() {
    var maxL = 240;
    var maxW = 300;
    var maxH = 200;

    $('#warn-measure').remove();

    $.each($('.collo-l'), (i, l) => {
      if ($(l).val() * 1 > maxL) showMeasureWarning();
    })

    $.each($('.collo-w'), (i, w) => {
      if ($(w).val() * 1 > maxW) showMeasureWarning();
    })

    $.each($('.collo-h'), (i, h) => {
      if ($(h).val() * 1 > maxH) showMeasureWarning();
    })
  }

  function showMeasureWarning() {
    var warn = `<p class="error-warn" id="warn-measure"><span>⚠</span> 
                  The dimensions do not allow transport by standard express means. Your request requires specific study. Our customer service will contact you shortly after with the best transport option.    
                </p>`;
    $('#warn-measure').remove();

    $('.error-container').append(warn);
  }



})();
(function() {

  var euCountries = [];
  var nonEuCountries = [];

  var isManual = 0; //0 if all forManual = false

  var forManual = {
    measures: false,
    weight: false,
    country: false
  };

  var formDataSaved; //save form data before login

  //form submit
  $("#new_request_form").on("submit", (e) => {
    e.preventDefault();

    //show popup
    $('#loginModalForm').modal('show');


    var formData = new FormData(e.currentTarget);

    if (forManual.measures || forManual.weight || forManual.country) {
      isManual = 1;
    } else {
      isManual = 0;
    }

    formData.append("manual", isManual);

    //append serialized colli to formData
    appendSerializedColli(formData);

  });


  $("#loginModalForm form").on("submit", (e) => {
    e.preventDefault();

    var formData = new FormData(e.currentTarget);
    showLoading();

    $.ajax({
      url: '../include/checkLogin.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        console.log(data);
        hideLoading();
        var accepted = data; //true/false
        if (accepted == 0) {
          $('.error-container-login-req').append(`
          <div class="error-warn">
            <span>Wrong username or password. Request a CLIENT account or retry.</span>
            </div>`);
        } else if (accepted == 1) { //if client
          pubblishRequest(() => {
            //send email then
            location.href = "/client/my-requests";
          });
        }
      }
    });

  });


  //show non-EU selected warning
  $('.request_to').on('change', () => {
    var selected = $(".request_to option:selected").text();
    if (nonEuCountries.includes(selected)) {
      showCountryWarning();
      forManual.country = true;
    } else {
      hideCountryWarning();
      forManual.country = false;
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
  $(document).on('input', 'input.collo-l, input.collo-w, input.collo-h, input.collo-kg', (e) => {
    if (($(e.target).val().split(".").length - 1) > 1) {
      $(e.target).val($(e.target).val().slice(0, -1));
    }
    $(e.target).val($(e.target).val().replace(/[^0-9.]/g, ''));
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

  function pubblishRequest(callback) {
    for (var pair of formDataSaved.entries()) {
      console.log(pair[0] + ', ' + pair[1]);
    }
    showLoading();
    $.ajax({
      url: '/include/create_request.php',
      data: formDataSaved,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        hideLoading();
        if (typeof callback === 'function') {
          callback();
        }
      }
    });
  }


  /**
   * 
   * @param {*} formData e.currentTarget of form submit
   */
  function appendSerializedColli(formData) {
    //serialize colli
    var colliArr = [];

    $.each($('.collo-single'), (i, collo) => {
      var name = $(collo).find('.collo-name').val();
      var we = $(collo).find('.collo-kg').val();
      var le = $(collo).find('.collo-l').val();
      var wi = $(collo).find('.collo-w').val();
      var he = $(collo).find('.collo-h').val();
      var stack = $(collo).find('.collo-stack').is(":checked");

      colliArr.push({
        name: name,
        weight: we,
        lenght: le,
        width: wi,
        height: he,
        stack: stack
      });
    })

    var data = { colli: colliArr };
    var serializedColli = JSON.stringify(data)
    formData.append('colli', serializedColli);
    formDataSaved = formData;
  }



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

  function hideCountryWarning() {
    $('#warn-non-eu-to').remove();
  }


  function addNewCollo() {
    var collo = `
    <div class="collo-single">
    <span class="coll-nu">1</span>
    <div>
      <label>Packaging Type</label>
      <select class="collo-name" placeholder="Packaging Type" required>
          <option value="Carton">Carton</option>
          <option value="Pallet">Pallet</option>
          <option value="Piece">Piece</option>
          <option value="Case">Case</option>
          <option value="Cage">Cage</option>
          <option value="Bundle">Bundle</option>
          <option value="Reel">Reel</option>
      </select>
    </div>
    <div>
        <label>Lenght (cm)</label><input type="text" class="collo-l" placeholder="In m, E.g. 35" required>
    </div>
    <div>
        <label>Width (cm)</label><input type="text" class="collo-w" placeholder="In m, E.g. 10.5" required>
    </div>
    <div>
        <label>Height (cm)</label><input type="text" class="collo-h" placeholder="In m, E.g. 30" required>
    </div>
    <div>
        <label>Weight (kg)</label><input type="text" class="collo-kg" placeholder="E.g. 350" required>
    </div>
    <div>
        <label>Stackable</label>
        <input type="checkbox" class="collo-stack">
    </div>
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

    if (totWeight > maxWeight) {
      showWeightWarning();
      forManual.weight = true;
    } else {
      $('#warn-weight').remove();
      forManual.weight = false;
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
    forManual.measures = false;

    $.each($('.collo-l'), (i, l) => {
      if ($(l).val() * 1 > maxL) {
        showMeasureWarning();
        forManual.measures = true;
      };
    })

    $.each($('.collo-w'), (i, w) => {
      if ($(w).val() * 1 > maxW) {
        showMeasureWarning();
        forManual.measures = true;
      };
    })

    $.each($('.collo-h'), (i, h) => {
      if ($(h).val() * 1 > maxH) {
        showMeasureWarning();
        forManual.measures = true;
      };
    })
  }

  function showMeasureWarning() {
    var warn = `<p class="error-warn" id="warn-measure"><span>⚠</span> 
                    The dimensions do not allow transport by standard express means. Your request requires specific study. Our customer service will contact you shortly after with the best transport option.    
                  </p>`;
    $('#warn-measure').remove();

    $('.error-container').append(warn);
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



})();
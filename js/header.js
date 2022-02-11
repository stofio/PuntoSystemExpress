(function() {

  var current = location.pathname.replace('/', '');

  //add help button
  var helpBtn = `
  <a href="mailto:info@puntosystemgroup.com"><div class="helpBtn">� Need Help?</div></a>`;
  $('body').append(helpBtn);

  $(document).ready(function() {
    //login popup
    $('#loginBtn').on('click', () => $('#loginModalHeader').modal('show'));
  });


  //login
  $("#loginModalHeader form").on("submit", (e) => {
    e.preventDefault();
    showLoading();

    var formData = new FormData(e.currentTarget);

    $.ajax({
      url: '../include/login.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        hideLoading()
        var accepted = data; //true/false
        console.log(data);
        if (accepted == 0) {
          $('.error-container-login-head').append(`
          <div class="error-warn">
            <span>Wrong username or password. Retry</span>
            </div>`);
        } else if (accepted == 1) {
          location.href = "/client/my-requests";
        } else if (accepted == 2) {
          location.href = "/supplier";
        }

      }
    });

  });

  function showLoading() {
    $('body').append(`
    <div class="load-screen">
      <img src="/media/loading-buffering.gif" />
    </div>
    `).css("overflow", "hidden");
  }

  function hideLoading() {
    $('.load-screen').remove();
  }






  /**
   * this next 2 parts needs to stay at bottom, cause of return
   */
  //if its home
  if (current == '') {
    $('.nav li:first-child a').addClass('active');
    return;
  }

  $('.nav li a').each(function() {
    var $this = $(this);
    // if the current path is like this link, make it active
    if ($this.attr('href').indexOf(current) !== -1) {
      $this.addClass('active');
    }
  })


})();
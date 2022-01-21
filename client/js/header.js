(function() {

  var current = location.pathname.replace('/client/', '');


  //add help button
  var helpBtn = `
   <a href="mailto:info@puntosystemgroup.com"><div class="helpBtn">� Need Help?</div></a>
`;
  $('body').append(helpBtn);







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
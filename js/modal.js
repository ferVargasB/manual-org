// Image to Lightbox Overlay 
$('img').on('click', function() {
    $('#overlay')
      .css({backgroundImage: `url(${this.src})`})
      .addClass('open')
      .one('click', function() { 
          $(this).removeClass('open');
          $("#side-bar-toggle").click(); 
        });
      $("#side-bar-toggle").click();
  });
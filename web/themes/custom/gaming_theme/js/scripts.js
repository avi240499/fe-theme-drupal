(function ($, Drupal) {
    Drupal.behaviors.gamingTheme = {
      attach: function (context, settings) {
        
        $('.button').hover(
          function() {
            $(this).css('box-shadow', '0 0 15px #50fa7b');
          },
          function() {
            $(this).css('box-shadow', 'none');
          }
        );
      }
    };
  })(jQuery, Drupal);
  
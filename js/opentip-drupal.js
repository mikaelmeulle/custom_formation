(function ($) {

  Drupal.behaviors.custom_formation_opentip = {
    attach: function (context, settings) {
      $.each(settings.custom_formation.opentip, function (m, data) {
       console.log(JSON.stringify( data ));
	// $(data.elementSelector, context).each(function () {
        //  var $container = $(this);
	 if(!$(data.elementSelector).hasClass('tooltip-done')) {
         $(data.elementSelector).opentip(data.message, { showOn: "click"});
	 $(data.elementSelector).addClass('tooltip-done');
          }
       // });	
      });
    }
  };
})(jQuery);

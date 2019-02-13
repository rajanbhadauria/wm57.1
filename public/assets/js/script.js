(function($) {
	"use strict";
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(200).fadeOut(500);
		}
	}

	$(window).on('load', function() {
		handlePreloader();
		enableMasonry();
	});



})(window.jQuery);

import $ from "jquery";

export default () => {

	/* scroll animations plugin */
	(function($) {
		$.fn.animateIn = function(options) {
			return this.each(function() {
				var settings = $.extend(
					{

						//default settings
						offset: 0,
						modifier: "__in"
					},
					options
				);

				var item = $(this);
				var itemOffsetTop = $(this).offset().top;
				var triggerVal = itemOffsetTop + settings.offset;

				function animateBlock(scrollTop) {

					// if element is already in view or check if it comes into view
					if (
						scrollTop + $(window).outerHeight() >= triggerVal ||
                        $(window).outerHeight() >= triggerVal
					) {
						item.addClass(settings.modifier);
					}
				}

				$(window).scroll(function() {
					var scrollTop = $(window).scrollTop();
					animateBlock(scrollTop);
				});
				$(window).scroll();
			});
		};
	}(jQuery));


};

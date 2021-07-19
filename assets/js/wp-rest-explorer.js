/**
 * Wp Rest Explorer JS
 *
 * @package ServedAdmin
 */

(function ($) {
	"use strict";

	$(document).ready(function () {

		$(document.body).on('click', '.wpre-rest-route-btn', function () {
			var
				$route = $(this),
				route_key = $route.data('key'),
				$explorer = $(this).closest('.wpre-rest-explorer');

			$explorer.find('.wpre-rest-route-btn').removeClass('wpre-active');
			$route.addClass('wpre-active');
			$explorer.find('.wpre-rest-doc').hide();
			$explorer.find('.wpre-rest-doc[data-route_key="' + route_key + '"]').show();
		});

		$('.wpre-rest-explorer').each(function () {
			$(this).find('.wpre-rest-route-btn:first').trigger('click');
		});
	});

})(jQuery);

import $ from "jquery";
import magnificPopup from "magnific-popup";


export default () => {


	function extendMagnificIframe() {

		var $start = 0;
		var $iframe = {
			markup: "<div class=\"mfp-iframe-scaler\">" +
				"<div class=\"mfp-close\"></div>" +
				"<iframe class=\"mfp-iframe\" frameborder=\"0\" allowfullscreen></iframe>" +
				"</div>" +
				"<div class=\"mfp-bottom-bar\">" +
				"<div class=\"mfp-title\"></div>" +
				"</div>",
			patterns: {
				youtube: {
					index: "youtu",
					id: function(url) {

						var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
						if ( ! m || ! m[1] ) {
							return null;
						}

						if (-1 != url.indexOf("t=")) {

							var $split = url.split("t=");
							var hms = $split[1].replace("h", ":").replace("m", ":").replace("s", "");
							var a = hms.split(":");

							if (1 == a.length) {

								$start = a[0];

							} else if (2 == a.length) {

								$start = (+a[0]) * 60 + (+a[1]);

							} else if (3 == a.length) {

								$start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

							}
						}

						var suffix = "?autoplay=1";

						if ( 0 < $start ) {

							suffix = "?start=" + $start + "&autoplay=1";
						}

						return m[1] + suffix;
					},
					src: "//www.youtube.com/embed/%id%"
				},
				vimeo: {
					index: "vimeo.com/",
					id: function(url) {
						var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
						if ( ! m || ! m[5] ) {
							return null;
						}
						return m[5];
					},
					src: "//player.vimeo.com/video/%id%?autoplay=1"
				}
			}
		};

		return $iframe;

	}

	$(".embedded-video").magnificPopup({
		type: "iframe",
		iframe: extendMagnificIframe()
	});

	// $('.local-video').magnificPopup({
	// 	// disableOn: 700,
	// 	mainClass: 'mfp-fade',
	// 	removalDelay: 160,
	// 	preloader: false,
	// 	fixedContentPos: false,
	// 	type: 'iframe',
	// 	src: $('<video controls>\
	// 				<source src="'+$(this).attr('href')+'" type="video/webm">\
	// 				Sorry, your browser does not support videos.\
	// 			</video>'),
	// 	callbacks: {
	// 		open: function () {
	// 			console.log('allow', 'autoplay');
	// 			$('iframe').autoplay = true;
	// 			$('iframe').load();
	// 			}
	// 		  },

	// });

	// $('.local-video').magnificPopup({
	//     type: 'iframe',
	//     mainClass: 'mfp-fade',
	//     removalDelay: 160,
	//     preloader: false,
	//     fixedContentPos: false,
	//     iframe: {
	//         markup: '<div class="mfp-iframe-scaler">'+
	//                 '<div class="mfp-close"></div>'+
	//                 '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
	//               '</div>',

	//         srcAction: 'iframe_src',
	//         }
	// });

	$(".local-video").magnificPopup({
		type: "inline",
		callbacks: {
	  open: function() {
				$("html").css("margin-right", 0);

				// Play video on open:
				$(this.content).find("video")[0].play();
			},
	  close: function() {

				// Reset video on close:
				$(this.content).find("video")[0].load();
			}
	  }
	});

	$(".local-video").on("click", function () {
		if (! $("body").hasClass("__locked")) {
			$("body").addClass("__locked");
		}

		$(".mfp-close, .mfp-container, mfp-wrap, .mfp-bg").on("click", function () {
			if ($("body").hasClass("__locked")) {
				$("body").removeClass("__locked");
			} else {

			}
		});
	});


};
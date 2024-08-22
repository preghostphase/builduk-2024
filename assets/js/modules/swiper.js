// import Swiper JS
import Swiper from "swiper";

// core version + navigation, pagination modules:
import SwiperCore, { Pagination } from "swiper/core";

// configure Swiper to use modules
SwiperCore.use([Pagination]);

export default () => {
	const homeNewsElement = document.querySelector(".home-news__items");
	const relatedNewsElement = document.querySelector(".post-related__items");
	
	if (homeNewsElement) {
		const homeNewsSwiper = new Swiper(".home-news__items.swiper-container", {
			slidesPerView: 1,
			spaceBetween: 16,
			// Responsive breakpoints
			breakpoints: {
			// when window width is >= 600px
			600: {
				slidesPerView: 2
			},
			// when window width is >= 800px
			800: {
				slidesPerView: 2
			},
			// when window width is >= 1000px
			1000: {
				slidesPerView: 3
			}
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			}
		});
	}

	if(relatedNewsElement) {
		const relatedNewsSwiper = new Swiper(".post-related__items.swiper-container", {
			slidesPerView: 1,
			spaceBetween: 16,
			// Responsive breakpoints
			breakpoints: {
			// when window width is >= 600px
			600: {
				slidesPerView: 2
			},
			// when window width is >= 800px
			800: {
				slidesPerView: 2
			},
			// when window width is >= 1000px
			1000: {
				slidesPerView: 3
			}
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			}
		});
	}

	
};

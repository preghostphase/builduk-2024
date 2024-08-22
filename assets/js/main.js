// Import JS Modules
import headroomModule from "./modules/headroom";
import menuToggle from "./modules/menu-toggle";
import swiper from "./modules/swiper";
import customTitles from "./modules/custom-titles";
import cleanEmptyTags from "./modules/remove-empty-p";
import accordion from "./modules/handorgel";
import scrollToTop from "./modules/scroll-to-top";
import vacancyApply from "./modules/vacancy-apply-button";
import scrollAnimation from "./modules/scroll-animation";
import magnificPopup from "./modules/magnific-popup";
import scrollLibrary from "./modules/aos";
import socialShare from "./modules/socialshare";
import concertina from "./modules/concertina";

// Load each function into init
function init() {
	headroomModule();
	menuToggle();
	swiper();
	customTitles();
	cleanEmptyTags();
	accordion();
	scrollToTop();
	vacancyApply();
	scrollAnimation();
	scrollLibrary();
	magnificPopup();
	socialShare();
	concertina();
}

// Load JS modules once DOM is loaded
document.addEventListener("DOMContentLoaded", init);

// Load JS modules on resize
function initResize() {
}

// Load JS modules once DOM is loaded
window.addEventListener("resize", initResize);

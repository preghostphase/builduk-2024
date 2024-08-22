// JS for controlling the menu and overlay

export default () => {
	const toggleMobile = document.querySelector("#toggle-mobile-js");
	const overlayMobile = document.querySelector("#overlay-mobile-js");
	const body = document.body;


	// Selector verification
	if (! toggleMobile && ! overlayMobile) {
		return;
	}

	// Control actions for mobile menu
	toggleMobile.addEventListener("click", () => {

		// Control the menu button active status
		toggleMobile.classList.toggle("active");

		// Control the aria label
		const open = JSON.parse(overlayMobile.getAttribute("aria-expanded"));
		overlayMobile.setAttribute("aria-expanded", ! open);

		// Control overlay opening and closing
		overlayMobile.classList.toggle("open");

		// Control the body scrolling when overlay open
		body.classList.toggle("menu-active-mobile");
	});
};

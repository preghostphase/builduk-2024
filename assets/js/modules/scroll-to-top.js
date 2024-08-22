export default () => {

	// scroll to top button
	const scrollButton = document.querySelector("#scrollToTop");
	const body = document.body;

	// Selector verification
	if (! scrollButton) {
		return;
	}

	// class names
	const myScrollFunc = function () {
		const y = window.scrollY;
		if (200 < y) {
			scrollButton.className = "scrollToTop show";
		} else {
			scrollButton.className = "scrollToTop hide";
		}
	};

	// When the user clicks on the button, scroll to the top of the document
	const topFunction = function (event) {
		event.preventDefault();
		body.scrollTop = 0; // For Safari
		document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	};

	// functions
	window.addEventListener("scroll", myScrollFunc);
	scrollButton.addEventListener("click", topFunction);
};

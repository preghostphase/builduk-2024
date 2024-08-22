export default () => {


	// check if .socialshare exists
	if (document.querySelector(".socialShare")) {

		// setting variables
		const shareBlock = document.querySelector(".socialShare");
		const shareToggle = shareBlock.querySelector(".socialShareToggle");
		const shareContent = shareBlock.querySelector(".socialShareContent");

		// Selector verification
		if (! shareBlock) {
			return;
		}

		// class names
		const shareFunction = function () {
			if ("block" === shareContent.style.display) {
				shareContent.style.display = "none";
				shareToggle.className = "socialShareToggle";
			} else {
				shareContent.style.display = "block";
				shareToggle.className = "socialShareToggle active";
			}
		};

		shareToggle.addEventListener("click", shareFunction);
	}

};

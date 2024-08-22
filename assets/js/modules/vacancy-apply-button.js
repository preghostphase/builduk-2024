export default () => {

	// scroll to top button
	const vacancyApplyBtn = document.querySelector("#vacancyApply");
	const applyBox = document.querySelector(".vacancy__application");

	// Selector verification
	if (! vacancyApplyBtn) {
		return;
	}

	// functions
	vacancyApplyBtn.addEventListener("click", () => {
		applyBox.scrollIntoView();
	});
};

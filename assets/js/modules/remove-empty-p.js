// Remove empty p tags from DOM

export default () => {
	const cleanClass = document.querySelector(".clean-empty-tags-js");

	if (! cleanClass) {
		return;
	}

	const elements = cleanClass.querySelectorAll("p, span, strong");

	function cleaner(tag) {
		if ("&nbsp;" === tag.innerHTML || "" === tag.innerHTML) {
			tag.parentNode.removeChild(tag);
		}
	}

	elements.forEach(cleaner);
};

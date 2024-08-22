// Code for custom title markup converted markdown
import showdown from "showdown";

export default () => {
	const titles = Array.from(document.querySelectorAll(".custom-title-js"));

	if (! titles) {
		return;
	}

	const converter = new showdown.Converter();

	titles.forEach((item) => {

		// Check for empty titles
		if ("" === item.innerHTML) {
			return;
		}
		const convertedText = converter.makeHtml(item.innerText);
		const removePTags = convertedText.replace(/(<p[^>]+?>|<p>|<\/p>)/gim, "");
		item.innerHTML = removePTags;
	});
};

// import handorgel JS
import handorgel from "handorgel";

export default () => {
	const myElements = document.querySelectorAll(".handorgel");

	if (! myElements) {
		return;
	}

	const options = {

		// whether multiple folds can be opened at once
		multiSelectable: false
	};

	myElements.forEach((item) => {
		const accordion = new handorgel(item, options);
	});
};

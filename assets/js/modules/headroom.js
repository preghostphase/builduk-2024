// if you're using a bundler, first import:
import Headroom from "headroom.js";

export default () => {
	const myElement = document.querySelector("header");

	if (! myElement) {
		return;
	}

	const options = {

		// vertical offset in px before element is first unpinned
		offset: {
			up: 100,
			down: 200
		},

		// scroll tolerance in px before state changes
		tolerance: {
			up: 40,
			down: 0
		}
	};

	const headroom = new Headroom(myElement, options);

	headroom.init();
};

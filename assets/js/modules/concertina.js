// Concertina JS

export default () => {
	const concertinas = document.getElementsByClassName('concertina-block__item');

	// Selector verification
	if (! concertinas ) {
		return;
	}

	// Loop through and setup variables

    for(let i = 0; i < concertinas.length; i++){
        console.log(concertinas[i]);
        let trigger = concertinas[i].querySelector('.concertina-block__item-heading');
        let content = concertinas[i].querySelector('.concertina-block__item-body');


        trigger.addEventListener("click", () => {
            console.log('hello');
            content.classList.toggle('concertina-block__item--open');
            concertinas[i].classList.toggle('concertina-block__item--open');
        });
    }

};

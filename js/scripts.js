$(function(){
	// Главный слайдер
	if ($('.gallery').length) {
		var mainSlier = new Swiper('.gallery', {
			spaceBetween: 0,
			slidesPerView: 1,
			loop: true,
			speed: 750,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				bulletActiveClass: 'slider-dot_active',
				bulletClass: 'slider-dot',
				clickableClass: 'slider-pagination-clickable',
				el: '.slider-pagination',
				clickable: true,
			},
		})
	}

	// Анимация фото
	animatePhotos('.photos', 5000, 1000, 4)
})


function animatePhotos(className, delay, timeout, elements){
	let el = $(className)

	setInterval(function () {
		let number = getRandomInt(1, elements + 1);

		var thisEL = el.find('.photo').eq(number - 1)

		changePhoto(number - 1, elements, el, timeout)
	}, delay);
}

function changePhoto(currentNumber, elements, path, timeout) {
	if (path.find('.photo').eq(currentNumber).hasClass('hidden')) {
		changePhoto(currentNumber + elements, elements, path, timeout)
	} else{
		path.find('.photo').eq(currentNumber).addClass('hidden')

		setTimeout(function() {
			if (path.find('.photo').eq(currentNumber + elements).length) {
				path.find('.photo').eq(currentNumber + elements).removeClass('hidden')
			} else{
				path.find('.photo').eq(currentNumber % elements).removeClass('hidden')
			}
		}, timeout)
	}
}

var randomPrev = 0;
function getRandomInt(min, max) {
	min = Math.ceil(min);
	max = Math.floor(max);

	let result = Math.floor(Math.random() * (max - min)) + min;
	if (result == randomPrev) {
		return getRandomInt(min, max);
	} else{
		randomPrev = result;
		return result; //Максимум не включается, минимум включается
	}
}
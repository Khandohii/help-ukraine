$(function(){
	// Проверка браузера
	if ( !supportsCssVars() ) {
		$('body').addClass('lock')
		$('.supports_error').addClass('show')
	}


	// Ленивая загрузка
	setTimeout(function(){
		observer = lozad('.lozad', {
			rootMargin: '200px 0px',
			threshold: 0,
			loaded: function(el) {
				el.classList.add('loaded')
			}
		})

		observer.observe()
	}, 200)


	// Установка ширины стандартного скроллбара
	$(':root').css('--scroll_width', widthScroll() +'px')


	// Увеличение картинки
	$('.fancy_img').fancybox({
		backFocus : false,
		mobile : {
		    clickSlide: "close"
		}
	})


	// Аккордион
	$('body').on('click', '.accordion .item .open_btn', function(e) {
		e.preventDefault()

		let parent = $(this).closest('.item')
		let accordion = $(this).closest('.accordion')

		if( parent.hasClass('active') ) {
			parent.removeClass('active')
			parent.find('.data').slideUp(300)
		} else {
			accordion.find('.item').removeClass('active')
			accordion.find('.data').slideUp(300)

			parent.addClass('active')
			parent.find('.data').slideDown(300)
		}
	})


    // Плавная прокрутка к якорю
	$('body').on('click', '.scroll_link', function(e) {
		e.preventDefault()

		let href = $(this).data('anchor')

		$('html, body').stop().animate({
		   	scrollTop: $(href).offset().top
		}, 1000)


		if ( $(window).width() < 1024 ) {
			$('.mob_menu_link').removeClass('active')

			$('header').fadeOut(300)
		}
	})


	// Показать еще
	$('body').on('click', '.equipment .show_more button', function(e) {
		e.preventDefault()

		$(this).closest('.equipment').find('.hidden').fadeIn(300);

		$(this).parent().hide();
	})
})


// Вспомогательные функции
function widthScroll() {
    let div = document.createElement('div')
    div.style.overflowY = 'scroll'
    div.style.width = '50px'
    div.style.height = '50px'
    div.style.visibility = 'hidden'
    document.body.appendChild(div)

    let scrollWidth = div.offsetWidth - div.clientWidth
    document.body.removeChild(div)

    return scrollWidth
}


var supportsCssVars = function() {
    var s = document.createElement('style'),
        support

    s.innerHTML = ":root { --tmp-var: bold; }"
    document.head.appendChild(s)
    support = !!(window.CSS && window.CSS.supports && window.CSS.supports('font-weight', 'var(--tmp-var)'))
    s.parentNode.removeChild(s)

    return support
}
'use strict';
$(function() {

	// Custom JS
	$('.prod__menu_wrap').click(function() {
		$(this).toggleClass('prod__menu_wrap--opened');
	})
	$('.top__scroll_menu').click(function() {
		$(this).toggleClass('top__scroll_menu--opened');
	})

	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav',
		infinite: false
	});
	$('.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '.slider-for',
		dots: false,
		centerMode: false,
		focusOnSelect: true,
		infinite: false
	});

	//mfp
	$('.btn--pop-up').magnificPopup({
		type:'inline',
		midClick: true 
	});
	$('a.gal_item').magnificPopup({
		type: 'image',
		gallery:{
			enabled:true
		}
		// other options
	});
	$('a.product__slider_item').magnificPopup({
		type: 'image',
		gallery:{
			enabled:true
		}
		// other options
	});

	//управление верхним меню
	let heightTop = $('.top').height();
	function toggleScrollTop () {
		if((window.scrollY > 300) && (!$('.top').hasClass('top--scroll'))) {
			$('.top').toggleClass('top--scroll');
			$('header').css('padding-top', heightTop);
		} else if((window.scrollY <= 300) && ($('.top').hasClass('top--scroll'))) {
			$('.top').toggleClass('top--scroll');
			$('header').css('padding-top', 0);
		}
	}
	toggleScrollTop();
	$(window).scroll(toggleScrollTop);
//Форма: отключение кнопки отправить для незаполненной формы
	function phone_mask(event) {
		if (!this.value) {
			this.value = '+7 ';}
		else if (this.value === '+7 ') {
			this.value = '';
		}
	}
	function stop_non_digit() {
		if (((event.keyCode>45)&&(event.keyCode<58))||(event.keyCode==8)) {return} 
		else {event.preventDefault();} 
	}
	function stop_enter_send(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
		} return;
	}
	function send_formData(event) {
		event.preventDefault();
		let formData = new FormData(this);
		formData.append('action', 'send_formData');
		console.log(formData.get('action'));
		//Настройка запроса
		let request = new XMLHttpRequest();
	    request.open('POST', ajax.url, true);
	    request.setRequestHeader('accept', 'application/json');
	    console.log(request);
	    //отправка запроса
	    request.send(formData);
	    // Функция для наблюдения изменения состояния request.readyState обновления statusMessage соответственно
        request.onreadystatechange = function () {
            // <4 =  ожидаем ответ от сервера
            let btn_mess = document.querySelector('.fos__input--submit');
            btn_mess.setAttribute('disabled', 'disabled');
            if (request.readyState < 4) {
                btn_mess.innerText = 'Отправляется...';
                btn_mess.style.color = 'yellow';
            }
            // 4 = Ответ от сервера полностью загружен
            else if (request.readyState === 4) {
                // 200 - 299 = успешная отправка данных!
                if (request.status == 200 && request.status < 300) {
                    	btn_mess.innerText = 'Отправлено';
                		btn_mess.style.color = 'green';
                		console.log( request.responseText );
                }

                else {

	                    btn_mess.innerText = 'Ошибка';
	                	btn_mess.style.color = 'red';
            	}
            }
        }
	}
	document.querySelector('.fos__input--phone').addEventListener('focus', phone_mask);
	document.querySelector('.fos__input--phone').addEventListener('blur', phone_mask);
	document.querySelector('.fos__input--phone').addEventListener('keypress', stop_non_digit);
	document.querySelectorAll('.fos__input').forEach(function(el){
		el.addEventListener('keypress', stop_enter_send);
	});
	document.querySelector('.fos__form').addEventListener('submit', send_formData);

	document.querySelector('.contacts__input--phone').addEventListener('focus', phone_mask);
	document.querySelector('.contacts__input--phone').addEventListener('blur', phone_mask);
	document.querySelector('.contacts__input--phone').addEventListener('keypress', stop_non_digit);
	document.querySelectorAll('.contacts__input').forEach(function(el){
		el.addEventListener('keypress', stop_enter_send);
	});
	document.querySelector('.contacts__form').addEventListener('submit', send_formData);
});
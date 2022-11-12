;
// Начинать писать отсюда!!!!
$(document).ready(function(){

	//слайдер на главной странице
	$('.js-index-slider').bxSlider({
		pagerCustom: '.js-index-slider__pager',
		controls: false
	});
	//слайдер продукта (превью)
	$('.product-item__slider').bxSlider({
		pagerCustom: '.product-item__colors',
		controls: false
	});
	//слайдер продукта
	$('.js-product-view-slider').bxSlider({
		pagerCustom: '.js-product-view-pager',
		controls: false
	});
	$('.sizes-list li').click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');

	})
});

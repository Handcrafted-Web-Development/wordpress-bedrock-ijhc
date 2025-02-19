(function ($) {
	const slickConfig = {
		dots: true,
		arrows: false,
		infinite: true,
		speed: 500,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{ breakpoint: 1200, settings: { slidesToShow: 2 } },
			{ breakpoint: 768, settings: { slidesToShow: 1 } },
		],
	};

	const initializeBlock = ($block) => {
		const slider = $block.find('.slider');
		slider.slick(slickConfig);
	};

	$(document).ready(() => {
		$('.seize-block-slider-news').each(function () {
			initializeBlock($(this));
		});
	});
})(jQuery);

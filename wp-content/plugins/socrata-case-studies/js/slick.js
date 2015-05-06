$(window).load(function() {
	$('.carousel').slick({
		lazyLoad: 'progressive',
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 1,
				}
			},
			{
				breakpoint: 600,
				settings: {
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 1,
				}
			}

		]
	});
});

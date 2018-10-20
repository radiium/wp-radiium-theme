jQuery( document ).ready( function( $ ) {

	// Toggle mobil menu
	$('.menuMobilBtn').on('click', function() {
		$('.menuMobilBtn').toggleClass('rotated');
		$('.menuMobil').toggleClass('opened');
	});

	// Reset some variable on resize
	$(window).on('resize', function() {
		if ($(this).width() >= 768) {
			$('.menuMobilBtn').removeClass('rotated');
			$('.menuMobil').removeClass('opened');
		}
	});

	// About page
	$(".tabMenuItem1").click(function() {
		$('.tabMenuItem.active').removeClass('active');
		$(this).addClass('active');
		$('.tabContent').css({ display: "none" });
		$('#tabContent1').css({ display: "block" });
	});

	$(".tabMenuItem2").click(function() {
		$('.tabMenuItem.active').removeClass('active');
		$(this).addClass('active');
		$('.tabContent').css({ display: "none" });
		$('#tabContent2').css({ display: "block" });
	});
});

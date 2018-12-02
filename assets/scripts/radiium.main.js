jQuery( document ).ready( function( $ ) {

	// Toggle mobil menu
	$('.navTogglelBtn').on('click', function() {
		$('.navTogglelBtn').toggleClass('rotated');
		$('.navItemsMobil').toggleClass('opened');
		$('.contentWrapper').toggleClass('overflowHidden');
	});

	// Reset some variable on resize
	$(window).on('resize', function() {
		if ($(this).width() >= 768) {
			$('.navTogglelBtn').removeClass('rotated');
			$('.navItemsMobil').removeClass('opened');
			$('.contentWrapper').removeClass('overflowHidden');
		}
	});

	// Scroll to top button
	$(window).on('scroll',function() {
		var windowHeight = $(this).height();
        if ($(this).scrollTop() > windowHeight) {
			$('#toTop').addClass('showToTop');
        } else {
			$('#toTop').removeClass('showToTop');
        }
    });

	$("#toTop")
		.removeClass('showToTop')
		.on("click",function() {
			$("html, body").animate({ scrollTop: 0 }, 200);
		});

	// Translatable text bloc
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

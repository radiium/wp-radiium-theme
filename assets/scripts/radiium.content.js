jQuery( document ).ready( function( $ ) {

	var gridSelector = 'postsList';
	var itemSelector = 'postsListItem';

	var Shuffle = window.Shuffle;
    var element = document.querySelector('.' + gridSelector);

	if (element && $(element).children().length > 0) {
		var shuffleInstance = new Shuffle(element, {
			itemSelector: '.' + itemSelector,
			useTransforms: true,
			isCentered: true,
		});
		shuffleInstance.sort({ randomize: true });


		// Add clip-path rules on gallery item image
		var polydivInstance = new Polydiv({ itemClass: '.' + itemSelector + ' img'});
		polydivInstance.clipItems();


		var imgLoad = imagesLoaded( '.' + gridSelector);
		imgLoad.on( 'done', function() {
			shuffleInstance.layout();
			$('.hidenItem').removeClass('hidenItem');
		});

		$('.toggleFiltersBtn').click(function() {
			$(this).toggleClass('toggleActiv');
			$('.postControls').slideToggle(200);
		});

		// Filter items by group
		var filtersList = [];
		$('.postFilterBtn').click(function() {
			var filter = $(this).data('filter');

			if (filter == 'all') {
				filtersList = [];
				$('.activ').removeClass('activ');
				$('.postFilterAllBtn').addClass('activ');

			} else {
				var index = filtersList.indexOf(filter);
				$('.postFilterAllBtn').removeClass('activ');
				if (index === -1) {
					filtersList.push(filter);
					$(this).addClass('activ');
				} else {
					filtersList.splice(index, 1);
					$(this).removeClass('activ');
				}

				if (filtersList.length < 1) {
					$('.postFilterAllBtn').addClass('activ');
				}
			}

			shuffleInstance.filter(filtersList);
		});

		// Shuffle items
		$('.postShuffleBtn').click(function() {
			shuffleInstance.sort({ randomize: true });
		});

		// Reverse items
		$('.postReverseBtn').click(function() {
			var reverse = true;
			if (shuffleInstance.lastSort && shuffleInstance.lastSort.reverse !== null) {
				reverse = !shuffleInstance.lastSort.reverse;
			}
			shuffleInstance.sort({ reverse: reverse });
		});
	}
});

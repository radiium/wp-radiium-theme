jQuery( document ).ready( function( $ ) {

	var gridSelector = 'postsList';
	var itemSelector = 'postsListItem';

	var Shuffle = window.Shuffle;
	// var hull = window.hull;
    var element = document.querySelector('.' + gridSelector);

	if (element && $(element).children().length > 0) {
		var shuffleInstance = new Shuffle(element, {
			itemSelector: '.' + itemSelector,
			useTransforms: true,
			isCentered: true,
		});

		$('.' + itemSelector).each(function(i, item) {
			var clip = generateRandomClipPathRules();
			$(item).find('img').attr('style', clip)
		})


		var imgLoad = imagesLoaded( '.' + gridSelector);
		imgLoad.on( 'done', function() {
			shuffleInstance.layout();
			$('.hidenItem').removeClass('hidenItem');

		});

		$('.toggleFiltersBtn').click(function() {
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

function generateRandomClipPathRules() {
	/*
	var str = [];
	var hulls = hull(generateRandomPoints2(), 20);
	console.log('hulls', hulls)
	for (var i = 0; i < hulls.length; i++) {
		var h = hulls[i];
		str.push(h[0] + '%' + h[1] + '%')
	}
	*/

	var str = [];
	var hulls = makeHull(generateRandomPoints());
	for (var i = 0; i < hulls.length; i++) {
		var h = hulls[i];
		str.push(h.x + '%' + h.y + '%')
	}
	var clip = '-webkit-clip-path: polygon(' + str.join(',') + ');' +
				'clip-path: polygon(' +str.join(',') +');';

	return clip;
}

// Generate random number of random 2d coordinates
function generateRandomPoints() {
	var numPoints = Math.round(Math.pow(30, Math.random()) * 6);
	var points = [];
	for (var i = 0; i < numPoints; i++) {
		points.push({
			x: getRandomInt(0, 100),
			y: getRandomInt(0, 100),
		});
	}
	/*
	points.push({ x: 100, y: 0 });
	points.push({ x: 100, y: 100 });
	*/
	return points;
}
function generateRandomPoints2() {
	var numPoints = Math.round(Math.pow(30, Math.random()) * 6);
	var points = [];
	for (var i = 0; i < numPoints; i++) {
		points.push([
			getRandomInt(0, 100),
			getRandomInt(0, 100)
		]);
	}
	/*
	points.push({ x: 100, y: 0 });
	points.push({ x: 100, y: 100 });
	*/
	return points;
}

// Algorithm from https://www.nayuki.io/page/convex-hull-algorithm
// Returns the convex hull, assuming that each points[i] <= points[i + 1]. Runs in O(n) time.
function makeHull(points) {
	points.sort(POINT_COMPARATOR);
	if (points.length <= 1) {
		return points.slice();
	}

	var upperHull = [];
	for (var i = 0; i < points.length; i++) {
		var p = points[i];
		while (upperHull.length >= 2) {
			var q = upperHull[upperHull.length - 1];
			var r = upperHull[upperHull.length - 2];
			if ((q.x - r.x) * (p.y - r.y) >= (q.y - r.y) * (p.x - r.x))
				upperHull.pop();
			else
				break;
		}
		upperHull.push(p);
	}
	upperHull.pop();

	var lowerHull = [];
	for (var i = points.length - 1; i >= 0; i--) {
		var p = points[i];
		while (lowerHull.length >= 2) {
			var q = lowerHull[lowerHull.length - 1];
			var r = lowerHull[lowerHull.length - 2];
			if ((q.x - r.x) * (p.y - r.y) >= (q.y - r.y) * (p.x - r.x))
				lowerHull.pop();
			else
				break;
		}
		lowerHull.push(p);
	}
	lowerHull.pop();

	if (upperHull.length == 1 && lowerHull.length == 1 && upperHull[0].x == lowerHull[0].x && upperHull[0].y == lowerHull[0].y)
		return upperHull;
	else
		return upperHull.concat(lowerHull);
};

function POINT_COMPARATOR(a, b) {
	if (a.x < b.x)
		return -1;
	else if (a.x > b.x)
		return +1;
	if (a.y < b.y)
		return -1;
	else if (a.y > b.y)
		return +1;
	else
		return 0;
};

function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1) + min);
}

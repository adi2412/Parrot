$(window).load(function() {
	$('.gear').click(function() {
		$('.inner').toggle('slide', { direction: 'right' }, 500);
	});
});
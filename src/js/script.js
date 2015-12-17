$().ready( function () {
	$('#navigation ul a').each(function() {
		var link = $(this);
		link.removeClass('active');
		
		if(link.attr('href') == window.location.pathname) {
			link.addClass('active');
		}
	});
});
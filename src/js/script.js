$().ready( function () {
	$('#navigation ul a').each(function() {
		var link = $(this);
		link.removeClass('active');
		
		if(link.attr('href') == window.location.pathname) {
			link.addClass('active');
		}
	});
	
	$('#nav-toggle').click(function() {
		$('html').toggleClass('show-menu');
	});
});
$().ready( function () {

	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};
	
	if(isMobile.iOS()) {
		$('.screenshot').addClass('ios');
	} else {
		$('.screenshot').addClass('android');
	}

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
	


    var viewport = $(window);

    function fading() {

        $( '[data-type="prlx"]' ).each( function(){

            var self = $( this );

            var elementSpeed = self.attr( 'data-speed' );

            var elementPosition = self.offset().top;

            var windowPosition = viewport.scrollTop();

            if( self.attr( 'data-pos' ) == 'top' ) {

                windowPosition = windowPosition;

            } else {

                windowPosition = windowPosition + viewport.height() / 1.5;

            }

            var newPosition = ( windowPosition - elementPosition ) * ( elementSpeed / 33 );

            self.css({
                '-webkit-transform' : 'translate3d( 0, ' + newPosition + 'px, 0 )',
                'transform' : 'translate3d( 0, ' + newPosition + 'px, 0 )'
            });

        });

    }

    fading();
    viewport.on({
        'scroll' : function() {
            fading();
        },
        'resize' : function() {
            fading();
        },
        'orientationchange' : function() {
            fading();
        }
    });
});
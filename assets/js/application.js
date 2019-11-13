require("expose-loader?$!expose-loader?jQuery!jquery");
require("bootstrap/dist/js/bootstrap.bundle.js");

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
		$('html').addClass('ios');
	} else if(isMobile.Android()) {
		$('html').addClass('android');
		$('.front-image picture source').attr('srcset','/assets/images/app-android-dark.jpg');
		$('.front-image img').attr('src','/assets/images/app-android.jpg')
	}
});

criticalMapsUtils = {
   convertCoordinateFormat : function ( oldFormat ) {
    oldFormat = oldFormat.toString();
    var chars = oldFormat.split( '' );
    chars.splice( -6, 0, '.' );
    return chars.join( '' );
  }
}

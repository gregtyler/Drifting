// Navigation
( function() {
	var nav = document.getElementById( 'site-navigation' ), button, menu;
	if ( ! nav )
		return;
	button = nav.getElementsByTagName( 'h3' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	if ( ! button )
		return;

	// Hide button if menu is missing or empty.
	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function() {
		if ( -1 == menu.className.indexOf( 'nav-menu' ) )
			menu.className = 'nav-menu';

		if ( -1 != button.className.indexOf( 'toggled-on' ) ) {
			button.className = button.className.replace( ' toggled-on', '' );
			menu.className = menu.className.replace( ' toggled-on', '' );
		} else {
			button.className += ' toggled-on';
			menu.className += ' toggled-on';
		}
	};
} )();

// Image resizer
( function( $ ) {
    function resizeImages() {
        var pageWidth = $('body').width(),
            contentWidth = $('#content').width();
        $( '.attachment-huge' ).each(function(i,el){
            console.log( pageWidth, contentWidth );
            $(this).css({
                position: 'relative',
                width:pageWidth+'px',
                left:-1*Math.ceil((pageWidth-contentWidth+40)/2)+'px',
            });
        });
    }
    $(window).on('resize',resizeImages);
    resizeImages();
    
    if( $('.toc').size() ) {
        var $toc = $('.toc'),
            $ol = $toc.find('ol');
        $('h2').each(function(){
            var $h2 = $(this);
            code = $h2.html().toLowerCase().replace(/ /g,'-').replace(/([^a-z0-9-]*)/g,'').split('-').filter(function(n){return n}).join('-');
            $h2.prop( 'id', code );
            $ol.append(
                $('<li />').append(
                    $('<a />').prop('href','#'+code).html( $h2.html() )
                )
            );
        });
        $toc.show();
    }
} )( jQuery );

// Analytics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34023507-2']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
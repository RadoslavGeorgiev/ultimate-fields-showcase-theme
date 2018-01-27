jQuery(function( $ ){

	$( '.accordion-widget' ).each(function() {
		var sections = $( this ).find( '.widget-section' );

		$( this ).find( '.widget-section__title' ).click(function() {
			sections.removeClass( 'widget-section--visible' );
			$( this ).parent().addClass( 'widget-section--visible' );
		});

		sections.eq( 0 ).addClass( 'widget-section--visible' );
	});

});
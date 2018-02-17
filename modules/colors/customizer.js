UF3.customize.bind( 'main_color', function( value, context ) {

	$( 'body, .main-background' ).css( 'backgroundColor', value );
	$( '.main-border' ).css( 'borderColor', value );

});

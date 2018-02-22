(function() {

	var state = $.extend( {}, showcase_colors );

	function applyColor( color ) {
		$( 'body, .main-background' ).css( 'backgroundColor', color );
		$( '.main-border' ).css( 'borderColor', color );
		$( '.rte a' ).css( 'color', color );
		$( '.menu-triangle' ).css( 'border-bottom-color', color );
	}

	function updateState() {
		switch( state.color_type ) {
			case 'predefined':
				applyColor( state.predefined_color );
				break;

			case 'custom':
				applyColor( state.main_color );
				break;

			default:
				applyColor( '#0074a2' );
		}
	}

	$.each( [ 'color_type', 'predefined_color', 'main_color' ], function( i, property ) {
		UltimateFields.customize.bind( property, function( value ) {
			state[ property ] = value;
			updateState();
		});
	});

})();

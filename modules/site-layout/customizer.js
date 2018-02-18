(function(){

    var boxed = $( 'body' ).is( '.boxed' );
    var background = false;

    if( boxed ) {
        background = $( 'body' ).css( 'background-image' );

        if( background && 'none' === background ) {
            background = false;
        } else {
            background = background.replace( 'url(', '' ).replace( ')', '' );
        }
    }

    function refresh() {
        if( boxed ) {
            $( 'body' ).addClass( 'boxed' ).css({
                backgroundImage: background
                    ? 'url(' + background + ')'
                    : 'none'
            });
        } else {
            $( 'body' ).removeClass( 'boxed' ).css({
                backgroundImage: 'none'
            });
        }
    }

    UF3.customize.bind( 'site_layout', function( value, context ) {
        boxed = 'boxed' === value;
        refresh();
    });

    UF3.customize.bind( 'site_background', function( value, context ) {
        if( value ) {
            background = context.url;
        } else {
            background = false;
        }

        refresh();
    });

})();

(function(){

    var state = showcase_layout_vars;

    function refresh() {
        if( 'boxed' == state.site_layout ) {
            $( 'body' ).addClass( 'boxed' ).css({
                backgroundImage: state.site_background
                    ? 'url(' + state.site_background + ')'
                    : 'none'
            });
        } else {
            $( 'body' ).removeClass( 'boxed' ).css({
                backgroundImage: 'none'
            });
        }
    }

    UltimateFields.customize.bind( 'site_layout', function( value, context ) {
        state.site_layout = value;
        refresh();
    });

    UltimateFields.customize.bind( 'site_background', function( value, context ) {
        if( value ) {
            state.site_background = context.url;
        } else {
            state.site_background = false;
        }

        refresh();
    });

})();

# Ultimate Fields Showcase: Site Layout

The Site Layout module of the Ultimate Fields Showcase theme showcases the customizer location while allowing you to select a boxed or a full-width layout for the website.

## Used features

- The [Customizer](https://www.ultimate-fields.com/docs/locations/customizer/) location
- The [Tab](https://www.ultimate-fields.com/docs/fields/tab), [Select](https://www.ultimate-fields.com/docs/fields/select) and [Image](https://www.ultimate-fields.com/docs/fields/image) fields

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_site_layout_fields` function.

The container is assigned to the customizer location with all fields being `postmessage_fields`:

```php
Container::create( 'site-layout' )
    ->add_location( 'customizer', [
        'postmessage_fields' => [ 'site_layout', 'site_background' ]
    ])
```

There are a few fields in there:

```php
Field::create( 'tab', 'layout', __( 'Layout', 'showcase' ) )
    ->set_icon( 'dashicons-editor-table' ),
Field::create( 'select', 'site_layout', __( 'Site Layout', 'showcase' ) )
    ->set_input_type( 'radio' )
    ->add_options(array(
        'wide'  => __( 'Wide', 'showcase' ),
        'boxed' => __( 'Boxed', 'showcase' )
    )),
Field::create( 'tab', 'background', __( 'Background', 'showcase' ) )
    ->set_icon( 'dashicons-admin-appearance' )
    ->add_dependency( 'site_layout', 'boxed' ),
Field::create( 'image', 'site_background', __( 'Background', 'showcase' ) )
```

The second tab is disabled when `'wide'` is selected for the `site_layout` field, as at that point a background would not make sense.

## Customizing the front-end

### Changing the body class
The styles of the module contain the `boxed` CSS class, which centers all of the website's content. To apply the class to the body element, we will use the `body_class` filter.

```
add_filter( 'body_class', 'showcase_layout_class' );
function showcase_layout_class( $classes ) {
    if( 'boxed' == get_value( 'site_layout', 'option' ) ) {
        $classes[] = 'boxed';
    }

    return $classes;
}
```

### Adding the background

We will use the `wp_enqueue_scripts` and `wp_add_inline_style` action and filter in order to add the background as an inline style to the body element:

```php
if( 'boxed' != get_value( 'site_layout', 'option' ) ) {
    return;
}

$image = get_value( 'site_background', 'option' );
if( ! $image ) {
    return;
}

$url = wp_get_attachment_url( $image );

$css = " body.boxed {
    background-image: url($url);
} ";

wp_add_inline_style( 'site-layout', $css );
```

First we are checking if the boxed layout is used for the website. If yes and there is a background image, it is applied.

## Updating values in the Customizer

This step is a bit more complicated, as we not only need to enqueue an additional script, but also prepare the initial data. All of that is done in the `showcase_layout_js` function.

The first thing to do there is to enqueue the `showcase-layout` script with both `jquery` and more importantly, `uf-customize-preview` as dependencies. Next, we are getting the values for the layout and the background, which are being forwarded to JavaScript as the `showcase_layout_vars` variable through the `wp_localize_script` function.

### The JavaScript

The `refresh` function in JavaScript uses the `state` object (defined through `wp_localize_script` above) in order to update the page with the new styles.

```js
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
```

The `refresh` function is executed by the following code:

```js
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
```

We are listening for both `site_layout` and `site_background` and saving the appropriate item in the state. Lastly `refresh` handles the updates.

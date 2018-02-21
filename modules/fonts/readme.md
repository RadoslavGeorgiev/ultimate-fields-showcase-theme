# Ultimate Fields Showcase: Fonts

The Fonts module of the Ultimate Fields Showcase theme allows users to select what font to use for the front-end of the website.

## Used features

- The [Options Page](https://www.ultimate-fields.com/docs/locations/options-page/) location
- The [Message](https://www.ultimate-fields.com/fields/message/) and [Font](https://www.ultimate-fields.com/fields/font/) fields

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_add_fonts_page` function.

The function creates a new container and adds the Options location to it, using the existing __Theme Options__ page from the theme:

```php
Container::create( 'fonts' )
	->add_location( 'options', $GLOBALS['showcase_options_page'] )
```

Next, the function checks if there is a valid Google Fonts API key. If there is one, it creates a `body_font` field, if not - a message:

```php
if( get_option( 'uf_google_fonts_api_key' ) ) {
	$field = Field::create( 'font', 'body_font', __( 'Body Font', 'showcase' ) )
		->set_description( __( 'This font will be applied to the whole website.', 'showcase' ) );
} else {
	$description = __( 'Please go to Ultimate Fields > Settings and enter an API key.', 'showcase' );
	$field = Field::create( 'message', 'font_api', __( 'Missing API Key', 'showcase' ) )
		->set_description( $description );
}
```

## Usage in the front-end

The `showcase_load_font` function, triggered on the `wp_enqueue_scripts` action, checks if a font has been selected and enqueues it:

```php
$font = get_value( 'body_font', 'option' );

$url = Field\Font::get_font_url( $font );
wp_enqueue_style( $font['family'], $url );
```

The `UF\Field\Font::get_font_url` generates the URL for the fonts' stylesheets based on the value of a field. We are using it in combination with `wp_enqueue_style` in order to load the font.

Next, we have to apply it to the body. To do so, we will use the `wp_add_inline_style` function, which adds styles based on an enqueued stylesheet:

```php
$css = 'body {
	font-family: "' . $font['family'] . '", Sans-Serif;
}';

wp_add_inline_style( 'showcase', $css );
```

In this case we are simply changing the font-family of the body, which is inherited by all texts on the page.

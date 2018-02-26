# Ultimate Fields Showcase: Quote

The Quote module of the Ultimate Fields Showcase theme utilises the Shortcode location in order to allow users to enter a quote shortcode while using the UI of Ultimate Fields.

## Used features

- The [Shortcode](https://www.ultimate-fields.com/docs/locations/shortcode/) location
- The [Textarea](https://www.ultimate-fields.com/docs/fields/textarea), [Text](https://www.ultimate-fields.com/docs/fields/text), [Color](https://www.ultimate-fields.com/docs/fields/color), and [Section](https://www.ultimate-fields.com/docs/fields/section) fields

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_shortcode_fields` function. In it, we are creating a container for the shortcode and adding fields to it. Since shortcodes are managed by the location, we do not need to create one before adding fields to it.

```php
Container::create( 'Quote' )
    ->add_location( 'shortcode', array(
        'template' => $template
    ))
    ->add_fields(array(
        Field::create( 'section', 'quote_content', __( 'Content', 'showcase' ) )
            ->set_icon( 'dashicons-admin-comments' ),
        Field::create( 'textarea', 'text', __( 'Text', 'showcase' ) )
            ->required(),
        Field::create( 'text', 'author', __( 'Author', 'showcase' ) )
            ->required(),
        Field::create( 'section', 'quote_appearance', __( 'Appearance', 'showcase' ) )
            ->set_icon( 'dashicons-admin-appearance' ),
        Field::create( 'color', 'text_color', __( 'Text Color', 'showcase' ) )
            ->required()
            ->set_default_value( '#333333' ),
        Field::create( 'color', 'background_color', __( 'Background Color', 'showcase' ) )
            ->required()
            ->set_default_value( '#eeeeee' ),
    ));
```

## Defining the template

When dealing with a shortcode, you need to create a front-end template for it and a preview for the editor (optionally).

## The preview
Before we register the container, we are reading out the `preview.html` template and using it as the `template` argument of the location. This HTML will be used to render the preview of the shortcode in the back-end. The template itself is quite simple:

```html
<blockquote style="margin: 0 0 1em; padding: 1em 2em .5em; background: <%= background_color %>; color: <%= text_color %>">
	<%= text %>
	<h4><%= author %></h4>
</blockquote>
```

As you see, inside of the template we are using Underscore.js templates to display the values of fields. All values for the container are available as variables, named the same way as fields. Just keep in mind that this represents the raw values of fields.

## The front-end template

Ultimate Fields does not automatically handle the front-end rendering of shortcode, but it still provides a helper for their values. This way, we can include a simple template for the shortcode without having to forward any variables to it:

```php
add_shortcode( 'quote', 'showcase_quote' );
function showcase_quote( $atts ) {
	ob_start();
	include __DIR__ . '/template.php';
	return ob_get_clean();
}
```

Within the template, you can use standard `*_value` functions with `"shortcode"` as the type argument:

```php
<blockquote class="quote" style="background: <?php the_value( 'background_color', 'shortcode' ) ?>; color: <?php the_value( 'text_color', 'shortcode' ) ?>">
	<?php the_value( 'text', 'shortcode' ) ?>
	<h4><?php the_value( 'author', 'shortcode' ) ?></h4>
</blockquote>
```

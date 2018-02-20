[« Back to the root](../..)

# Ultimate Fields Showcase: Colors

This module adds the ability to customize the main color of the theme through a container, which is displayed both on the Theme Options page, as well as a section in the customizer.

## Used features

- The [Options Page](https://www.ultimate-fields.com/docs/locations/options-page/) location, which also displays the container in the customizer
- The [Message](https://www.ultimate-fields.com/docs/fields/message/), [Select](https://www.ultimate-fields.com/docs/fields/select/)
[Image select](https://www.ultimate-fields.com/docs/fields/image-select/) and [Color](https://www.ultimate-fields.com/docs/fields/color/) fields

## Defining the fields

As in every module, we use the `uf.init` action to create additional fields, in this case through the `showcase_colors_fields` function. Unlike most other modules, the body of the function is quite long here, but most of it is quite simple when broken down.

In the beginning of the file, we are defining a variable called `$message`. It contains a message, which will be displayed when viewing the container on the Theme Options page. The message states that the same functionality is available int he configurator with a live preview.

Next, we are creating the container without adding fields to it:

```php
$container = Container::create( 'theme-colors', __( 'Theme colors', 'showcase' ) )
	->add_location( 'options', $GLOBALS['showcase_options_page'], [
		'show_in_customizer' => true,
		'postmessage_fields' => [ 'color_type', 'main_color', 'predefined_color' ]
	]);
```

During creation, we are assigning the container to a variable, which will be used to add fields to it later. In the arguments of the location we are indicating that we want to `show_in_customizer` with all fields, defined later as postMessage fields.

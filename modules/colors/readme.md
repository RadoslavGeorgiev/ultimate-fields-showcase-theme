# Ultimate Fields Showcase: Colors

This module adds the ability to customize the main color of the theme through a container, which is displayed both on the Theme Options page, as well as a section in the customizer.

## Used features

- The [Options Page](https://www.ultimate-fields.com/docs/locations/options-page/) location, which also displays the container in the Customizer
- The [Message](https://www.ultimate-fields.com/docs/fields/message/), [Select](https://www.ultimate-fields.com/docs/fields/select/)
[Image select](https://www.ultimate-fields.com/docs/fields/image-select/) and [Color](https://www.ultimate-fields.com/docs/fields/color/) fields

## Defining the container, locations and fields

As in every module, we use the `uf.init` action to create additional fields, in this case through the `showcase_colors_fields` function. Unlike most other modules, the body of the function is quite long here, but most of it is quite simple when broken down.

In the beginning of the file, we are defining a variable called `$message`. It contains a message, which will be displayed when viewing the container on the Theme Options page. The message states that the same functionality is available int he configurator with a live preview.

### Creating the container

Next, we are creating the container without adding fields to it:

```php
$container = Container::create( 'theme-colors', __( 'Theme colors', 'showcase' ) )
	->add_location( 'options', $GLOBALS['showcase_options_page'], [
		'show_in_customizer' => true,
		'postmessage_fields' => [ 'color_type', 'main_color', 'predefined_color' ]
	]);
```

During creation, we are assigning the container to a variable, which will be used to add fields to it later. In the arguments of the location we are indicating that we want to `show_in_customizer` with all fields, defined later as postMessage fields.

Please also note that the global variable `showcase_options_page` is being used. The variable is created by the theme and contains a handle to an `UF\Options_Page` object.

### Adding fields

First we are checking if the user is currently viewing a customizer preview with the `is_customize_preview` function. If not, we are adding a Message field that guides the user to the customizer. This is done through the `add_field` method, which accepts a single field.

The main fields of the container are:

1. A Select field named *Color Type*, which lets the user select between the default background, a set of predefined options or a custom color. This field is used to control the visibility of the rest of the fields in the container.
2. An Image Select field named `predefined_color` with a *Color* label. The field allows the user to visually select from a few pre-defined patterns and is only shown when `predefined` is selected in the color type field.
3. A Color field named `main_color`, also labelled *Color*. Since it is only shown when the color type is set to `custom`, there is no issue with using the same label as the previous field.

The logic is based on the color type field as follows:

- When __Default color__ is selected, the default theme color will be used.
- When __Predefined color__ is selected, we will use the key of the selected predefined color.
- When __Custom color__ is selected, users can select a color manually.

### Customizing the CSS in the front-end

In order to customize the colors of the website, we will use some additional CSS. The best way to do so in WordPress is to use the `wp_add_inline_style` function. It works based on a styleseet (the theme stylesheet in this case) and ensures that the initial styles of the website have already been loaded before outputting the custom CSS. This way we do not have to worry about CSS selector complexities.

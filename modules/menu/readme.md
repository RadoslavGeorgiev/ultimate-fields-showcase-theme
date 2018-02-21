# Ultimate Fields Showcase: Menu

The Menu module of the Ultimate Fields Showcase theme extends the functionality of WordPress menus by allowing users to select an icon for each menu item and to switch to a "mega menu", which uses a custom sidebar within the dropdown.

## Used features

- The [Menu Item](https://www.ultimate-fields.com/docs/locations/menu-item/) location
- The [Icon](https://www.ultimate-fields.com/fields/icon/), [Select](https://www.ultimate-fields.com/fields/select/) and [Sidebar](https://www.ultimate-fields.com/fields/sidebar/) fields

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_menu_fields` function. In it, we are creating a single container, which should only appear on first-level menu items.

```php
Field::create( 'icon', 'menu_icon', __( 'Icon', 'showcase' ) )
	->add_set( 'font-awesome' )
	->set_output_format( 'icon' ),
Field::create( 'select', 'sub_menu_type', __( 'Sub menu', 'showcase' ) )
	->set_input_type( 'radio' )
	->add_options(array(
		'normal'  => __( 'Display sub-menu items', 'showcase' ),
		'widgets' => __( 'Display widgets', 'showcase' )
	)),
Field::create( 'sidebar', 'menu_sidebar', __( 'Sidebar', 'showcase' ) )
	->add_dependency( 'sub_menu_type', 'widgets' )
	->make_editable()
```

The fields array contains:

1. An icon field, which is always available.
2. A sub-menu type selector. Users can check if they'd like to display the standard sub-menu items or a sidebar with widgets.
3. A sidebar field, which only appears when "Display widgets" is chosen and allows users to create new sidebars because of the `make_editable` method.

##

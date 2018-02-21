# Ultimate Fields Showcase: Events

The Events module of the Ultimate Fields Showcase theme creates a new post type foe events and assigns a few additional fields to it, including start & end dates + a location.

## Used features

- The [Post Type](https://www.ultimate-fields.com/docs/locations/post-type/) location
- The [Section](https://www.ultimate-fields.com/fields/section/), [Date](https://www.ultimate-fields.com/fields/date/), [Checkbox](https://www.ultimate-fields.com/fields/checkbox/) and [Map](https://www.ultimate-fields.com/fields/map/) fields

## Creating the post type

The `showcase_register_events` function performs a basic post type registration on the `init` action. It uses standard parameters for `register_post_type` and then checks if permalinks need to be flushed.

## Assigning fields

As always, fields as created on the `uf.init` action, in this case within the `showcase_add_event_fields` function.

The function creates a new container called "Event Details" and associates it with the `event` post type. Within the container, we are using the following types of fields:

1. Two sections (Duration & Location), separating the fields functionally from each-other. To improve contrast, both sections use an icon and the `blue` color.
2. Two date fields (Starting & End Date), which are required.
3. A checkbox field (Physical Event), which toggles whether the event actually has a physical location.
3. A map field (Location), where users can select the location of the event if it is a physical one.

## Displaying the data of events

We will use the existing templates of the theme, while utilizing some actions to display the actual event details like date and location.

### Displaying dates in the loop

The `showcase.before_loop_content` action is triggered right before `the_content()` within loops and allows us to display the event details through the `showcase_display_event_dates` function.

The function checks if the details about an event are being displayed and if they are, also displays the start & end dates.

### Displaying dates and the location on singular events

Similarly to the loop, the theme has an action before and after the content on singular pages.

For this example, we are using the `showcase.before_post_content` action and attaching the `showcase_display_event_location` function to it.

Within `showcase_display_event_location` we are checking for the post type and if it is a physical event, we are displaying its location. The date is also displayed without any conditionals.

```php
function showcase_display_event_location() {
	if( 'event' != get_post_type() ) {
		return;
	}

	if( get_value( 'event_is_phyisical' ) ) {
		the_value( 'event_location' );
	}

	showcase_display_event_dates();
}
```

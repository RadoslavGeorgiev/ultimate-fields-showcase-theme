# Ultimate Fields Showcase: Enhanced Categories

The Enhanced Categories module of the Ultimate Fields Showcase theme improves categories by changing the color of their posts, as well as the amount of posts per page on their listings.

## Used features

- The [Taxonomy](https://www.ultimate-fields.com/docs/locations/taxonomy/) location
- The [Color](https://www.ultimate-fields.com/docs/fields/color/) and [Number](https://www.ultimate-fields.com/docs/fields/number/) fields.

## Assigning fields

As always, fields as created on the `uf.init` action, in this case within the `showcase_add_category_fields` function:

```php
Container::create( 'enchanced-categories' )
	->add_location( 'taxonomy', 'category' )
	->add_fields(array(
		Field::create( 'color', 'category_color', __( 'Category Color', 'showcase' ) )
			->set_default_value( '#333333' ),
		Field::create( 'number', 'posts_per_page', __( 'Posts per page', 'showcase' ) )
			->set_default_value( get_option( 'posts_per_page' ) )
			->enable_slider( 1, 20 )
	));
```

Within this container we are creating two fields:

1. A `category_color` field, which lets users select a custom color for the links of the posts in the category.
2. A `posts_per_page` number field, which has a slider enabled for the amount of posts and uses the `posts_per_page` option as its default value.

## Adjusting the amount of posts

Before actually loading posts, WordPress always executes the `pre_get_posts` action for every query. In order to change the `posts_per_page` setting, we need to hook into that action and make sure that the current query is __the main query__, that it is handling __a category__ and that we are not in the back-end of WordPress.

```php
add_action( 'pre_get_posts', 'showcase_category_ppp' );
function showcase_category_ppp( $query ) {
	if( is_admin() || ! $query->is_main_query() || ! $query->is_category() ) {
		return;
	}

	$cat = get_queried_object();
	$count = get_value( 'posts_per_page', 'category_' . $cat->term_id );
	$query->set( 'posts_per_page', $count );
}
```

Once we are sure about that, we can use the `get_queried_object` function to locate the currently displayed category and use its `term_id` in order to load the value of the number field. Once that is done, the last step is to use the `set` method of the query in order to update the amount of posts.

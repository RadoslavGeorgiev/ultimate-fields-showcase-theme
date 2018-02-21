# Ultimate Fields Showcase: Downloads

The Downloads module of the Ultimate Fields Showcase theme displays a downloadable file at the end of a post.

## Used features

- The [Post Type](https://www.ultimate-fields.com/docs/locations/post-type/) location
- The [File](https://www.ultimate-fields.com/docs/fields/file/) field

## Assigning fields

As always, fields as created on the `uf.init` action, in this case within the `showcase_add_downloads` function:

```php
Container::create( 'post-downloads' )
	->add_location( 'post_type', 'post' )
	->add_fields(array(
		Field::create( 'file', 'downloadable_file', __( 'Downloadable file', 'showcase' ) )
	));
```

In this case the location definition is as simple as it gets - the group is simply displayed on all posts. And it contains a single field, which does not require any additional setup - a file field.

## Displaying in the front-end

We will display a standard link to the file at the end of a posts' content when a file is chosen. To do so, the `showcase_render_downloads` function has been assigned to `the_content` filter:

```php
add_filter( 'the_content', 'showcase_render_downloads' );
function showcase_render_downloads( $content ) {
	if( $file = get_value( 'downloadable_file' ) ) {
		$content .= sprintf(
			'<a href="%s" download><span class="fa fa-download"></span> %s</a>',
			wp_get_attachment_url( $file ),
			esc_html( get_the_title( $file ) )
		);
	}

	return $content;
}
```

Within the function, we are using `get_value` to check if there is a file, associated with the current post. If there is one, we are appending it to the content through the `sprintf` function.

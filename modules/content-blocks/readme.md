[« Back to the root](https://github.com/RadoslavGeorgiev/uf3-showcase-theme/readme.md)

# Content Blocks Module
This module showcases the functionality of the `Layout` field by replacing the content editor of pages with a layout field, which contains a few block types.

To do this, we are performing the following steps:
1. Remove the normal editor
2. Add the new fields in the back-end
3. Add the logic that displays data in the front-end

## Removing the editor
The normal WYSIWYG editor is included through the `supports` property of the built-in pages post type. To remove it, we need to use `remove_post_type_support` at a stage when the post type already exists. The `init` hook is a good moment for that:

```php
add_action( 'init', 'showcase_blocks_remove_editor' );
function showcase_blocks_remove_editor() {
	remove_post_type_support( 'page', 'editor' );
}
```

## Adding fields to the back-end

To register new fields you we need to use the `uf.init` action. On that action, we are creating a new field of the type `layout` with the name of `page_content`. `page_content` is the name that we will use to retrieve data in the front-end.

Then we are adding that field to a new container, which is displayed on pages. To define the rule, we are using `->add_location( 'post_type', 'page' )`;

```php
add_action( 'uf.init', 'showcase_blocks_field' );
function showcase_blocks_field() {
	$blocks_field = Field::create( 'layout', 'page_content', __( 'Content Blocks', 'showcase' ) );

	// add blocks here

	Container::create( __( 'Page Content', 'showcase' ) )
		->add_location( 'post_type', 'page' )
		->add_fields(array(
			$blocks_field->hide_label()
		));
}
```

The `hide_label` method of fields is very suitable when a container contains a single field, like the one above. This way, we're avoiding the repetition of "Content Blocks" as the title of both the meta box on the field inside.

To add blocks (groups) to the field, we use the `add_group` method with the following methods:
1. `title` sets the title of the block, as displayed in the back-end.
2. `type` sets the type of the block, which we will check for in the front-end.
3. `min_width` sets the minimum space a block can occupy.
4. `max_width` sets the maximum width a block could use.
5. `fields` sets the fields of the block.
# Ultimate Fields Showcase: Content Blocks Module
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

While we are in the function, we'll also define a few image sizes for within content blocks through the `add_image_size` function.

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

The `hide_label` method of fields is very suitable when a container contains a single field, like the one above. This way, we're avoiding the repetition of "Content Blocks" as the title of both the meta box on the field inside.]

To add blocks (groups) to the field, we use the `add_group` method with the following methods:
1. `title` sets the title of the block, as displayed in the back-end.
2. `type` sets the type of the block, which we will check for in the front-end.
3. `min_width` sets the minimum space a block can occupy.
4. `max_width` sets the maximum width a block could use.
5. `icon` instructs the group to use a specific font icon.
5. `fields` sets the fields of the block.

The inidivudal blocks will be explaned in [Blocks](#blocks) below.

## Creating and using a reusable container

As you can see in the beginning of the `showcase_blocks_field` function, we are creating an additional container, called `button`. This container is not assigned to an individual location - instead it will be used as the provider of sub-fields for complex fields later.

For example, we will create a complex field called `button` in the text block.


```php
Field::create( 'complex', 'button', __( 'Button', 'showcase' ) )
	->load_from_container( 'button' )
```

As you can see, the definition of the field is quite simple. The only thing we need to do is use the `load_from_container` method and provide the name of the container. Now, the button fields are included as sub-fields in the text module.

Since the fields for the button are isolated, there is also an isolated `button.php` template, which uses their values.

Within the template, we are utilizing a standard `have_groups`-`the_group` loop, which checks if there are button values at all and displays a button:

```php
<?php while( have_groups( 'button' ) ): the_group() ?>
    <?php if ( get_sub_value( 'link' ) && get_sub_value( 'text' ) ): ?>
		<!-- Button Here -->
    <?php endif; ?>
<?php endwhile; ?>
```

Once the template is in place, we can include it easily from any block, which uses the complex field:

```php
<?php require __DIR__ . '/button.php' ?>
```

## Displaying blocks in the front-end

Within the `page.php` template of the theme, the content of the whole template is being wrapped by a conditional statement:

```php
<?php if( ! apply_filters( 'showcase.content', false ) ): ?>
	<!-- Content here -->
<?php endif ?>
```

This allows us to modify the boolean `false` and short-circuit the normal content of the page, which is exactly what we are doing in the `showcase_blocks_content` function;

```php
add_filter( 'showcase.content', 'showcase_blocks_content' );
function showcase_blocks_content( $display ) {
	if( is_page() ) {
		include __DIR__ . '/layout.php';
		return true;
	}

	return $display;
}
```

If a page is being displayed, we simply include the `layout.php` file and return true. Doing so will prevent other modules or the theme itself from displaying standard content.

### Rendering the layout

```php
<?php while( have_layout_rows( 'page_content' ) ): the_layout_row() ?>
  <?php if( 'image' == get_group_type() && 12 == get_group_width() && get_sub_value( 'full_width' ) ): ?>
    <?php the_group() ?>
    <!-- Image block content -->
  <?php else: ?>
  <div class="row">
    <?php while( have_groups( 'page_content' ) ): the_group() ?>
      <div class="layout__column" style="flex: <?php echo get_group_width() ?>">
        <?php include __DIR__ . '/block-' . get_group_type() . '.php' ?>
      </div>
    <?php endwhile ?>
  </div>
  <?php endif ?>
<?php endwhile ?>
```

As described in the [Usage section in the docs](https://www.ultimate-fields.com/docs/fields/layout/#usage), we are using the `have_layout_rows`, `the_layout_row`, `have_groups`, `the_group`, `get_group_width` and `*_sub_value` functions. All of them are described in the docs, we will not focus on them.

Instead, let's focus on this conditional:

```php
<?php if( 'image' == get_group_type() && 12 == get_group_width() && get_sub_value( 'full_width' ) ): ?>
	<?php the_group() ?>
	<!-- Image block content -->
<?php else: ?>
	<?php while( have_groups( 'page_content' ) ): the_group() ?>
		<!-- Standard content -->
	<?php endwhile ?>
<?php endif ?>
```

What we are doing here is quite specific and there are a few things to note:

1. Once within the rows loop, we already have access to the first group of the current row. Because of this, we can call `get_group_type()`, `get_group_width()` and `get_sub_value()` even before calling `the_group()`. This allows us to make decisions for the whole row based on the first block inside of it. Doing so is particularly useful if we'd like to handle full-width groups differently.
2. Within the image block, there is a checkbox called `full_width`, which is only shown when the `__width` property of the group is set to 12, a.k.a. full width. In combination with it, we can do the following checks to make sure that we'd like to display a full-width element:
  1. The current block type is `image`. This is the only block type, which supports full width in this case.
  2. The block takes up the full 12 columns available. Otherwise the value of the `full_width` field is meaningless.
  3. `full_width` is actually checked.
3. If a full-width block is not displayed, the standard `have_groups()` - `the_group()` loop is entered.

For all normal blocks there is a `block-{type}.php` file, which uses `get_sub_value` and `the_sub_value` normally.

## Blocks

Below you will find a list of all individual modules. Please check their definitions in `module.php` and the individual `block-{type}.php` template in order to see how they work.

- Text Block (`text`) is bla
- Image (`image`) displays a simple image. In case the block is using the full amount of columns, an additional full-screen checkbox is displayed.
- Video (`video`) displays an HTML5 video tag.
- Embed (`embed`) loads an embed based on the Embed field and displays it.
- Gallery (`gallery`) allows multiple images to be selected and displays them through the `gallery` shortcode.
- Audio Player (`audio`) displays an HTML5 audio tag based on the audio field.
- Teaser Link (`teaser`) uses an Object field in order to select a post, whose teaser is to be displayed and displays the teaser.

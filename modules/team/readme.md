# Ultimate Fields Showcase: Related Posts

The Team module of the Ultimate Fields Showcase theme showcases the repeater field by allowing users to enter multiple team members and separate them within departments. This is done through a separate page template.

## Used features

- The [Post Type](https://www.ultimate-fields.com/docs/locations/post-type/) location
- The [Repeater](https://www.ultimate-fields.com/docs/fields/repeater/), [Text](https://www.ultimate-fields.com/docs/fields/text/), and [Textarea](https://www.ultimate-fields.com/docs/fields/textarea/) fields

## Defining the new template

WordPress allows templates to be modified through the `theme_page_templates` filter, which we will do:

```php
add_filter( 'theme_page_templates', 'showcase_add_team_template', 10, 4 );
function showcase_add_team_template( $templates ) {
    $templates[ 'team' ] = __( 'Team', 'showcase' );
    return $templates;
}
```

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_add_team_fields` function. The first thing to do there is to hide the fields of the Content Blocks module on the new template:

```php
foreach( Container::get_registered() as $container ) {
    if( 'page-content' == $container->get_id() ) {
        foreach( $container->get_locations() as $location ) {
            $location->templates = '-team';
        }
    }
}
```

We are using the `Container::get_registered()` method to loop through all existing containers and change the location of the `page-content` one.

Next, a repeater is created like this:

```php
Field::create( 'repeater', 'team' )
    ->add_group( 'department', array(
        'fields' => array(
            Field::create( 'text', 'name' )
        )
    ))
    ->add_group( 'member', array(
        'fields' => array(
            Field::create( 'text', 'first_name' )
                ->required(),
            Field::create( 'text', 'last_name' )
                ->required(),
            Field::create( 'textarea', 'bio' )
                ->add_paragraphs()
        )
    ))
```

As you see, `add_group` is called first for a `department` group and for a `member` group afterwards. Both groups have just a few fields.

## Overwriting the template

The `showcase_team_content` uses the `showcase.content` filter, which is triggered by the theme.

```php
add_filter( 'showcase.content', 'showcase_team_content', 9 );
function showcase_team_content( $display ) {
	if( is_page_template( 'team' ) && ! $display ) {
		include __DIR__ . '/template.php';
		return true;
	}

	return $display;
}
```

Within the filter, we are checking for the new page template and if it is being used, the content of the page is overwritten by the content of the `template.php` file.

### The template

```php
<div class="section main team">
    <div class="section__center">
        <?php while( have_groups( 'team' ) ): the_group() ?>

            <?php if( 'department' == get_group_type() ): ?>

                <h2 class="team__department"><?php the_sub_value( 'name' ) ?></h2>

            <?php else: ?>

				<div class="team__member">
	                <h3><?php the_sub_value( 'first_name' ) ?> <?php the_sub_value( 'last_name' ) ?></h3>
	                <?php the_sub_value( 'bio' ) ?>
				</div>

            <?php endif ?>

        <?php endwhile ?>
    </div>
</div>
```

As you can see, there is a `have_groups` - `the_group` loop which wraps all groups of the field. In there we are checking for the group type by calling `get_group_type` and checking wither the current group is a department or an individual member.

Within the loop we are using `the_sub_value` to display the values of individual sub-fields.

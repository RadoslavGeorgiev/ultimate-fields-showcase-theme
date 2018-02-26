# Ultimate Fields Showcase: Related Posts

The Related Posts module of the Ultimate Fields Showcase theme allows users to select multiple related posts to the current one and displays those posts at the end of the post's content.

## Used features

- The [Post Type](https://www.ultimate-fields.com/docs/locations/post-type/) location
- The [WP Objects](https://www.ultimate-fields.com/docs/fields/wp-objects/) field

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_related_posts_fields` function. In it, we are creating a container and associating it with the `post` post type. It has a single field, which is an `wp_objects` field, where we are adding all posts by calling `->add( 'posts', 'post_type=post' )` as a method.

## Displaying the posts

To display the related posts, we will use the `the_content` filter, provided by WordPress.

The `showcase_display_related_posts` function receives the content of the post as an argument and we will be augmenting it.

We will use two things to do so:

```php
if( ! is_singular() || ! get_value( 'related_posts' ) ) {
    return $content;
}
```

The first thing to do is check if an actual post is being displayed and whether there are related posts. If there are posts, we will buffer the `template.php` template and append it to the template:

```php
ob_start();
include( __DIR__ . '/template.php' );
$posts = ob_get_clean();
```

### The template

Within the template, the value of the `related_posts` field is used with a foreach loop:

```php
<?php foreach( get_value( 'related_posts' ) as $post ): ?>
<li>
    <a href="<?php echo get_permalink( $post->ID ) ?>">
        <?php echo esc_html( $post->post_title ) ?>
    </a>
</li>
<?php endforeach ?>
```

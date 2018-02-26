# Ultimate Fields Showcase: Photographers

The Photographers module of the Ultimate Fields Showcase theme allows the selection of a photographer for images, photographers being standard WordPress users. It then adds fields to users, where a copyrights link can be entered. Finally, the link is displayed next to featured images in the theme.

## Used features

- The [Attachment](https://www.ultimate-fields.com/docs/locations/attachment/) and [User](https://www.ultimate-fields.com/docs/locations/user/) locations
- The [WP Object](https://www.ultimate-fields.com/fields/wp-object/) and [Link](https://www.ultimate-fields.com/fields/link/) fields

## Registering fields

As always, fields are registered on the `uf.init` action, in this case by the `showcase_photographer_fields` function. In it, we are creating two containers and adding fields to them:

```php
Container::create( 'image-photographer' )
    ->add_location( 'attachment' )
    ->add_fields(array(
        Field::create( 'wp_object', 'photographer', __( 'Photographer', 'showcase' ) )
            ->add( 'users' )
    ));

Container::create( 'photographer-data' )
    ->add_location( 'user' )
    ->add_fields(array(
        Field::create( 'link', 'copyrights_link' )
    ));
```

The first container, Image Photographer, is displayed on all attachments and displays an WP Object, field, which lets editors select a photographer.

The second container, Photographer Data, allows for the entry of a Copyrights Link through a Link field.

## Displaying data

The theme triggers an `showcase.after_thumbnail` action right after displaying the featured image of a post if there is one. We are hooking the `showcase_photographer_credits` function on the action in order to display the copyrights.

Within the function, we are doing the following actions.

First, we use `get_post_thumbnail_id` to retrieve the ID of the thumbnail image if one is set. If there is an image, we are using `get_value` to retrieve the photographer (user) object. If there is one, his/hers name will be used for the copyrights text.

Next, we use `get_value( 'copyrights_link', 'user_' . $photographer->ID )` in order to retrieve the link if there one. If yes, the text gets wrapped within a link.

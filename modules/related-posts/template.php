<h3><?php _e( 'Related posts:', 'showcase' ) ?></h3>

<ul>
    <?php foreach( get_value( 'related_posts' ) as $post ): ?>
    <li>
        <a href="<?php echo get_permalink( $post->ID ) ?>">
            <?php echo esc_html( $post->post_title ) ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>

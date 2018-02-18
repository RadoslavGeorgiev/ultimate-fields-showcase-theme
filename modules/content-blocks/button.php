<?php while( have_groups( 'button' ) ): the_group() ?>
    <?php if ( get_sub_value( 'link' ) && get_sub_value( 'text' ) ): ?>
        <p>
            <a href="<?php the_sub_value( 'link' ) ?>" target="<?php the_sub_value( 'link_target' ) ?>" class="main-background button">
                <?php the_sub_value( 'text' ) ?>
            </a>
        </p>
    <?php endif; ?>
<?php endwhile ?>

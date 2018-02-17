<div class="section main">
    <div class="section__center">
        <?php while( have_groups( 'team' ) ): the_group() ?>

            <?php if( 'department' == get_group_type() ): ?>

                <h2><?php the_sub_value( 'name' ) ?></h2>

            <?php else: ?>

                <h3><?php the_sub_value( 'first_name' ) ?> <?php the_sub_value( 'last_name' ) ?></h3>
                <?php the_sub_value( 'bio' ) ?>

            <?php endif ?>

        <?php endwhile ?>
    </div>
</div>

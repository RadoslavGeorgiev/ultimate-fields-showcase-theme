<div class="rte text-block">
	<?php if( get_sub_value( 'icon' ) ): ?>
	<div class="round-icon">
		<span class="fa <?php the_sub_value( 'icon' ) ?>"></span>
	</div>
	<?php endif ?>
	<h3><?php the_sub_value( 'title' ) ?></h3>
	<?php the_sub_value( 'text' ) ?>
</div>

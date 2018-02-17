<?php get_header() ?>

<?php if( ! apply_filters( 'showcase.content', false ) ): ?>
<div class="section main page-content">
	<div class="section__center page-content__center">
		<div class="page-content__main">
			<?php get_template_part( 'loop' ); ?>
		</div>

		<div class="page-content__sidebar">
			<?php dynamic_sidebar( 'default-sidebar' ) ?>
		</div>
	</div>
</div>
<?php endif ?>

<?php get_footer() ?>
